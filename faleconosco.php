<?php
/*
 *  Fale conosco
 */

?>

<section class="section-margin">
    
    <div class="container">
        
        <div class="section-intro mb-75px">
            <h4 class="intro-title">Fale Conosco</h4>
        </div>        
        
        <div class="d-none d-sm-block mb-5 pb-4">

            <img src="#" alt="Localização da empresa" 
                    class="img-responsive ajusta_mapa">

        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Entre em contato conosco</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="faleconoscoEnvio" method="post" id="contactForm" novalidate="novalidate">
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="assunto" id="assunto" 
                                    type="text" 
                                    placeholder="Informe o assunto que deseja tratar" 
                                    required>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="message" id="message" 
                                        cols="30" rows="9" 
                                        placeholder="Escreva sua mensagem"></textarea>
                        </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="nome" id="nome" 
                                    type="text" placeholder="Seu nome" required>
                        </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" 
                                    type="email" placeholder="Seu e-mail" required>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                            <input class="form-control" name="telefone" id="telefone" type="text" 
                                    placeholder="Seu Telefone de contato" required>
                        </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm">Enviar Mensagem</button>
                    </div>
                </form>

            </div>

            <div class="col-lg-4">
                <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                    <h3>Praça Aninna Bisegna, 40 - Centro.</h3>
                    <p>Muriaé - MG, 36880-000</p>
                </div>
                </div>
                <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                <div class="media-body">
                    <h3><a href="tel:553237211026">55 (32) 3721 1026</a></h3>
                    <p>De segunda sexta, das 9 as 18 horas</p>
                </div>
                </div>
                <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-email"></i></span>
                <div class="media-body">
                    <h3><a href="mailto:teste@test.com">teste@test.com</a></h3>
                    <p>Envie sua consulta a qualquer momento!</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>