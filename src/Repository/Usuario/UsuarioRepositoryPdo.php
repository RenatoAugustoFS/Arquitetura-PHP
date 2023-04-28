<?php

namespace App\Repository\Usuario;

use App\Model\Usuario\Usuario;
use PDO;

class UsuarioRepositoryPdo implements UsuarioRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodosUsuarios(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM ca_usuario");
        $stmt->execute();

        $usuarios = [];

        foreach ($stmt->fetchAll() as $usuario) {
            $usuarios[] = $usuario = new Usuario(
                id: $usuario['codigo'],
                email: $usuario['email'],
                senha: $usuario['senha']
            );
        }

        return $usuarios;
    }

    public function buscarUsuarioPorEmail(string $email): ?Usuario
    {
        $query = "SELECT * FROM ca_usuario WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue('email', $email);
        $stmt->execute();

        $result = $stmt->fetch();

        return new Usuario(
            id: $result['codigo'],
            email: $result['email'],
            senha: $result['senha']
        );
    }

    public function save(Usuario $usuario): void
    {
        if ($usuario->getId() !== null) {
            $query = "UPDATE ca_usuario SET email = :email, senha = :senha WHERE codigo = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue('email', $usuario->getEmail());
            $stmt->bindValue('senha', $usuario->getSenha());
            $stmt->bindValue('id', $usuario->getId());
            $stmt->execute();

            return;
        }

        $query = "INSERT INTO ca_usuario (email, senha) VALUES (:email, :senha)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue('email', $usuario->getEmail());
        $stmt->bindValue('senha', $usuario->getSenha());
        $stmt->execute();
    }

    public function remove(int $id): void
    {
        $query = "DELETE FROM ca_usuario WHERE codigo = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }
}
