<?php
// =========================================================
// FRAMEWORK ESCOLHIDO: Bootstrap 5
// IMPORTADO EM: layout.php (via CDN: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css)
// =========================================================

session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';
include 'layout.php';

// Busca tarefas APENAS do usuário logado
$sql = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY id DESC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':usuario_id', $_SESSION["usuario_id"]);
$stmt->execute();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Minhas Tarefas</h2>
    <a href="nova.php" class="btn btn-success">+ Nova Tarefa</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                <tr>
                    <td><?php echo $linha->titulo; ?></td>
                    <td>
                        <?php if ($linha->status == 'concluida'): ?>
                            <span class="badge bg-success">Concluída</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pendente</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($linha->data_criacao)); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $linha->id; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <?php if ($linha->status == 'pendente'): ?>
                            <a href="concluir.php?id=<?php echo $linha->id; ?>" class="btn btn-sm btn-success">Concluir</a>
                        <?php endif; ?>
                        <a href="excluir.php?id=<?php echo $linha->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>