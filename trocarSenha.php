<?php

session_start();

if (isset($_POST['loginFornecedor']) || isset($_POST['senhaAtual'])) {
    // Carregar lib do banco de dados
    require_once "lib/Database.php";
    
    // Criar o objeto do banco de dados
    $db = new Database();

    try {
        // Verificar se o nível de acesso é 3 (Fornecedor) ou 1/2 (Usuário)
        if ($_SESSION['nivel'] == 3) {
            // Se o nível for 3 (Fornecedor), buscar na tabela fornecedor
            $data = $db->dbSelect(
                "SELECT * FROM fornecedor WHERE id = ?",
                'first',
                [$_SESSION['userId']] // Garantir que usamos 'userId' consistente
            );
        } elseif ($_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 1) {
            // Se o nível for 1 ou 2 (Usuário), buscar na tabela usuario
            $data = $db->dbSelect(
                "SELECT * FROM usuario WHERE id = ?",
                'first',
                [$_SESSION['userId']] // Garantir que usamos 'userId' consistente
            );
        } else {
            // Caso o nível não seja 1, 2 ou 3, definir uma mensagem de erro
            $_SESSION['msgError'] = "Nível de acesso inválido.";
            return header("Location: index.php?pagina=trocarSenhaView");
        }

        // Verificar a senha atual
        if (password_verify(trim($_POST['senhaAtual']), trim($data['senha']))) {

            // Verificar se a nova senha foi fornecida
            if (trim($_POST['novaSenha']) != '') {

                // Verificar se a nova senha e a confirmação são iguais
                if (trim($_POST['novaSenha']) == trim($_POST['confSenha'])) {

                    // Determinar a tabela para atualizar com base no nível do usuário
                    $table = ($_SESSION['nivel'] == 3) ? 'fornecedor' : 'usuario';

                    // Atualizar a senha no banco de dados
                    $result = $db->dbUpdate(
                        "UPDATE $table SET senha = ? WHERE id = ?",
                        [
                            password_hash(trim($_POST['novaSenha']), PASSWORD_DEFAULT),
                            $_SESSION['userId']
                        ]
                    );

                    // Verificar se a atualização foi bem-sucedida
                    if ($result > 0) {
                        $_SESSION['msgSuccess'] = "Senha alterada com sucesso.";
                    } else {
                        $_SESSION['msgError'] = "Falha na atualização da senha.";
                    }

                } else {
                    $_SESSION['msgError'] = "A nova senha e a confirmação devem ser iguais.";
                }
            } else {
                $_SESSION['msgError'] = "A nova senha não pode estar vazia.";
            }

        } else {
            $_SESSION['msgError'] = "Senha atual inválida.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "Erro: " . $e->getMessage();
    }

} else {
    $_SESSION['msgError'] = "Por favor, preencha todos os campos.";
}

return header("Location: index.php?pagina=trocarSenhaView");
