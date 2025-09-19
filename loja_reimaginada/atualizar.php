<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);
$nome = trim($_POST['produto'] ?? '');
$preco_raw = trim($_POST['preco'] ?? '');
$estoque = filter_var($_POST['estoque'] ?? 0, FILTER_VALIDATE_INT);

if (!$id || $nome === '' || $preco_raw === '' || $estoque === false) {
    die('Dados inválidos.');
}

$preco = str_replace(',', '.', $preco_raw);
$preco = (float) $preco;

$sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ':nome' => $nome,
        ':preco' => $preco,
        ':quantidade' => $estoque,
        ':id' => $id
    ]);
    header('Location: listar.php?updated=1');
    exit;
} catch (PDOException $e) {
    die("Erro ao atualizar produto: " . $e->getMessage());
}
