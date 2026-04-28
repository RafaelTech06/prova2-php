<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    
    // Corrigido: O enunciado mostrava o execute com 3 valores, mas faltava o usuario_id no INSERT
    $sql = "INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);
    
    header("Location: index.php");
    exit;
}
include 'layout.php';
?>

<div class="card shadow mt-4">
    <div class="card-header bg-success text-white">
        <h4>Nova Tarefa</h4>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label>Título (Obrigatório)</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Salvar Tarefa</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
</div></body></html>