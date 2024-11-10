<?php
    session_start();

    require_once "lib/Database.php";

    if (isset($_POST['id'])) {

        $db = new Database();

        try {
            $result = $db->dbDelete("DELETE FROM produto 
                                    WHERE id = ?",
                                    [$_POST['id']]
                                );

            if ($result) {

                // unlink, ele excluí a imagem fisicamente no servidor
                if (file_exists('uploads/produto/' . $_POST['excluirImagem'])) {
                    unlink('uploads/produto/' . $_POST['excluirImagem']);
                }

                $_SESSION['msgSuccess'] = "Registro excluído com sucesso.";
            } else {
                $_SESSION['msgSuccess'] = "Falha ao tentar excluír o registro.";
            }
            
        } catch (Exception $ex) {
            $_SESSION['msgSuccess'] = '<p style="color: red;">ERROR: '. $ex->getMessage(). "</p>";
        }

    }

    return header("Location: index.php?pagina=listaProduto");
