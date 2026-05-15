<?php
namespace App\Controller;

use App\Util\Functions as Util;
use App\Model\Usuario;
use App\Dal\UsuarioDao;
use App\View\UsuarioView;
use \Exception;

class UsuarioController {
    
    public static function cadastrar() : void {
        $msg = $_SESSION['msg_user'] ?? null;
        $tipoMsg = $_SESSION['tipo_msg'] ?? 'erro';
        unset($_SESSION['msg_user'], $_SESSION['tipo_msg']); 

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["nome"])) {
            $nome = Util::preparaTexto($_POST["nome"]);
            $email = Util::preparaTexto($_POST["email"]);
            $senha = $_POST["senha"];
            $confSenha = $_POST["conf_senha"];

            try {
                if ($senha !== $confSenha) {
                    throw new Exception("As senhas digitadas não conferem.");
                }

                $usuario = Usuario::criar(null, $nome, $email, $senha);
                UsuarioDao::cadastrar($usuario);
                
                $_SESSION['msg_user'] = "Usuário cadastrado com sucesso!";
                $_SESSION['tipo_msg'] = "sucesso";
                
                header("Location: ?p=cad_user");
                exit;
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $tipoMsg = "erro";
            }
        }
        UsuarioView::formulario($msg, $tipoMsg);
    }
}