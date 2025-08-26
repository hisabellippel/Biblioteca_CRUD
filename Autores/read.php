<?php

include '../conexao/db.php';

$nomeFiltro = $_GET['nome'] ?? '';
$nacinalidadeFiltro = $_GET['nacionalidade'] ?? '';
$anoFiltro = $_GET['ano'] ?? '';


$pagina = $_GET['pagina'] ?? 1;
$itens_por_pagina = 10;
$offset = ($pagina - 1) * $itens_por_pagina;


$sqlCount = "SELECT COUNT(*) as total FROM autores WHERE 1=1";
$paramsCount = [];
$typesCount = "";


if ($nomeFiltro) {
    $sqlCount .= " AND nome LIKE ?";
    $paramsCount[] = "%$nomeFiltro%";
    $typesCount .= "s";
}


if ($nacinalidadeFiltro) {
    $sqlCount .= " AND nacionalidade LIKE ?";
    $paramsCount[] = "%$nacionalidadeFiltro%";
    $typesCount .= "s";
}

$stmtCount = $conn->prepare($sqlCount);
if (!empty($paramsCount)) {
    $stmtCount->bind_param($typesCount, ...$paramsCount);
}
$stmtCount->execute();
$total_registros = $stmtCount->get_result()->fetch_assoc()['total'];
$total_paginas = ceil($total_registros / $itens_por_pagina);


$sql = "SELECT * FROM autores WHERE 1=1";
$params = [];
$types = "";


if ($nomeFiltro) {
    $sql .= " AND nome LIKE ?";
    $params[] = "%$nomeFiltro%";
    $types .= "s";
}

if ($nacionalidadeFiltro) {
    $sql .= " AND nacionalidade LIKE ?";
    $params[] = "%$nacionalidadeFiltro%";
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
        <a class="btn btn-success" href="create.php"><H2>CADASTRAR AUTOR</H2></a>
    </div>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="text" name="nome" class="form-control" placeholder="Filtrar por nome"
                   value="<?= htmlspecialchars($nomeFiltro) ?>">
        </div>
        <div class="col-md-4">
            <input type="text" name="nacionalidade" class="form-control" placeholder="Filtrar por nacionalidade"
                   value="<?= htmlspecialchars($nacionalidadeFiltro) ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>nacionalidade</th>
                <th>Ano de nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['nacionalidade']) ?></td>
                    <td><?= htmlspecialchars($row['ano']) ?></td>
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
                    <a class="page-link" href="?pagina=<?= $i ?>&nome=<?= $nomeFiltro ?>&nacionalidade=<?= $nacionalidadeFiltro ?>&ano=<?= $anoFiltro ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<link rel="stylesheet" href="../../style/style.css">