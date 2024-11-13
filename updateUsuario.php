<?php
session_start();

if (isset($_POST['nome'])) {

    $atualizaSenha = false;

    // Verificação da senha e da confirmação da senha
    if (trim($_POST['senha']) != '') {
        if (trim($_POST['senha']) == trim($_POST['confSenha'])) {
            $atualizaSenha = true;
        } else {
            $_SESSION['msgError'] = "Senha e conferência da senha não estão iguais";
            header("Location: index.php?pagina=listaUsuario");
            exit;
        }
    }

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // Criar o objeto do banco de dados
    $db = new Database();

    try {
        // Atualiza os dados principais, incluindo estadoId e cidadeId
        $result = $db->dbUpdate(
            "UPDATE usuario
                SET nome = ?, email = ?, nivel = ?, statusRegistro = ?, estadoId = ?, cidadeId = ?
            WHERE id = ?",
            [
                $_POST['nome'],
                $_POST['email'],
                $_POST['nivel'],
                $_POST['statusRegistro'],
                $_POST['estadoId'],
                $_POST['cidadeId'],
                $_POST['id']
            ]
        );

        if ($result > 0) { // Sucesso na atualização dos dados principais

            // Atualiza a senha, se necessário
            if ($atualizaSenha) {
                $resultSenha = $db->dbUpdate(
                    "UPDATE usuario
                        SET senha = ?
                    WHERE id = ?",
                    [
                        password_hash(trim($_POST['senha']), PASSWORD_DEFAULT),
                        $_POST['id']
                    ]
                );

                // Confirma atualização da senha, se for o caso
                if ($resultSenha > 0) {
                    $_SESSION['msgSuccess'] = "Registro e senha alterados com sucesso.";
                } else {
                    $_SESSION['msgSuccess'] = "Registro alterado com sucesso, mas a senha não foi atualizada.";
                }
            } else {
                $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
            }
        } else {
            $_SESSION['msgError'] = "Nenhum registro foi atualizado.";
        }
    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}

// Redireciona após o update
header("Location: index.php?pagina=listaUsuario");
exit;
