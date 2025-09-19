<?php include "cabecalho.php"; ?>

<div class="container">
    <a href="index.php" class="btn btn-link mb-3">Voltar</a>

    <form action="inserir.php" method="POST">
        <div class="mb-3">
            <input required type="text" name="produto" class="form-control" placeholder="Digite o nome do produto">
        </div>
        <div class="mb-3">
            <input required type="text" name="preco" class="form-control" placeholder="Digite o preço do produto (use . ou ,)">
        </div>
        <div class="mb-3">
            <input required type="number" name="estoque" class="form-control" placeholder="Digite a quantidade" min="0" step="1">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
