<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;
use Dotenv\Dotenv;

$url = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if (array_key_exists($url, $rotas) === false) {
    http_response_code(404);
    exit();
}

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$rotaDeLogin = stripos($url, 'login');
if (!isset($_SESSION['logado']) && $rotaDeLogin === false) {
    header('location: /login');
    exit();
}

$classeControladora = $rotas[$url];

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$container = require __DIR__ . '/../config/dependencies.php';

/** @var RequestHandlerInterface $controlador */
$controlador = $container->get($classeControladora);
$response = $controlador->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
