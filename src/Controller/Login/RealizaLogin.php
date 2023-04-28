<?php

namespace App\Controller\Login;

use App\Helper\FlashMessageTrait;
use App\Repository\Usuario\UsuarioRepositoryInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(UsuarioRepositoryInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        if (!isset($body['email']) && !isset($body['senha'])) {
            $this->addFlashMessage('danger', 'Preencha todos os campos!');
            return new Response(302, ['location' => '/login']);
        }

        $email = filter_var($body['email'], FILTER_VALIDATE_EMAIL);
        $senha = filter_var($body['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($email === false) {
            $this->addFlashMessage('danger', 'Email inválido');
            return new Response(302, ['location' => '/login']);
        }

        $usuario = $this->usuarioRepository->buscarUsuarioPorEmail(email: $email);

        if ($usuario === null || $usuario->validaSenha($senha) === false) {
            $this->addFlashMessage('danger', 'Email ou senha inválidos');
            return new Response(302, ['location' => '/login']);
        }

        session_start();
        $_SESSION['usuario_logado'] = true;

        return new Response(302, ['location' => '/login']);
    }
}
