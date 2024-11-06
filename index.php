<?php
session_start();

require_once "lib/funcoes.php"
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prato Bom - Home</title>

    <link rel="icon" href="assets/img/Fevicon.png" type="image/png">

    <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/themify-icons/themify-icons.">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/Magnific-Popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_fasm.css">
    <link href="utilities/DataTables/datatables.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/js/jqueryMask.js"></script>
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
        <nav class="custom-bg navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img class="logo-img" src="assets/img/favicon.png" alt="Logotipo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="index.php?pagina=catalogo">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="index.php?pagina=sobrenos">Sobre Nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="index.php?pagina=faleconosco">Fale Conosco</a>
                        </li>

                        <?php
                        if (!isset($_SESSION['userId'])) {
                        ?>
                            <li class="nav-item active"><a class="nav-link text-white" href="index.php?pagina=loginView">Área restrita</a></li>
                        <?php
                        } else {
                        ?>

                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false"><?= substr($_SESSION['userName'], 0, 15) ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>

                                    <?php if ($_SESSION['tipoUsuario'] == 1): ?>
                                        <li class="nav-item"><a class="nav-link" href="index.php?pagina=listaCategoria">Categorias</a></li>
                                        <li class="nav-item"><a class="nav-link" href="index.php?pagina=listaProduto">Produtos</a></li>
                                        <li class="nav-item"><a class="nav-link" href="index.php?pagina=listaUsuario">Usuários</a></li>
                                    <?php endif; ?>

                                    <li class="nav-item"><a class="nav-link" href="index.php?pagina=trocarSenhaView">Trocar a Senha</a></li>
                                </ul>
                            </li>
                        <?php

                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div class="container">
            <?= Funcoes::mensagem(); ?>
        </div>

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
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> Todos os direitos reservados para
                    <a href="index.php">Market</a>
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