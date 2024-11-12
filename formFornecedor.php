<?php
Funcoes::mensagem();
require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new Funcoes();

$dados = [];
$Estado = $db->dbSelect("SELECT * FROM uf ORDER BY descricao");
$Cidade = $db->dbSelect("SELECT * FROM cidade ORDER BY nome");
?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Cadastro Fornecedor</h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=loginViewFornecedor"
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <form class="g-3" action="insertFornecedor.php" method="POST">

        <input type="hidden" name="id" id="id" value="<?= Funcoes::setValue($dados, "id") ?>">

        <div class="row">

            <div class="col-6 mt-3">
                <label for="nome" class="form-label">Nome do Fornecedor</label>
                <input type="text"
                    class="form-control"
                    id="nomeFornecedor"
                    name="nomeFornecedor"
                    placeholder="Nome do Fornecedor"
                    required
                    autofocus
                    value="<?= Funcoes::setValue($dados, 'nomeFornecedor') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="nome" class="form-label">CNPJ</label>
                <input type="text"
                    class="form-control"
                    id="cnpj"
                    name="cnpj"
                    placeholder="CNPJ"
                    required
                    autofocus
                    value="<?= Funcoes::setValue($dados, 'cnpj') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="E-mail"
                    required
                    value="<?= Funcoes::setValue($dados, 'email') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="nome" class="form-label">Telefone</label>
                <input type="text"
                    class="form-control"
                    id="telefone"
                    name="telefone"
                    placeholder="Telefone"
                    required
                    autofocus
                    value="<?= Funcoes::setValue($dados, 'telefone') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="email" class="form-label">Cidade</label>
                <select name="cidade_id" id="cidade_id" class="form-control" required>
                    <option value="">...</option> <!-- Opção vazia padrão -->

                    <?php foreach ($Cidade as $item): ?>
                        <option value="<?= $item['id'] ?>" <?= (isset($dados['cidade_id']) && $dados['cidade_id'] == $item['id']) ? 'selected' : '' ?>>
                            <?= $item['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="nome" class="form-label">Estado</label>
                <select name="estado_id" id="estado_id" class="form-control" required>
                    <option value="">...</option> <!-- Opção vazia padrão -->

                    <?php foreach ($Estado as $item): ?>
                        <option value="<?= $item['id'] ?>" <?= (isset($dados['estado_id']) && $dados['estado_id'] == $item['id']) ? 'selected' : '' ?>>
                            <?= $item['descricao'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 mt-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text"
                    class="form-control"
                    id="endereco"
                    name="endereco"
                    placeholder="Endereço"
                    required
                    value="<?= Funcoes::setValue($dados, 'endereco') ?>">
            </div>


            <div class="col-6 mt-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password"
                    class="form-control"
                    id="senha"
                    name="senha"
                    required
                    value="<?= Funcoes::setValue($dados, 'senha') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="confSenha" class="form-label">Confirma Senha</label>
                <input type="password"
                    class="form-control"
                    id="confSenha"
                    name="confSenha"
                    required
                    value="<?= Funcoes::setValue($dados, 'senha') ?>">
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=loginViewFornecedor"
                    class="btn btn-outline-secondary btn-sm">
                    Voltar
                </a>

                <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
            </div>
        </div>

    </form>
</div>