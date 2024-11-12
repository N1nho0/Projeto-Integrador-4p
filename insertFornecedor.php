<?php

session_start();

if (isset($_POST['nome'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    // Gera um token único associado ao fornecedor
    $token = bin2hex(random_bytes(16));  // Gera um token de 32 caracteres (256 bits)

    try {
        $result = $db->dbUpdate(
            "UPDATE fornecedor SET token = ?
                                WHERE email = ?",
            [
                $token,
                $_POST['email']
            ]
        );
        
        $result2 = $db->dbInsert("INSERT INTO fornecedor
                                (nomeFornecedor, CNPJ, nomeEmpresa, contato, endereco, email, CIDADE, ESTADO, token)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
                                ,[
                                    $_POST['nome'],
                                    $_POST['cnpj'],
                                    $_POST['nome_empresa'],
                                    $_POST['telefone'],
                                    $_POST['endereco'],
                                    $_POST['email'],
                                    $_POST['cidade'],
                                    $_POST['estado'],
                                    $token,
                                ]);
        
        if ($result2 > 0) {      // sucesso
            $_SESSION['msgSuccess'] = "Registro inserido com sucesso.";
            header("Location: index.php?pagina=criaSenhaFornecedor.php?token=$token");
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 

return header("Location: index.php?pagina=listaUsuario");