<?php

declare(strict_types=1);

namespace App\Model\Usuario;

class Usuario
{
    private ?int $id = null;
    private string $email;
    private string $senha;

    public function __construct(?int $id, string $email, string $senha)
    {
        $this->id = $id;
        $this->senha = password_hash($senha, PASSWORD_ARGON2ID);
        $this->validaEmail($email);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->validaEmail($email);

        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function validaEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email inválido");
        }
    }

    public function validaSenha(string $senha): bool
    {
        return password_verify($senha, $this->senha);
    }
}
