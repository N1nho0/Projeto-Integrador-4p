<?php

require_once "lib/Database.php";

?>

<section class="about section-margin">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="login_form_inner">
                    <h3 class="mb-4">Cadastro de Fornecedor</h3>

                    <?php if (isset($_SESSION['msgSuccess'])): ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['msgSuccess'] ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="row" action="insertFornecedor.php" id="cadastroForm">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Nome da Empresa" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required>
                        </div>
                        <div class="col-md-12 form-group mt-2">
                            <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" required>
                        </div>
                        <div class="col-12 form-group mt-3">
                            <button type="submit" name="cadastrar" class="btn btn-primary btn-sm">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
