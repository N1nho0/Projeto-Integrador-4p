<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

// Verificando se o usuário está logado e se é administrador,
// se não for redireciona para a página de login
if (!Funcoes::getAdministrador()) {
    $_SESSION['msgError'] = "Usuário não logado ou sem permissão para acessar o recurso";
    header("Location: index.php");
    exit;
}

$db = new Database();
$data = $db->dbSelect("SELECT * FROM fornecedor ORDER BY nomeFornecedor");

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-10">
            <h3>Lista de Fornecedores</h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=formFornecedor&acao=insert"
                class="btn btn-outline-secondary btn-sm"
                title="Novo Fornecedor">
                Novo Fornecedor
            </a>
        </div>
    </div>

    <?= Funcoes::mensagem() ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>E-mail</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php if (count($data) > 0): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nomeFornecedor']) ?></td>
                        <td><?= htmlspecialchars($row['CNPJ']) ?></td>
                        <td><?= htmlspecialchars($row['telefone']) ?></td>
                        <td><?= htmlspecialchars($row['endereco']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['cidade_id']) ?></td>
                        <td><?= htmlspecialchars($row['estado_id']) ?></td>
                        <td><?= Funcoes::getStatusRegistro($row['statusRegistro']) ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Nenhum fornecedor encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>