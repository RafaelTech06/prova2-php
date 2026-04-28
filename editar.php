<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $sql = "UPDATE tarefas SET titulo=?, descricao=?, status=? WHERE id=? AND usuario_id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$titulo, $descricao, $status, $id, $_SESSION["usuario_id"]]);
    
    header("Location: index.php");
    exit;
}

// Buscar dados atuais
$sql = "SELECT * FROM tarefas WHERE id=? AND usuario_id=?";
$stmt = $conexao->prepare($sql);
$stmt->execute([$id, $_SESSION["usuario_id"]]);
$tarefa = $stmt->fetch(PDO::FETCH_OBJ);

include 'layout.php';
?>

<div class="card shadow mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Editar Tarefa</h4>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo $tarefa->titulo; ?>" required>
            </div>
            <div class="mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4"><?php echo $tarefa->descricao; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="pendente" <?php echo ($tarefa->status == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                    <option value="concluida" <?php echo ($tarefa->status == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
</div></body></html>