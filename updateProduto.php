<?php
require_once "lib/Database.php";
require_once "lib/Funcoes.php";

if (isset($_POST['descricao'])) {

    $db = new Database();

    try {

        // Inicializa a variável para a imagem
        $imagem = $_POST['excluirImagem'];
        $upload = true;

        // Verifica se uma nova imagem foi enviada
        if ($_FILES['imagem']['name'] != "") {

            // Lista de tipos de arquivos permitidos
            $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
            $tamanhoPermitido = 1024 * 1024 * 5; // 5mb // tamanho máximo (em bytes)

            // Informações sobre o arquivo da imagem
            $imagem = Funcoes::gerarNomeAleatorio($_FILES['imagem']['name']);   // Nome aleatório para o arquivo
            $imagemType = $_FILES['imagem']['type'];                          // Tipo do arquivo
            $imagemSize = $_FILES['imagem']['size'];                          // Tamanho do arquivo
            $imagemTemp = $_FILES['imagem']['tmp_name'];                      // Nome temporário do arquivo
            $imagemError = $_FILES['imagem']['error'];                        // Erro do arquivo
            $msgError = "";

            // Verifica se houve erro no upload
            if ($imagemError === 0) {

                // Verifica o tipo do arquivo
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido!";
                } else if ($imagemSize > $tamanhoPermitido) { // Verifica o tamanho
                    $msgError = "O tamanho do arquivo enviado é inválido!";
                } else { // Caso não haja erro, move o arquivo
                    $upload = move_uploaded_file($imagemTemp, 'uploads/produto/' . $imagem);

                    // Se não conseguiu mover o arquivo
                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o upload da imagem!";
                    } else {
                        // Se a imagem anterior existir, exclui ela
                        if (file_exists('uploads/produto/' . $_POST['excluirImagem'])) {
                            unlink('uploads/produto/' . $_POST['excluirImagem']);
                        }
                    }
                }
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
                SET descricao = ?, produtocategoria_id = ?, statusCadastro = ?, qtdeEmEstoque = ?, custoTotal = ?, precoVenda = ?, caracteristicas = ?, imagem = ?, fornecedor_id = ?
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

            if ($result) {
                $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
            }

        } else {
            $_SESSION['msgError'] = "Erro no upload: " . $msgError;
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = 'ERROR: ' . $ex->getMessage();
    }
}

// Redireciona para a lista de produtos
return header("Location: index.php?pagina=listaProduto");

?>
