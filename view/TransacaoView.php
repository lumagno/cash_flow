<?php
namespace App\View;

class TransacaoView {
    public static function listar(array $transacoes): void {
        $saldo = 0;
    ?>
        <h2>Relatório de Fluxo de Caixa</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor (R$)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Estrutura de Laço (foreach) exigida
                foreach($transacoes as $t): 
                    if($t['tipo'] === 'entrada') {
                        $saldo += $t['valor'];
                    } else {
                        $saldo -= $t['valor'];
                    }
                ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= htmlspecialchars($t['descricao']) ?></td>
                    <td><?= ucfirst($t['tipo']) ?></td>
                    <td><?= number_format((float)$t['valor'], 2, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">SALDO FINAL</th>
                    <th style="color: <?= $saldo >= 0 ? 'green' : 'red' ?>;">
                        R$ <?= number_format($saldo, 2, ',', '.') ?>
                    </th>
                </tr>
            </tfoot>
        </table>
    <?php
    }

    public static function formulario(?string $msg) : void {
        if ($msg !== null): ?>
            <div class="alert">
                <?= $msg ?>
                <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <h2>Registrar Nova Movimentação</h2>
        <form action="?p=cad" method="post">
            <label>Descrição do Pagamento/Recebimento:</label>
            <input type="text" name="descricao" required>

            <label>Valor (R$):</label>
            <input type="number" step="0.01" name="valor" required>

            <label>Tipo:</label>
            <select name="tipo" style="width: 100%; padding: 10px; margin-bottom: 10px;">
                <option value="entrada">Recebimento (Entrada)</option>
                <option value="saida">Pagamento (Saída)</option>
            </select>

            <button type="submit" name="enviaForm">Salvar Transação</button>
        </form>
    <?php
    }
}