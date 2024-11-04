<?php

    session_start();

    require_once "lib/Database.php";

    if (isset($_POST['email'])) {

        $db = new Database();

        // buscar o usuário do e-mail informado no login
        $data = $db->dbSelect(
            "SELECT * FROM Usuarios WHERE Email = ?",
            'first',
            [$_POST['email']]);
        
        if ($data === false) {

            // buscar os usuários existentes
            $result = $db->dbSelect("SELECT * FROM Usuarios", 'count');

            if ($result == 0) {

                // Cria o super user

                $result = $db->dbInsert("INSERT INTO Usuarios
                                        (tipo_usuario, nome, email, senha)
                                        VALUES (?, ?, ?, ?)",
                                        [
                                            1,
                                            "Administrador",
                                            "administrador@catalogo.com.br",
                                            password_hash("admin", PASSWORD_DEFAULT)
                                        ]);

                $_SESSION['msgSuccess'] = "Login super usuário criado com sucesso.";

            } else {
                $_SESSION['msgError'] = "Login ou senha inválida !";
            }

        } else {

            // status
            if ($data['Status_Registro'] != 1) {
                $_SESSION['msgError'] = "Seu cadastro está pendente de aprovação ou bloqueado, favor procurar o administrador";
            } else {

                // senha

                if (!password_verify(trim($_POST['senha']), $data['Senha'])) {
                    $_SESSION['msgError'] = "Login ou senha inválida !";
                } else {

                    // confirma login e prepara o acesso

                    // criar flags do usuário logado

                    $_SESSION['userId']     = $data['ID_Usuario'];
                    $_SESSION['userEmail']  = $data['Email'];
                    $_SESSION['userName']   = $data['Nome'];
                    $_SESSION['tipo_Usuario']  = $data['Tipo_Usuario'];

                    // redirecionar o usuário para a página index
                    return header("Location: index.php");
                }
            }
        }

    } else {
        $_SESSION['msgError'] = "Para acessar a área administrativa, favor fazer o login ";
    }

    return header("Location: index.php?pagina=loginView");
