<?php
require_once "lib/funcoes.php";

Funcoes::mensagem();
session_start();

if (isset($_POST['nome'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        $result = $db->dbInsert(
            "INSERT INTO usuario
                                (nome, email, nivel, statusRegistro, senha)
                                VALUES (?, ?, ?, ?, ?)",
            [
                $_POST['nome'],
                $_POST['email'],
                $_POST['nivel'],
                $_POST['statusRegistro'],
                password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)
            ]
        );

        if ($result > 0) {      // sucesso
            $_SESSION['msgSuccess'] = "Registro inserido com sucesso.";
        } else {
            $_SESSION['msgError'] = "Falha ao tentar inserir o registro.";
        }
    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}

return header("Location: index.php?pagina=listaUsuario");
