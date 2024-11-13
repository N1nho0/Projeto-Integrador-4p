<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

// Verificando se o usário está logado e se o é administrador,
// se não for rediciona para a página login
if (!$_SESSION['nivel'] == 3) {
    $_SESSION['msgError'] = "Usuário não logado ou sem permissão para acessar o recurso";
    return header("Location: index.php?pagina=viewLoginFornecedor");
}

$db = new Database();
$idFornecedor = $_SESSION['userId'];
$data = $db->dbSelect("SELECT 
                            p.*, 
                            pc.descricao AS categoriaDescricao, 
                            f.nomeFornecedor 
                        FROM produto AS p 
                        INNER JOIN produtocategoria AS pc ON pc.id = p.produtocategoria_id
                        INNER JOIN fornecedor AS f ON f.id = p.fornecedorId -- Ajuste feito aqui
                        WHERE fornecedorId = $idFornecedor");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista Produtos/Serviços</h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=formProdutoFornecedor&acao=insert"
                class="btn btn-outline-secondary btn-sm"
                title="Nova">
                Nova
            </a>
        </div>
    </div>

    <?= Funcoes::mensagem(); ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Preço Venda</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['descricao'] ?></td>
                        <td class="text-end"><?= number_format($row['precoVenda'], 2, ",", ".") ?></td>
                        <td><?= $row['categoriaDescricao'] ?></td>
                        <td><?= $row['nomeFornecedor'] ?></td>
                        <td><?= ($row['statusCadastro'] == 1 ? "Ativo" : ($row['statusCadastro'] == 2 ? "Inativo" : "...")) ?></td>
                        <td>
                            <a href="index.php?pagina=formProdutoFornecedor&acao=update&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formProdutoFornecedor&acao=delete&id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formProdutoFornecedor&acao=view&id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm" title="Visualização">Visualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>

        </tbody>

    </table>

</div>