<?php
namespace App\View;

class UsuarioView {
    public static function formulario(?string $msg, string $tipoMsg = 'erro') : void {
        if ($msg !== null): 
            // Usa a classe CSS correta dependendo do sucesso ou erro
            $classe = ($tipoMsg === 'sucesso') ? 'alert' : 'erro';
        ?>
            <div class="<?= $classe ?>">
                <?= $msg ?>
                <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <h2>Cadastro de Usuário</h2>
        <form action="?p=cad_user" method="post">
            <label>Nome Completo:</label>
            <input type="text" name="nome" required placeholder="Digite seu nome">

            <label>E-mail:</label>
            <input type="email" name="email" required placeholder="exemplo@email.com">

            <label>Senha:</label>
            <input type="password" name="senha" required placeholder="Mínimo de 6 caracteres">

            <label>Confirmar Senha:</label>
            <input type="password" name="conf_senha" required placeholder="Repita a senha">

            <button type="submit">Cadastrar Usuário</button>
        </form>
    <?php
    }
}