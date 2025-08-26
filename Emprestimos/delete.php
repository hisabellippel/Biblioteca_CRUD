<?php 
include '../conexao/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM emprestimos WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: read.php");
    exit;
} else {
    echo "<div class='alert alert-danger mt-3'>Erro: " . $conn->error . "</div>";
}
?>