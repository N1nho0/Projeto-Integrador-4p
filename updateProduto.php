<?php
session_start();

if (isset($_POST['descricao'])) {
    var_dump($_POST);
    // Carrega lib do banco de dados
    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    // Criar o objeto do banco de dados
    $db = new Database();

    try {
        //
        // Download de arquivos e imagens
        //
        
        // Inicializa a variável para a imagem
        $imagem = $_POST['excluirImagem'];
        $upload = true;
        $msgError = "";

        // Verifica se uma nova imagem foi enviada
        if ($_FILES['imagem']['name'] != "") {
            // Lista de tipos de arquivos permitidos
            $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
            $tamanhoPermitido = 1024 * 1024 * 5; // 5mb // tamanho máximo (em bytes)
            $imagem = Funcoes::gerarNomeAleatorio($_FILES['imagem']['name']); // Nome aleatório para o arquivo
            $imagemType = $_FILES['imagem']['type']; // Tipo do arquivo
            $imagemSize = $_FILES['imagem']['size']; // Tamanho do arquivo
            $imagemTemp = $_FILES['imagem']['tmp_name']; // Nome temporário do arquivo
            $imagemError = $_FILES['imagem']['error']; // Erro do arquivo

            if ($imagemError === 0) {
                // Verifica o tipo de arquivo enviado
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido! (" . $imagem . ")";
                } else if ($imagemSize > $tamanhoPermitido) { // Verifica o tamanho do arquivo
                    $msgError = "O tamanho do arquivo enviado é inválido! (" . $imagem . ")";
                } else { // Caso não haja erro, move o arquivo
                    $upload = move_uploaded_file($imagemTemp, 'uploads/produto/' . $imagem);

                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o upload da imagem (" . $imagem . ")";
                    } else {
                        // Se a imagem anterior existir, exclui ela
                        if (file_exists('uploads/produto/' . $_POST['excluirImagem']) && $_POST['excluirImagem'] != "") {
                            unlink('uploads/produto/' . $_POST['excluirImagem']);
                        }
                    }
                }
            } else {
                $msgError = "Erro no upload da imagem!";
            }
        } else {
            // Se não foi enviada uma nova imagem, mantemos a imagem anterior
            $imagem = $_POST['excluirImagem'];
        }

        // Se o upload foi bem-sucedido ou a imagem foi mantida, faz o update
        if ($upload || $_FILES['imagem']['name'] == "") {

            // Atualiza os dados do produto
            $result = $db->dbUpdate(
                "UPDATE produto
                SET descricao = ?, produtocategoria_id = ?, statusCadastro = ?, qtdeEmEstoque = ?, custoTotal = ?, precoVenda = ?, caracteristicas = ?, imagem = ?, fornecedorid = ?
                WHERE id = ?",
                [
                    $_POST['descricao'],
                    $_POST['produtocategoria_id'],
                    $_POST['statusCadastro'],
                    $_POST['qtdeEmEstoque'],
                    $_POST['custoTotal'],
                    $_POST['precoVenda'],
                    $_POST['caracteristicas'],
                    $imagem,  // Aqui passamos a imagem (nova ou mantida)
                    $_POST['fornecedorId'], // Fornecedor (novo campo)
                    $_POST['id'] // ID do produto a ser atualizado
                ]
            );

            if ($result > 0) { // Sucesso
                $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
            } else {
                $_SESSION['msgError'] = "Erro ao atualizar o registro.";
            }
        } else {
            $_SESSION['msgError'] = "Erro no upload: " . $msgError;
        }
    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}

// Redireciona para a lista de produtos
header("Location: index.php?pagina=listaProduto");
exit();
?>
