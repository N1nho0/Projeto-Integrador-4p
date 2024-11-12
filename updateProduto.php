<?php
require_once "lib/Database.php";
require_once "lib/Funcoes.php";

if (isset($_POST['descricao'])) {

    $db = new Database();

    try {

        $imagem = $_POST['excluirImagem'];
        $upload  = true;

        if ($_POST['excluirImagem'] != $_FILES['imagem']['name'] and $_FILES['imagem']['name'] != "") {

            //lista de tipos de arquivos permitidos
            $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

            $tamanhoPermitido   = 1024 * 1024 * 5;                                          // 5mb //tamanho máximo (em bytes)
            $imagem             = Funcoes::gerarNomeAleatorio($_FILES['imagem']['name']);   // nome original do arquivo no computador do usuario
            $imagemType         = $_FILES['imagem']['type'];                                // o tipo do arquivo
            $imagemSize         = $_FILES['imagem']['size'];                                // o tamanho do arquivo
            $imagemTemp         = $_FILES['imagem']['tmp_name'];                            // o nome temporario do arquivo
            $imagemError        = $_FILES['imagem']['error'];                               // codigos de possiveis erros na imagem
            $msgError           = "";

            if ($imagemError === 0) {

                $upload = false;

                //veririca o tipo de arquivo enviado
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido!";
                } else if ($imagemSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                    $msgError = "O tamanho do arquivo enviado é inválido!";
                } else { // não houve error, move o arquivo

                    $imagem = Funcoes::gerarNomeAleatorio($imagem);
                    $upload = move_uploaded_file($imagemTemp, 'uploads/produto/' . $imagem);

                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o upload da imagem!";
                    } else {
                        // unlink, ele excluí a imagem fisicamente no servidor
                        if (file_exists('uploads/produto/' . $_POST['excluirImagem'])) {
                            unlink('uploads/produto/' . $_POST['excluirImagem']);
                        }
                    }
                }
            }
        }

        if ($upload) {

            $result = $db->dbUpdate(
                "UPDATE produto
                                        SET descricao = ?, produtocategoria_id = ?, statusCadastro = ?, qtdeEmEstoque = ?, custoTotal = ?, precoVenda = ?, caracteristicas = ?, imagem = ?
                                        WHERE id = ?",
                [
                    $_POST['descricao'],
                    $_POST['produtocategoria_id'],
                    $_POST['statusCadastro'],
                    $_POST['qtdeEmEstoque'],
                    $_POST['custoTotal'],
                    $_POST['precoVenda'],
                    $_POST['caracteristicas'],
                    $imagem,
                    $_POST['id']

                ]
            );

            if ($result) {
                $_SESSION['msgSuccess'] = "Registro alterado com sucesso.";
            }
        } else {
            $_SESSION['msgSuccess'] = "ERROR: " . $msgError;
        }
    } catch (Exception $ex) {
        $_SESSION['msgSuccess'] = '<p style="color: red;">ERROR: ' . $ex->getMessage() . "</p>";
    }
}

return header("Location: index.php?pagina=listaProduto");
