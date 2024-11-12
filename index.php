<?php
ob_start();

session_start();

require_once "lib/funcoes.php"
?>

<!DOCTYPE html>
<html lang="pt-br">

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Da Roça</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Vendor CSS Files -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="vendor/aos/aos.css" rel="stylesheet">
    <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jqueryMask.js"></script>

</head>


<body>

    <header id="header" class="header fixed d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- 
                <img src="assets/img/logo.png" alt="">
                -->
                <h1>Da<span> Roça</span></h1>
            </a>
            <nav id="navbar" class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=sobreNos">A empresa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=produtos">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=loginViewFornecedor">Fornecedores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=faleConosco">Fale Conosco</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['userId'])) {
                        ?>
                            <li class="nav-item active"><a class="nav-link active" href="index.php?pagina=loginView">Área restrita</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?= isset($_SESSION['userName']) && !is_null($_SESSION['userName']) ? substr($_SESSION['userName'], 0, 15) : 'Usuário' ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                                    <?php if ($_SESSION['nivel'] == 1): ?>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaUsuario">Usuário</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaUf">UF</a></li>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaCidade">Cidade</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaProdutoCategoria">Categoria de Produtos</a></li>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaProduto">Produtos/Serviços</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="index.php?pagina=listaFornecedor">Fornecedor</a></li>
                                    <?php endif; ?>
                                    <li class="nav-item"><a class="nav-link" href="index.php?pagina=trocarSenhaView">Trocar a Senha</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
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