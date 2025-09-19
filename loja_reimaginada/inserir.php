<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nome = trim($_POST['produto'] ?? '');
$preco_raw = trim($_POST['preco'] ?? '');
$estoque = filter_var($_POST['estoque'] ?? 0, FILTER_VALIDATE_INT);

if ($nome === '' || $preco_raw === '' || $estoque === false) {
    die('Dados inválidos. Volte e preencha todos os campos corretamente.');
}


$preco = str_replace(',', '.', $preco_raw);
$preco = (float) $preco;

$sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES (:nome, :preco, :quantidade)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':preco', $preco);
$stmt->bindParam(':quantidade', $estoque, PDO::PARAM_INT);

try {
    $stmt->execute();
    header('Location: listar.php?created=1');
    exit;
} catch (PDOException $e) {
    die("Erro ao inserir produto: " . $e->getMessage());
}
