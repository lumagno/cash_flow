<?php
namespace App\Dal;

use App\Dal\Conn;
use App\Model\Usuario;
use PDO;
use PDOException;

abstract class UsuarioDao {
    public static function cadastrar(Usuario $usuario) : int {
        try {
            $pdo = Conn::getConn();    
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            
            $sql->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $sql->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $sql->bindValue(":senha", $usuario->getSenha(), PDO::PARAM_STR);
            
            $sql->execute();
            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new \Exception("Este e-mail já está cadastrado no sistema.");
            }
            throw $e;
        }
    }
}