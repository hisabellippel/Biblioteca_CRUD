<?php 
include '../conexao/db.php';

$id = $_GET['id'];
$dados = $conn->query("SELECT * FROM livros WHERE id=$id")->fetch_assoc();

if (isset($_POST['atualizar'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $autores_id = $_POST['autores_id'];

    $sql = "UPDATE livros SET titulo='$titulo', genero='$genero', ano=$ano, autores_id='$autores_id' WHERE id=$id";

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
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= $dados['titulo'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="genero" class="form-label">Gênero:</label>
            <input type="text" name="genero" id="genero" value="<?= $dados['genero'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="ano" class="form-label">Ano de publicação:</label>
            <input type="text" name="ano" id="ano" value="<?= $dados['ano'] ?>" class="form-control" required>
        </div>


        <div class="col-12">
            <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>