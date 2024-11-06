<?php 

session_start();

if (isset($_POST['senhaAtual'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {

        // buscar o usuário do e-mail informado no login
        $data = $db->dbSelect(
                                "SELECT * FROM usuario WHERE id = ?",
                                'first',
                                [$_SESSION['idUsuario']]);

        if (password_verify(trim($_POST['senhaAtual']), trim($data['senha']))) {

            if (trim($_POST['novaSenha']) != '') {

                if (trim($_POST['novaSenha']) == trim($_POST['confSenha'])) {

                    $result = $db->dbUpdate("UPDATE usuario
                                            SET senha = ?
                                            WHERE id = ?"
                                            , [
                                                password_hash(trim($_POST['novaSenha']), PASSWORD_DEFAULT),
                                                $_SESSION['userId']
                                            ]);

                    if ($result > 0) {      // sucesso
                        $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
                    } else {
                        $_SESSION['msgError'] = "Falha na atualização da senha";
                    }
                } else {
                    $_SESSION['msgError'] = "Senha e conferência da senha devem ser iguais";
                }

            } else {
                $_SESSION['msgError'] = "Senha e conferência da senha devem ser iguais";
            }
        
        } else {
            $_SESSION['msgError'] = "Senha atual inválida.";
        }

    } catch (\Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 

return header("Location: index.php?pagina=trocarSenhaView");