<?php 

session_start();

if (isset($_POST['sigla'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE uf
                                SET sigla = ?, descricao = ?, statusRegistro = ?
                                WHERE id = ?"
                                , [
                                    $_POST['sigla'],
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

return header("Location: index.php?pagina=listaUf");