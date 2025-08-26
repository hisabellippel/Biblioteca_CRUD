<?php
if (isset($_POST['salvar'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $autores_id = $_POST['autores_id'];

    $sql = "INSERT INTO livros (titulo, genero, ano, autores_id)
            VALUES ('$titulo', '$genero', $ano, $autores_id)";

    if ($conn->query($sql)) {
        header("Location: read.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Erro: " . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Cadastrar Livro</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="titulo" class="form-label">Titulo</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="genero" class="form-label">Genero</label>
            <input type="text" name="genero" id="genero" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="ano" class="form-label">Ano:</label>
            <input type="number" name="ano" id="ano" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="autores_id" class="form-label">Autor:</label>
            <select name="autores_id" class="form-select" required>
                <?php
                $result = $conn->query("SELECT id, nome FROM autores");
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" name="salvar" class="btn btn-success">Salvar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>
</div>

