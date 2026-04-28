<?php
$host = "127.0.0.1";
$user = "root";
$porta = "3306";
$password = "ceub123456";
$db = "tarefas";

try {
    $conexao = new PDO("mysql:host=$host;port=$porta;dbname=$db", $user, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>