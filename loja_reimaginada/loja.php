<?php
include 'conexao.php';
include 'cabecalho.php';
// Verifica se a conexão foi estabelecida
if (!$pdo) {
  die('<p>Erro na conexão com o banco de dados.</p>');
}
?>
<div class="container">
  <div class="vitrine-title">
    <h2>✨ Vitrine Encantada</h2>
    <div><small>Produtos disponíveis</small></div>
  </div>

  <div class="vitrine-grid">
    <?php
  $sql = "SELECT * FROM produtos";
  try {
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll();
  } catch (PDOException $e) {
    echo '<p>Erro ao carregar produtos.</p>';
    $produtos = [];
  }
  if (empty($produtos)) {
    echo '<p>Nenhum produto encontrado.</p>';
  } else {
    foreach ($produtos as $produto) {
      $img = isset($produto['imagem']) && $produto['imagem'] !== '' ? $produto['imagem'] : 'https://via.placeholder.com/400x300.png?text=Produto';
      echo '<article class="card">';
      echo '<img src="'.htmlspecialchars($img).'" alt="'.htmlspecialchars($produto['nome']).'">';
      echo '<h3>'.htmlspecialchars($produto['nome']).'</h3>';

      echo '<div class="meta">';
      echo '<div class="price">R$ '.htmlspecialchars(number_format($produto['preco'],2,",",".")).'</div>';
      echo '<form method="post" action="carrinho.php">';
      echo '<input type="hidden" name="produto_id" value="'.intval($produto['id']).'">';
      // TODO: Adicionar proteção CSRF
      echo '<button class="buy-btn" type="submit">Comprar</button>';
      echo '</form>';
      echo '</div>';
      echo '</article>';
    }
  }
    ?>
  </div>
</div>
<?php include 'rodape.php'; ?>
