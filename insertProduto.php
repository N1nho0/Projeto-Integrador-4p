<?php 

session_start();

if (isset($_POST['titulo'])) {

    // Carrega lib do banco de dados
    require_once "lib/Database.php";
    //
    require_once "lib/funcoes.php";

    // criar o objeto do banco e dados
    $db = new Database();

    try {
        //
        // Download de arquivos e imagens
        //

        $cont = 1;

        foreach ($_FILES as $value) {

            //lista de tipos de arquivos permitidos
            $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
            
            $tamanhoPermitido   = 1024 * 1024 * 5;                                          // 5mb //tamanho máximo (em bytes)
            $imagem             = Funcoes::gerarNomeAleatorio($value['name']);   // nome original do arquivo no computador do usuario
            $imagemType         = $value['type'];                                // o tipo do arquivo
            $imagemSize         = $value['size'];                                // o tamanho do arquivo
            $imagemTemp         = $value['tmp_name'];                            // o nome temporario do arquivo
            $imagemError        = $value['error'];                               // codigos de possiveis erros na imagem

            $upload             = false;
            $msgError           = "";

            if ($imagemError === 0) {
                //veririca o tipo de arquivo enviado
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido! (" . $imagem . ")";
                } else if ($imagemSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                    $msgError = "O tamanho do arquivo enviado é inválido! (" . $imagem . ")";
                } else { // não houve error, move o arquivo
                    $upload = move_uploaded_file($imagemTemp, 'uploads/quemsomos/' . $imagem);

                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o upload da imagem (" . $imagem . ")";
                    }

                    if ($cont == 1) {
                        $imagem1 = $imagem;
                    } else {
                        $imagem2 = $imagem;
                    }
        
                    $cont++;

                }
            }
        }

        if ($upload) {

            $result = $db->dbInsert("INSERT INTO quemsomos
                                    (titulo, texto, imagem1, imagem2, statusRegistro)
                                    VALUES (?, ?, ?, ?, ?)"
                                    ,[
                                        $_POST['titulo'],
                                        $_POST['texto'],
                                        $imagem1,
                                        $imagem2,
                                        $_POST['statusRegistro']
                                    ]);
            
            if ($result > 0) {      // sucesso
                $_SESSION['msgSuccess'] = "Registro inserido com sucesso.";
            } 
        
        } else {
            $_SESSION['msgError'] = "Falha no upload: " . $msgError;
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }

} 

return header("Location: index.php?pagina=listaQuemSomos");