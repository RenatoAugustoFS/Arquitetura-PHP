<?php

namespace App\Repository\Usuario;

use App\Model\Usuario\Usuario;

interface UsuarioRepositoryInterface
{
    public function buscarTodosUsuarios(): array;

    public function buscarUsuarioPorEmail(string $email): ?Usuario;

    public function save(Usuario $student): void;

    public function remove(int $id): void;
}
