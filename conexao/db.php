<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca_crud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}

?>