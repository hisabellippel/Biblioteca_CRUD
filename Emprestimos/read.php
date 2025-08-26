<?php

include '../conexao/db.php';

$data_emprestimosFiltro = $_GET['data_emprestimos'] ?? '';
$data_devolucaoFiltro = $_GET['data_devolucao'] ?? '';
$livro_idFiltro = $_GET['livro_id'] ?? '';
$leitor_idFiltro = $_GET['leitor_id'] ?? '';


$pagina = $_GET['pagina'] ?? 1;
$itens_por_pagina = 10;
$offset = ($pagina - 1) * $itens_por_pagina;


$sqlCount = "SELECT COUNT(*) as total FROM emprestimos WHERE 1=1";
$paramsCount = [];
$typesCount = "";


if ($data_emprestimosFiltro) {
    $sqlCount .= " AND nome LIKE ?";
    $paramsCount[] = "%$data_emprestimosFiltro%";
    $typesCount .= "s";
}


if ($data_devolucaoFiltro) {
    $sqlCount .= " AND data_devolucao LIKE ?";
    $paramsCount[] = "%$data_devolucaoFiltro%";
    $typesCount .= "s";
}

$stmtCount = $conn->prepare($sqlCount);
if (!empty($paramsCount)) {
    $stmtCount->bind_param($typesCount, ...$paramsCount);
}
$stmtCount->execute();
$total_registros = $stmtCount->get_result()->fetch_assoc()['total'];
$total_paginas = ceil($total_registros / $itens_por_pagina);


$sql = "SELECT * FROM emprestimos WHERE 1=1";
$params = [];
$types = "";


if ($data_emprestimosFiltro) {
    $sql .= " AND nome LIKE ?";
    $params[] = "%$data_emprestimosFiltro%";
    $types .= "s";
}

if ($data_devolucaoFiltro) {
    $sql .= " AND data_devolucao LIKE ?";
    $params[] = "%$data_devolucaoFiltro%";
    $types .= "s";
}

$sql .= " ORDER BY nome ASC LIMIT ?, ?";
$params[] = $offset;
$params[] = $itens_por_pagina;
$types .= "ii";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Autores</h2>
        <a class="btn btn-success" href="create.php"><H2>CADASTRAR EMPRÉSTIMO</H2></a>
    </div>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="text" name="data_emprestimos" class="form-control" placeholder="Filtrar por data  de empréstimos"
                   value="<?= htmlspecialchars($data_emprestimosFiltro) ?>">
        </div>
        <div class="col-md-4">
            <input type="text" name="data_devolucao" class="form-control" placeholder="Filtrar por data de devolucao"
                   value="<?= htmlspecialchars($data_devolucaoFiltro) ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Data  de empréstimos</th>
                <th>Data de devolucao</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['data_empréstimos']) ?></td>
                    <td><?= htmlspecialchars($row['data_devolucao']) ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                           onclick="return confirm('Deseja realmente excluir o autor <?= $row['nome'] ?>?')">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <nav>
        <ul class="paginacao">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>&data_empréstimos=<?= $data_empréstimosFiltro ?>&data_devolucao=<?= $data_devolucaoFiltro ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<link rel="stylesheet" href="../../style/style.css">