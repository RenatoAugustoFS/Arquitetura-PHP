<?php

namespace App\Helper;

trait HtmlRenderTrait
{
    public function renderView(string $caminhoTemplate, array $dados): string
    {
        extract($dados);

        ob_start();

        require __DIR__ . '/../../templates/' . $caminhoTemplate;

        return ob_get_clean();
    }
}
