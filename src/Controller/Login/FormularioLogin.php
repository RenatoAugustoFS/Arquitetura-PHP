<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Helper\HtmlRenderTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioLogin implements RequestHandlerInterface
{
    use HtmlRenderTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dados = [
            'titulo' => 'Formulário de Login',
            'usuario' => 'Nome do Usuário'
        ];

        $html = $this->renderView('Login/formulario-login.php', $dados);

        return new Response(200, [], $html);
    }
}
