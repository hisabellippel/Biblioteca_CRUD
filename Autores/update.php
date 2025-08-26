<?php 
include '../conexao/db.php';

$id = $_GET['id'];
$dados = $conn->query("SELECT * FROM autores WHERE id=$id")->fetch_assoc();

if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $ano = $_POST['ano'];

    $sql = "UPDATE autores SET nome='$nome', nacionalidade='$nacionalidade', ano=$ano WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: read.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Erro: " . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Editar Time</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="nacionalidade" class="form-label">Nacionalidade:</label>
            <input type="text" name="nacionalidade" id="nacionalidade" value="<?= $dados['nacionalidade'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="ano" class="form-label">Ano de Nascimento:</label>
            <input type="text" name="ano" id="ano" value="<?= $dados['ano'] ?>" class="form-control" required>
        </div>

        <div class="col-12">
            <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>