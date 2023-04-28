<?php

namespace App\Helper;

trait EnvTrait
{
    public static function getEnv(string $param): string
    {
        if (empty($_ENV[$param])) {
            throw new \InvalidArgumentException(sprintf('Variavel de ambiente não encontrada: %s', $param));
        }

        return $_ENV[$param];
    }
}
