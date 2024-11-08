<?php
session_start();

require_once "lib/Database.php";
require_once "lib/funcoes.php";

if (isset($_POST['email'])) {
    $db = new Database();

    // Buscar o fornecedor pelo e-mail
    $fornecedor = $db->dbSelect("SELECT * FROM usuarioFornecedor WHERE email = ?", 'first', [$_POST['email']]);

    if (!$fornecedor) {
        // E-mail não encontrado
        $_SESSION['msgError'] = "Login ou senha inválido";
        return header("Location: index.php?pagina=fornecedores");
    }

    // Verificar a senha
    if (!password_verify(trim($_POST["senha"]), $fornecedor->senha)) {
        echo "Senha incorreta";

        // Senha incorreta
        $_SESSION['msgError'] = "Login ou senha inválido";
        return header("Location: index.php?pagina=fornecedores");
    }

    // Fornecedor autenticado, configurar sessão
    $_SESSION["usuarioFornecedorID"] = $fornecedor->usuarioFornecedorID;

    // Mensagem de depuração
    echo "Autenticado com sucesso";

    // Mensagem de sucesso
    $_SESSION['msgSuccess'] = "Autenticado com sucesso";

    // Redirecionar para a página do fornecedor
    header("Location: index.php?pagina=fornecedorMenu");
    exit;
} else {
    // Redirecionar para a página de login se não houver e-mail fornecido
    header("Location: index.php?pagina=fornecedores");
    exit;
}
