<?php
include "cabecalho.php";
require 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo '<div class="container"><div class="alert alert-danger">ID inválido.</div></div>';
    echo '</body></html>';
    exit;
}

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch();

if (!$produto) {
    echo '<div class="container"><div class="alert alert-danger">Produto não encontrado.</div></div>';
    echo '</body></html>';
    exit;
}
?>

<div class="container">
    <a href="index.php" class="btn btn-link mb-3">← Voltar</a>

    <h2>Atualização de produto</h2>

    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
        <div class="mb-3">
            Nome: <input required value="<?php echo htmlspecialchars($produto['nome']); ?>" type="text" name="produto" class="form-control">
        </div>
        <div class="mb-3">
            Preço: <input required value="<?php echo number_format($produto['preco'], 2, ',', '.'); ?>" type="text" name="preco" class="form-control" placeholder="Ex: 10,50 ou 10.50">
        </div>
        <div class="mb-3">
            Quantidade: <input required value="<?php echo htmlspecialchars($produto['quantidade']); ?>" type="number" name="estoque" class="form-control" min="0" step="1">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
