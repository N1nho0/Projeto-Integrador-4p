<?php

// Verificar se a sessão do fornecedor está ativa
if (!isset($_SESSION['usuarioFornecedorID'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: index.php?pagina=fornecedores");
    exit;
}

// Inicia a sessão, se ainda não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<section class="produto-form section-margin">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="produto_form_inner">
                    <h3 class="mb-4">Cadastro de Produtos</h3>

                    <?php if (isset($msgSucesso)): ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= $msgSucesso ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="insertProdutoProjeto.php" enctype="multipart/form-data">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Nome do Produto" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" required></textarea>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="qtdEstoque" name="qtdEstoque" placeholder="Quantidade em Estoque" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <label for="imagem">Imagem:</label>
                            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="custo" name="custo" placeholder="Custo" required>
                        </div>
                        <div class="col-12 form-group mt-3">
                            <button type="submit" name="cadastrarProduto" class="btn btn-primary btn-sm">Cadastrar Produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>