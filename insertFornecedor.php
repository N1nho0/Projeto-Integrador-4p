<?php
require_once "lib/funcoes.php";

Funcoes::mensagem();
session_start();

if (isset($_POST['email'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        $result = $db->dbInsert(
            "INSERT INTO fornecedor
                                (nomeFornecedor, cnpj, telefone, endereco, email, cidade_id, estado_id, senha)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $_POST['nomeFornecedor'],
                $_POST['cnpj'],
                $_POST['telefone'],
                $_POST['endereco'],
                $_POST['email'],
                $_POST['cidade_id'],
                $_POST['estado_id'],
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

return header("Location: index.php?pagina=loginFornecedor");
