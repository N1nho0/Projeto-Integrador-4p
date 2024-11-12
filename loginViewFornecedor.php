<?php
/*
 * Login Fornecedores
 */

require_once "lib/Funcoes.php";

// Verifica se o usuário está logado
if (Funcoes::getLogado()) {
    if ($_SESSION['nivel'] == 3) {
        // Redireciona para o fornecedorMenu se o nível for 3
        header("Location: index.php?pagina=fornecedorMenu");
        exit;
    } elseif ($_SESSION['nivel'] == 1) {
        // Redireciona para listaProduto se o nível for 1
        header("Location: index.php?pagina=listaProduto");
        exit;
    }
}
?>

<section class="section-margin">

    <div class="container">

        <div class="section-intro mb-75px">
            <h4 class="intro-title">Fornecedores</h4>
        </div>

        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form class="form-contact contact_form" action="loginFornecedor.php" method="post" id="contactForm" novalidate="novalidate">
                    <div class="row">

                        <div class="col-sm-12">
                            <h4 class="intro-title">Acesso</h4>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email"
                                    type="text"
                                    placeholder="Informe o seu Email"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="senha" id="senha"
                                    type="password" placeholder="Sua senha" required>
                            </div>
                        </div>
                    </div>

                    <?= Funcoes::mensagem() ?>

                    <div class="col-12 form-group mt-3">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" value="submit" class="btn btn-primary btn-sm">Entrar</button>
                            </div>
                            <div class="col-6 text-right">
                                <a href="index.php?pagina=formFornecedor">Ainda não tem uma conta? Clique aqui para se cadastrar.</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>