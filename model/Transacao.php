<?php
namespace App\Model;

class Transacao {
    private ?int $id;
    private string $descricao;
    private float $valor;
    private string $tipo;

    private function __construct(){}

    public static function criar(?int $id, string $descricao, float $valor, string $tipo) : static {
        $transacao = new static();
        $transacao->id = $id;
        $transacao->setDescricao($descricao);
        $transacao->setValor($valor);
        $transacao->setTipo($tipo);
        return $transacao;
    }

    public function getId(): ?int { return $this->id; }
    public function getDescricao(): string { return $this->descricao; }
    public function getValor(): float { return $this->valor; }
    public function getTipo(): string { return $this->tipo; }

    public function setDescricao(string $descricao) : void {
        if ($descricao == null || $descricao == "") {
            throw new \InvalidArgumentException("A descrição é obrigatória.");
        }
        $this->descricao = $descricao;
    }

    public function setValor(float $valor) : void {
        if ($valor <= 0) {
            throw new \InvalidArgumentException("O valor deve ser maior que zero.");
        }
        $this->valor = $valor;
    }

    public function setTipo(string $tipo) : void {
        if ($tipo !== "entrada" && $tipo !== "saida") {
            throw new \InvalidArgumentException("O tipo deve ser 'entrada' ou 'saida'.");
        }
        $this->tipo = $tipo;
    }
}