<?php
include "cabecalho.php";
require 'conexao.php';
?>

<div class="container">
    <a href="index.php" class="btn btn-link mb-3">← Voltar</a>

    <?php if (isset($_GET['created'])): ?>
        <div class="alert alert-success">Produto cadastrado com sucesso.</div>
    <?php endif; ?>
    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success">Produto atualizado com sucesso.</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">Produto apagado com sucesso.</div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">PREÇO</th>
                <th scope="col">QUANTIDADE</th>
                <th scope="col">OPÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM produtos ORDER BY id ASC";
            $stmt = $pdo->query($sql);
            while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($produto['id']) . "</td>";
                echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
                echo "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($produto['quantidade']) . "</td>";
                echo "<td>
                        <div class='btn-group' role='group'>
                            <a href='form_atualizado.php?id=" . urlencode($produto['id']) . "' class='btn btn-success'>Atualizar</a>
                            <a href='apagar.php?id=" . urlencode($produto['id']) . "' class='btn btn-danger' onclick=\"return confirm('Deseja realmente apagar este produto?');\">Apagar</a>
                        </div>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
