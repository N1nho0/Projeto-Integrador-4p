<?php 

session_start();

if (isset($_POST['nome'])) {

    $atualizaSenha = false;

    if (trim($_POST['senha']) != '') {
        if (trim($_POST['senha']) == trim($_POST['confSenha'])) {
            $atualizaSenha = false;
        } else {
            $_SESSION['msgError'] = "Senha e conferência da senha não estão iguais";
        }
    }
    
    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE usuario
                                SET nome = ?, email = ?, nivel = ?, statusRegistro = ?
                                WHERE id = ?"
                                , [
                                    $_POST['nome'],
                                    $_POST['email'],
                                    $_POST['nivel'],
                                    $_POST['statusRegistro'],
                                    $_POST['id']
                                ]);
        
        if ($result > 0) {      // sucesso

            if ($$atualizaSenha) {

                $result = $db->dbUpdate("UPDATE usuario
                                        SET senha = ?
                                        WHERE id = ?"
                                        , [
                                            password_hash(trim($_POST['senha']), PASSWORD_DEFAULT),
                                            $_POST['id']
                                        ]);

            }

            $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
        }

    } catch (\Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 

return header("Location: index.php?pagina=listaUsuario");