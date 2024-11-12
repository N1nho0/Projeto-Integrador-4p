<?php

session_start();

require_once "lib/Database.php";

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $db = new Database();

    // Buscar o usuário pelo e-mail informado no login
    $data = $db->dbSelect(
        "SELECT * FROM fornecedor WHERE email = ?",
        'first',
        [$_POST['email']]
    );

    if ($data === false) {
        // Se não encontrar o usuário, exibe mensagem de erro
        $_SESSION['msgError'] = "Login ou senha inválida!";
    } else {
        // Verificar o status do registro
        if ($data['statusRegistro'] != 1) {
            // Se o cadastro não estiver aprovado, exibe mensagem de erro
            $_SESSION['msgError'] = "Seu cadastro está pendente de aprovação ou foi bloqueado. Favor procurar o administrador.";
        } else {
            // Verificar a senha
            if (!password_verify(trim($_POST['senha']), $data['senha'])) {
                // Se a senha estiver incorreta, exibe mensagem de erro
                $_SESSION['msgError'] = "Login ou senha inválida!";
            } else {
                // Se tudo estiver correto, realiza o login
                $_SESSION['userId']    = $data['id'];
                $_SESSION['userEmail'] = $data['email'];
                $_SESSION['userName']  = $data['nomeFornecedor'];
                $_SESSION['nivel'] = 3;

                // Redireciona para a página inicial após o login
                header("Location: index.php");
                exit();
            }
        }
    }
} else {
    // Se os campos não forem preenchidos corretamente
    $_SESSION['msgError'] = "Para acessar a área administrativa, favor fazer o login.";
}

// Redireciona de volta para a página de login se não for autenticado
header("Location: index.php?pagina=loginViewFornecedor");
exit();

?>
