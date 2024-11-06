<?php
/*
 *  Login
 */

require_once "lib/Funcoes.php";

// Verificando se o usário está logado e se o é administrador,
// se não for rediciona para a página login
if (!Funcoes::getAdministrador()) {
    $_SESSION['msgError'] = "Usuário não logado ou sem permissão para acessar o recurso";
    return header("Location: index.php");
}

?>

<section class="section-margin">
    
    <div class="container">
        
        <div class="section-intro mb-75px">
            <h4 class="intro-title">Trocar a Senha</h4>
        </div>   
        
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                
                <form class="form-contact contact_form" action="trocarSenha.php" method="post" id="contactForm" novalidate="novalidate">
                    
                    <div class="row">

                        <div class="col-sm-12">
                            <h4><strong class="form-label">Login:</strong> <?=  $_SESSION['userName'] ?></h4>
                        </div>        
                        
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <input class="form-control" name="senhaAtual" id="senhaAtual" 
                                    type="password" placeholder="Sua senha atual" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="novaSenha" id="novaSenha" 
                                    type="password" placeholder="Nova senha" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="confSenha" id="confSenha" 
                                    type="password" placeholder="Confirma nova senha" required>
                            </div>
                        </div>
                    </div>

                    <?= Funcoes::mensagem() ?>

                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm">Atualizar</button>
                    </div>

                </form>

            </div>        
        </div>

    </div>
</section>