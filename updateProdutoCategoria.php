<?php 

session_start();

if (isset($_POST['descricao'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE produtocategoria
                                SET descricao = ?, statusRegistro = ?
                                WHERE id = ?"
                                , [
                                    $_POST['descricao'],
                                    $_POST['statusRegistro'],
                                    $_POST['id']
                                ]);
        
        if ($result > 0) {      // sucesso
            $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 

return header("Location: index.php?pagina=listaProdutoCategoria");