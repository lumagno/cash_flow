<?php
declare(strict_types=1);

namespace App;

session_start();

require_once "./util/Functions.php";
require_once "./dal/Conn.php";
require_once "./model/Transacao.php";
require_once "./dal/TransacaoDao.php";
require_once "./view/TransacaoView.php";
require_once "./controller/TransacaoController.php";
require_once "./model/Usuario.php";
require_once "./dal/UsuarioDao.php";
require_once "./view/UsuarioView.php";
require_once "./controller/UsuarioController.php";

use App\Controller\TransacaoController as Transacao;
use App\Controller\UsuarioController as UsuarioCtrl;

// Verifica se existe um cookie de acesso, senão cria um. Uso de Cookie conforme critério.
if (!isset($_COOKIE["ultimo_acesso"])) {
    setcookie("ultimo_acesso", date("d/m/Y H:i:s"), time() + 3600, "/");
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cash-flow Management</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <header>
        <h1>Cash-flow Management</h1>
        <nav>
            <?php require_once("./menu.php");?>
        </nav>
        <small>Último acesso: <?= $_COOKIE["ultimo_acesso"] ?? "Primeiro acesso" ?></small>
    </header>
    <main>
    <?php
        // Estrutura de Controle (match) e uso de GET
        $page = $_GET["p"] ?? "home";
        match($page) {
            "home" => require_once("./view/home.php"),
            "list" => Transacao::listar(),
            "cad" => Transacao::cadastrar(),
            "cad_user" => UsuarioCtrl::cadastrar(),
            default => require_once("./view/404.php"),
        };
    ?>
    </main>
    <footer>
        <small>Copyright &copy; - <?= date("Y") ?> | Sistema de Pagamentos</small>
    </footer>
</body>
</html>