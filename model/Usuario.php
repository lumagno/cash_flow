<?php
namespace App\Model;

class Usuario {
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;

    private function __construct(){}

    public static function criar(?int $id, string $nome, string $email, string $senha) : static {
        $usuario = new static();
        $usuario->id = $id;
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        return $usuario;
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getSenha(): string { return $this->senha; }

    // Validações rigorosas como no Cliente.php do professor
    public function setNome(string $nome) : void {
        if (empty($nome) || strlen($nome) < 3) {
            throw new \InvalidArgumentException("O nome deve ter pelo menos 3 caracteres.");
        }
        $this->nome = $nome;
    }

    public function setEmail(string $email) : void {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("O formato do e-mail é inválido.");
        }
        $this->email = $email;
    }

    public function setSenha(string $senha) : void {
        if (strlen($senha) < 6) {
            throw new \InvalidArgumentException("A senha deve ter no mínimo 6 caracteres.");
        }
        // Criptografando a senha por segurança
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }
}