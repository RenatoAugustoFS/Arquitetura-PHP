<?php

use App\Helper\Persistence\ConnectionCreatorFactory;
use App\Repository\Usuario\UsuarioRepositoryInterface;
use App\Repository\Usuario\UsuarioRepositoryPdo;
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    UsuarioRepositoryInterface::class => function () {
        return new UsuarioRepositoryPdo(ConnectionCreatorFactory::createConnection());
    },

    PDO::class => function () {
        return ConnectionCreatorFactory::createConnection();
    }
]);

return $containerBuilder->build();
