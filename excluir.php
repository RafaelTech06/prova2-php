<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM tarefas WHERE id = ? AND usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$id, $_SESSION["usuario_id"]]);
}

header("Location: index.php");
exit;
?>