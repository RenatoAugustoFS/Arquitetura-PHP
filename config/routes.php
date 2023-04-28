<?php

use App\Controller\Login\FormularioLogin;
use App\Controller\Login\RealizaLogin;

return [
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class
];
