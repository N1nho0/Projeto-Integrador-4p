
<?php

    require_once "lib/Database.php";
    require_once "lib/Funcoes.php";

    // Criando o objeto Db para classe de base de dados
    $db = new Database();

    // Buscar a lista de Produtos

    $data = $db->dbSelect(
        "SELECT p.* FROM Produto as p ORDER BY p.descricao"
    );

    ?>

    <div class="container mb-5">

        <h2 class="mt-5 mb-5">Produtos</h2>

        <div class="row">

            <?php foreach ($data as $item): ?>

                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="uploads/produto/<?= $item['imagem'] ?>" alt="..." class="card-img-top" width="200" height="200">
                        <div class="card-body">
                            <h6 class="card-title"><?= $item['descricao'] ?></h5>
                            <h4>R$ <strong><?= Funcoes::valorBr($item['precoVenda']) ?></strong></h4>
                            <a href="index.php?pagina=produtosDetalhes&id=<?= $item['id'] ?>" class="btn btn-primary">Mais detalhes</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </div>
    