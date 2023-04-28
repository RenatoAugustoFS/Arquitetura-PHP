<?php

namespace App\Helper;

trait FlashMessageTrait
{
    public function addFlashMessage(string $tipo, string $mensagem): void
    {
        $_SESSION['tipo_mensagem'] = $tipo;
        $_SESSION['mensagem'] = $mensagem;
    }
}
