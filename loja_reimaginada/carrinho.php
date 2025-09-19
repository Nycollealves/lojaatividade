<?php
session_start();
require 'conexao.php';
include 'cabecalho.php';

// Inicializa carrinho na sessão se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se veio um POST para adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);

    // Buscar o produto no banco
    $sql = "SELECT * FROM produtos WHERE id = $produto_id LIMIT 1";
    $resultado = mysqli_query($conexao, $sql);
    $produto = mysqli_fetch_assoc($resultado);

    if ($produto) {
        // Se já existe no carrinho, aumenta a quantidade
        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade']++;
        } else {
            // Se não existe, adiciona
            $_SESSION['carrinho'][$produto_id] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
    }
}

// Se veio GET para remover produto
if (isset($_GET['remover'])) {
    $id = intval($_GET['remover']);
    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
}
?>

<div class="container">
    <h2>🛒 Meu Carrinho</h2>
    <?php if (empty($_SESSION['carrinho'])): ?>
        <p>Seu carrinho está vazio.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalGeral = 0;
                foreach ($_SESSION['carrinho'] as $item): 
                    $total = $item['preco'] * $item['quantidade'];
                    $totalGeral += $total;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']) ?></td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td>R$ <?= number_format($total, 2, ',', '.') ?></td>
                        <td>
                            <button a href="carrinho.php?remover=<?= $item['id'] ?>" class="btn btn-danger">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total Geral</strong></td>
                    <td colspan="2"><strong>R$ <?= number_format($totalGeral, 2, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>
        <button a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
    <?php endif; ?>
</div>

<?php include 'rodape.php'; ?>
