<?php
include '../conexao/db.php';

if (isset($_POST['salvar'])) {
    $data_emprestimos = $_POST['data_emprestimos'];
    $data_devolucao = $_POST['data_devolucao'];
    $livro_id = $_POST['livro_id'];
    $leitor_id = $_POST['leitor_id'];

    $sql = "INSERT INTO emprestimos (data_emprestimos, data_devolucao, livro_id, leitor_id) VALUES ('$data_emprestimo', '$data_devolucao', $livro_id, $leitor_id)";

    if ($conn->query($sql)) {
        header("Location: read.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Erro: " . $conn->error . "</div>";
    }
}
?>
<div class="container mt-4">
    <h2 class="mb-4">Cadastrar Empréstimos</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="data_emprestimos" class="form-label">Data do empréstimo:</label>
            <input type="number" name="data_emprestimos" id="data_emprestimos" class="form-control" required>
        </div>

          <div class="col-md-6">
            <label for=" data_devolucao" class="form-label">Data de devolução:</label>
            <input type="number" name=" data_devolucao" id=" data_devolucao" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="livro_id" class="form-label">Livro</label>
            <select name="livro_id" class="form-select" required>
                <?php
                $result = $conn->query("SELECT id, titulo FROM times");
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="leitor_id" class="form-label">Leitor</label>
            <select name="leitor_id" class="form-select" required>
                <?php
                $result = $conn->query("SELECT id, nome FROM times");
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

