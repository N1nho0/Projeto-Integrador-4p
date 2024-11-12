<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new Funcoes();

$dados = [];

$aCategoria = $db->dbSelect("SELECT * FROM produtocategoria ORDER BY descricao");

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM produto WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Produtos/Serviço<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaProduto"
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Produto.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id" value="<?= Funcoes::setValue($dados, "id") ?>">

        <div class="row">

            <div class="col-9">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text"
                    class="form-control"
                    id="descricao"
                    name="descricao"
                    placeholder="Descricao"
                    required
                    autofocus
                    value="<?= Funcoes::setValue($dados, 'descricao') ?>">
            </div>

            <div class="col-6">
                <label for="produtocategoria_id" class="form-label">Categoria</label>
                <select name="produtocategoria_id" id="produtocategoria_id" class="form-control" required>
                    <option value="">...</option> <!-- Opção vazia padrão -->

                    <?php foreach ($aCategoria as $item): ?>
                        <option value="<?= $item['id'] ?>" <?= (isset($dados['produtocategoria_id']) && $dados['produtocategoria_id'] == $item['id']) ? 'selected' : '' ?>>
                            <?= $item['descricao'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>




            <div class="col-3">
                <label for="statusCadastro" class="form-label">Status</label>
                <select
                    class="form-control"
                    id="statusCadastro"
                    name="statusCadastro"
                    required>
                    <option value="" <?= Funcoes::setValue($dados, 'statusCadastro') == ""  ? 'selected' : '' ?>>...</option>
                    <option value="1" <?= Funcoes::setValue($dados, 'statusCadastro') == "1" ? 'selected' : '' ?>>Ativo</option>
                    <option value="2" <?= Funcoes::setValue($dados, 'statusCadastro') == "2" ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <div class="col-4">
                <label for="qtdeEmEstoque" class="form-label">Qtde Em Estoque</label>
                <input type="text" class="form-control" name="qtdeEmEstoque" id="qtdeEmEstoque" dir="rtl"
                    value="<?= Funcoes::setValue($dados, 'qtdeEmEstoque') ?>">
            </div>

            <div class="col-4">
                <label for="custoTotal" class="form-label">Custo Total Estoque</label>
                <input type="text" class="form-control" name="custoTotal" id="custoTotal" dir="rtl"
                    value="<?= Funcoes::setValue($dados, 'custoTotal') ?>">
            </div>

            <div class="col-4">
                <label for="precoVenda" class="form-label">Preço de Venda</label>
                <input type="text" class="form-control" name="precoVenda" id="precoVenda" dir="rtl"
                    value="<?= Funcoes::setValue($dados, 'precoVenda') ?>">
            </div>

            <div class="col-12 mt-3 mb-3">
                <label for="caracteristicas" class="form-label">Caracteristicas</label>
                <textarea name="caracteristicas" id="caracteristicas">
                    <?= Funcoes::setValue($dados, 'caracteristicas') ?></textarea>
            </div>

        </div>

        <h5 class="mt-3 mb-3">Imagens</h5>

        <?php if ($_GET['acao'] != "insert"): ?>
            <div class="row">
                <div class="form-group col-4">
                    <img src="uploads/produto/<?= Funcoes::setValue($dados, 'imagem') ?>" alt="..." class="img-thumbnail" width="200" height="200">
                </div>
            <?php endif; ?>

            <?php if (in_array($_GET['acao'], ["insert", "update"])): ?>

                <div class="row mt-3">
                    <div class="form-group col-12 col-md-4">
                        <label for="imagem1" class="form-label font-weight-bold">Imagem<span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" name='imagem' id="imagem1" accept="image/png, image/jpeg, image/jpg" <?= $_GET['acao'] == 'insert' ? 'required' : '' ?>>
                    </div>
                </div>

            <?php endif; ?>

            <input type="hidden" name="excluirImagem" id="excluirImagem" value="<?= Funcoes::setValue($dados, 'imagem') ?>">

            <div class="row mt-3">
                <div class="col-12">
                    <a href="index.php?pagina=listaProduto"
                        class="btn btn-outline-secondary btn-sm">
                        Voltar
                    </a>

                    <?php if ($_GET['acao'] != 'view'): ?>
                        <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                    <?php endif; ?>
                </div>
            </div>

    </form>
</div>

<script src="assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#caracteristicas'))
        .catch(error => {
            console.error(error);
        });

    $(document).ready(function() {
        // Máscara para exibição com vírgulas
        $('#qtdeEmEstoque, #custoTotal, #precoVenda').mask('000.000.000,00', {
            reverse: true
        });

        // Ao submeter o formulário, converte as vírgulas para pontos
        $('form').on('submit', function() {
            $('#qtdeEmEstoque, #custoTotal, #precoVenda').each(function() {
                let valor = $(this).val();
                valor = valor.replace(/\./g, '').replace(',', '.'); // Remove os pontos de milhar e substitui a vírgula por ponto
                $(this).val(valor); // Atualiza o valor do campo com o formato correto para envio
            });
        });
    });
</script>