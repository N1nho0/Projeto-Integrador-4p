<?php
/*
 *  Login
 */

require_once "lib/Funcoes.php";
?>

<section class="section-margin">
    
    <div class="container">
        
        <div class="section-intro mb-75px">
            <h4 class="intro-title">Área restrita</h4>
        </div>   
        
        <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <form class="form-contact contact_form" action="login.php" method="post" id="contactForm" novalidate="novalidate">
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

            <div class="form-group mt-3">
                <button type="submit" class="button button-contactForm">Acessar</button>
            </div>
            </form>

        </div>

    </div>
</section>