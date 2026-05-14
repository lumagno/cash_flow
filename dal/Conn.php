<?php
namespace App\Dal;

use PDO;
use PDOException;
use Exception;

abstract class Conn{
    private static ?PDO $conn = null;
    private static string $host = "127.0.0.1:3306"; 
    private static string $dbname = "cashflow_db";
    private static string $user = "root";
    private static string $password = ""; 

    public static function getConn() : PDO {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=". self::$host . ";dbname=" . self::$dbname,
                    self::$user,
                    self::$password
                );
            } catch (PDOException $e) {
                throw new Exception("Erro ao conectar ao banco: " . $e->getMessage(), 1);    
            }   
        }
        return self::$conn;
    }
}