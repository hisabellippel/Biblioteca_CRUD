<?php 
include '../conexao/db.php';

$id = $_GET['id'];
$dados = $conn->query("SELECT * FROM leitores WHERE id=$id")->fetch_assoc();

if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE leitores SET nome='$nome', email='$email', telefone=$telefone WHERE id=$id";

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
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" value="<?= $dados['email'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?= $dados['telefone'] ?>" class="form-control" required>
        </div>


        <div class="col-12">
            <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>