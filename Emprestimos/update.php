<?php 
include '../conexao/db.php';

$id = $_GET['id'];
$dados = $conn->query("SELECT * FROM emprestimos WHERE id=$id")->fetch_assoc();

if (isset($_POST['atualizar'])) {
    $data_emprestimos = $_POST['data_emprestimos'];
    $data_devolucao = $_POST['data_devolucao'];
    $livro_id = $_POST['livro_id'];
    $leitor_id = $_POST['leitor_id'];

    $sql = "UPDATE emprestimos SET data_emprestimos='$data_emprestimos', data_devolucao='$data_devolucao', livro_id=$livro_id, leitor_id='$leitor_id' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: read.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Erro: " . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Editar</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="data_emprestimo" class="form-label">Data de empréstimo:</label>
            <input type="text" name="data_emprestimo" id="data_emprestimo" value="<?= $dados['data_emprestimo'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="data_devolucao" class="form-label">Data de devolução:</label>
            <input type="text" name="data_devolucao" id="data_devolucao" value="<?= $dados['data_devolucao'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="data_devolucao" class="form-label">Id do Livro:</label>
            <input type="text" name="data_devolucao" id="data_devolucao" value="<?= $dados['livro_id'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="leitor_id" class="form-label">Id do Leitor:</label>
            <input type="text" name="leitor_id" id="leitor_id" value="<?= $dados['leitor_id'] ?>" class="form-control" required>
        </div>

        <div class="col-12">
            <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>