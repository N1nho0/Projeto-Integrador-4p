<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Teste - Home</title>
        
        <link rel="icon" href="" type="image/png">
        
        <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/themify-icons/themify-icons.">
        <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/vendors/Magnific-Popup/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/style_fasm.css">
        <link href="utilities/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/js/jquery-1.11.3.min.js"></script>
        <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="assets/vendors/nice-select/jquery.nice-select.min.js"></script>
        <script src="assets/vendors/Magnific-Popup/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>
        <script src="assets/js/mail-script.js"></script>
        <script src="assets/js/main.js"></script>        
        
        <script src="utilities/DataTables/datatables.min.js" type="text/javascript"></script>
        
    </head>
    <body>
        
        <header class="header_area">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container box_1620">
                        <a class="navbar-brand logo_h" href="index.php"><h3 style="color: purple; font-weight: bold;">Gerenciador de Estoque</h3></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav justify-content-end">
                                <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
                                <li class="nav-item"><a class="nav-link" href="index.php?pagina=quemsomos">Quem somos</a></li> 
                                <li class="nav-item"><a class="nav-link" href="index.php?pagina=faleconosco">Fale Conosco</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php?pagina=loginview">Login</a></li>
                                
                                <?php
                                if (1 == 2) {
                                    ?>
                                    <li class="nav-item"><a class="nav-link" href="index.php?pagina=loginview">Área restrita</a></li>
                                    <?php
                                } else {
                                    ?>

                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                            aria-expanded="false">bruno.couri</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a class="nav-link" href="controllerUsuario/logout">Sair</a></li>
                                                <li class="nav-item"><a class="nav-link" href="index.php?pagina=listaProdutoCategoria">CRUD Categoria</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">Trocar a Senha</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                    
                                }
                                ?>
                            </ul>
                        </div> 
                    </div>
                </nav>
            </div>
        </header>        
        
        <main>

            <?php

                $pagina = 'home';

                if (isset($_GET['pagina'])) {
                    $pagina = $_GET['pagina'];
                }

                require_once $pagina . '.php';

            ?>

        </main>

        <footer class="footer-area section-gap">
            <div class="container">
            
                <div class="footer-bottom row align-items-center text-center text-lg-left">
                    
                    <p class="footer-text m-0 col-lg-8 col-md-12">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados para 
                        <a href="index.php">Nome da Empresa</a>
                    </p>
                    
                    <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-dribbble"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </footer>

    </body>

</html>