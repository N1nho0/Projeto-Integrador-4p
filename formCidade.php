<?php
Funcoes::mensagem();
require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new Funcoes();

$dados = [];

// Caso não seja 'insert', buscamos o dado da cidade
if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM cidade WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

// Buscar todos os estados (UFs) da tabela 'uf' para preencher o select
$ufs = $db->dbSelect("SELECT * FROM uf ORDER BY descricao", 'all');
?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Usuário<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaCidade" 
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Cidade.php" method="POST">

        <input type="hidden" name="id" id="id" value="<?= Funcoes::setValue($dados, "id") ?>">

        <div class="row">
            <div class="col-9">
                <label for="descricao" class="form-label">Nome</label>
                <input type="text" 
                        class="form-control" 
                        id="nome" 
                        name="nome" 
                        placeholder="Nome da Cidade"
                        required
                        autofocus
                        value="<?= Funcoes::setValue($dados, 'nome') ?>">
            </div>

            <div class="col-9 mt-3">
                <label for="uf_id" class="form-label">Estado (UF)</label>
                <select 
                    class="form-control" 
                    id="uf_id" 
                    name="uf_id" 
                    required>
                    <option value="" <?= Funcoes::setValue($dados, 'uf_id') == "" ? 'selected' : '' ?>>Selecione o Estado</option>
                    <?php foreach ($ufs as $uf): ?>
                        <option value="<?= $uf['id'] ?>" <?= Funcoes::setValue($dados, 'uf_id') == $uf['id'] ? 'selected' : '' ?>><?= $uf['descricao'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-3 mt-3">
                <label for="statusRegistro" class="form-label">Status</label>
                <select 
                    class="form-control" 
                    id="statusRegistro" 
                    name="statusRegistro"
                    required>
                        <option value=""  <?= Funcoes::setValue($dados, 'statusRegistro') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'statusRegistro') == "1" ? 'selected' : '' ?>>Ativo</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'statusRegistro') == "2" ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaCidade" 
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
