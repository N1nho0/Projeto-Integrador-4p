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

        foreach ($_FILES as $value) {

            // Lista de tipos de arquivos permitidos
            $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

            $tamanhoPermitido = 1024 * 1024 * 5; // 5mb // tamanho máximo (em bytes)
            $imagem = Funcoes::gerarNomeAleatorio($value['name']); // nome original do arquivo no computador do usuário
            $imagemType = $value['type']; // o tipo do arquivo
            $imagemSize = $value['size']; // o tamanho do arquivo
            $imagemTemp = $value['tmp_name']; // o nome temporário do arquivo
            $imagemError = $value['error']; // códigos de possíveis erros na imagem

            $upload = false;
            $msgError = "";

            if ($imagemError === 0) {
                // Verifica o tipo de arquivo enviado
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido! (" . $imagem . ")";
                } else if ($imagemSize > $tamanhoPermitido) { // Verifica o tamanho do arquivo enviado
                    $msgError = "O tamanho do arquivo enviado é inválido! (" . $imagem . ")";
                } else { // Não houve erro, move o arquivo
                    $upload = move_uploaded_file($imagemTemp, 'uploads/produto/' . $imagem);

                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o upload da imagem (" . $imagem . ")";
                    }
                }
            }
        }

        if ($upload) {

            // Alterando a consulta de inserção para incluir o fornecedorId
            $result = $db->dbInsert(
                "INSERT INTO produto
                (descricao, produtocategoria_id, statusCadastro, qtdeEmEstoque, custoTotal, precoVenda, caracteristicas, imagem, fornecedorid)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", // Adiciona fornecedor_id no SQL
                [
                    $_POST['descricao'],
                    $_POST['produtocategoria_id'],
                    $_POST['statusCadastro'],
                    $_POST['qtdeEmEstoque'],
                    $_POST['custoTotal'],
                    $_POST['precoVenda'],
                    $_POST['caracteristicas'],
                    $imagem,
                    $_POST['fornecedorId'] // Aqui pega o valor do fornecedorId
                ]
            );

            if ($result > 0) { // Sucesso
                $_SESSION['msgSuccess'] = "Registro inserido com sucesso.";
            }
        } else {
            $_SESSION['msgError'] = "Falha no upload: " . $msgError;
        }
    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}

return header("Location: index.php?pagina=fornecedorMenu");
