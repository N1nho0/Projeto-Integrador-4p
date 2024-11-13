<?php

require_once "lib/Database.php";
require_once "lib/Funcoes.php";

$db = new Database();

// Recuperando dados do produto com join para pegar o nome do fornecedor
$data = $db->dbSelect(
    "SELECT p.*, f.nomeFornecedor 
     FROM produto p 
     LEFT JOIN fornecedor f ON p.fornecedorId = f.id 
     WHERE p.id = :id", 
    'first', 
    ['id' => $_GET['id']]
);

?>

<div class="container mb-5">
    <h2 class="mt-5 mb-4 text-center text-primary">Detalhes do Produto</h2>

    <div class="row">
        <!-- Coluna de informações -->
        <div class="col-md-7">
            <?php
            // Verificar se a consulta retornou dados
            if ($data) {
                // Função para verificar e exibir os dados
                function exibirValor($campo, $textoPadrao = "Não disponível") {
                    return isset($campo) ? $campo : $textoPadrao;
                }

                // Exibir descrição
                echo '<div class="card mb-3 shadow-sm p-4 bg-light"><p class="h5">' . exibirValor($data['descricao']) . '</p></div>';

                // Exibir preço
                echo '<div class="card mb-3 shadow-sm p-4 bg-light"><p class="h4 text-success">Preço: R$ <strong>' . exibirValor(Funcoes::valorBr($data['precoVenda'])) . '</strong></p></div>';

                // Exibir fornecedor
                echo '<div class="card mb-3 shadow-sm p-4 bg-light"><p class="h5">Fornecedor: <strong>' . exibirValor($data['nomeFornecedor']) . '</strong></p></div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Produto não encontrado.</div>';
            }
            ?>

            <!-- Botão Adicionar ao Carrinho -->
            <?php if ($data): ?>
                <div class="text-center mt-4">
                    <a href="index.php?pagina=carrinho&id=<?= $data['id'] ?>" class="btn btn-lg btn-primary">Adicionar ao Carrinho</a>
                </div>
            <?php endif; ?>

            <!-- Link Voltar -->
            <div class="text-center mt-5">
                <a href="index.php?pagina=produtos" class="btn btn-outline-secondary">Voltar para os Produtos</a>
            </div>
        </div>

        <!-- Coluna de imagem -->
        <div class="col-md-5">
            <?php
            // Verificar se a imagem do produto existe e exibi-la
            if (!empty($data['imagem'])) {
                echo '<div class="text-center mb-4"><img src="uploads/produto/' . $data['imagem'] . '" alt="Imagem do produto" class="img-fluid rounded shadow-sm" width="300" height="300"></div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">Imagem não disponível.</div>';
            }
            ?>
        </div>
    </div>
</div>
