<?php

require_once "lib/Database.php";
require_once "lib/Funcoes.php";


$db = new Database();

$data = $db->dbSelect("SELECT * FROM produto", 'first');

?>

<div class="container mb-5">

    <h2 class="mt-5 mb-5">Detalhes do Produto</h2>


    <?php
    // ... código para obter dados do produto

    // Verificar se a consulta retornou resultados
    if ($data) {
        // Verificar se as propriedades necessárias estão definidas
        if (isset($data['descricao'])) {
            echo '<p>' . $data['descricao'] . '</p>';
        } else {
            echo '<p>Descrição não disponível.</p>';
        }

        if (isset($data['precoVenda'])) {
            echo '<p>Preço R$ <strong>' . Funcoes::valorBr($data['precoVenda']) . '</strong></p>';
        } else {
            echo '<p>Preço não disponível.</p>';
        }

        // ... restante do código
    } else {
        echo '<p>Produto não encontrado.</p>';
    }
    ?>

    <img src="uploads/produto/<?= $data['imagem'] ?>" alt="..." class="img-responsive" width="200" height="200">

    <!-- Adicionar o botão "Adicionar ao Carrinho" -->
    <a href="index.php?pagina=carrinho&id=<?= $data['id'] ?>" class="btn btn-primary">Adicionar ao Carrinho</a>


    <p class="mt-5 mb-5">
        <a href="index.php?pagina=produtos" title="Voltar">Voltar</a>
    </p>

</div>