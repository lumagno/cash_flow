<?php
namespace App\Controller;

use App\Util\Functions as Util;
use App\Model\Transacao;
use App\Dal\TransacaoDao;
use App\View\TransacaoView;
use \Exception;

class TransacaoController {
    
    public static function cadastrar() : void {
        $msg = $_SESSION['msg'] ?? null;
        unset($_SESSION['msg']); 

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["descricao"])) {
            $descricao = Util::preparaTexto($_POST["descricao"]);
            $valor = (float) $_POST["valor"];
            $tipo = Util::preparaTexto($_POST["tipo"]);

            try {
                $transacao = Transacao::criar(null, $descricao, $valor, $tipo);
                $id = TransacaoDao::cadastrar($transacao);
                
                $_SESSION['msg'] = "Transação cadastrada com sucesso! ID: " . $id;
                
                header("Location: ?p=cad");
                exit;
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }
        }
        TransacaoView::formulario($msg);
    }

    public static function listar() : void {
        try {
            $lista = TransacaoDao::buscarTodos();
            TransacaoView::listar($lista);
        } catch (Exception $e) {
            echo "<div class='erro'>Erro ao carregar lista: " . $e->getMessage() . "</div>";
        }
    }
}