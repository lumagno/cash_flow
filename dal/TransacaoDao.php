<?php
namespace App\Dal;

use App\Dal\Conn;
use App\Model\Transacao;
use PDO;
use PDOException;

abstract class TransacaoDao {
    public static function cadastrar(Transacao $transacao) : int {
        try {
            $pdo = Conn::getConn();    
            $sql = $pdo->prepare("INSERT INTO transacoes (descricao, valor, tipo) VALUES (:descricao, :valor, :tipo)");
            
            $sql->bindValue(":descricao", $transacao->getDescricao(), PDO::PARAM_STR);
            $sql->bindValue(":valor", $transacao->getValor(), PDO::PARAM_STR);
            $sql->bindValue(":tipo", $transacao->getTipo(), PDO::PARAM_STR);
            
            $sql->execute();
            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function buscarTodos() : array {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM transacoes");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}