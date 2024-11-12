<?php

class Funcoes
{
    /**
     * subTitulo
     *
     * @param string $acao 
     * @return string
     */
    public function subTitulo($acao): string
    {
        $ret = "";

        if ($acao == "insert") {
            $ret = " - Novo";
        } elseif ($acao == "update") {
            $ret = " - Alteração";
        } elseif ($acao == "delete") {
            $ret = " - Exclusão";
        } elseif ($acao == "view") {
            $ret = " - Visualização";
        }

        return $ret;
    }

    public static function mensagem(): string
    {
        $ret = "";

        if (isset($_SESSION['msgSuccess'])) {
            $ret = '<div class="row">
                        <div class="col-12 m-3 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>' . $_SESSION['msgSuccess'] . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>';

            unset($_SESSION['msgSuccess']);
        }

        if (isset($_SESSION['msgError'])) {
            $ret = '<div class="row">
                        <div class="col-12 m-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>' . $_SESSION['msgError'] . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>';

            unset($_SESSION['msgError']);
        }

        return $ret;
    }

    /**
     * setValue
     *
     * @param array $dados 
     * @param string $key 
     * @param mixed $default 
     * @return mixed
     */
    public static function setValue($dados, $key, $default = "")
    {
        if (isset($dados[$key])) {
            return $dados[$key];
        }
        return $default;
    }

    /**
     * getStatusRegistro
     *
     * @param int $status 
     * @return string
     */
    public static function getStatusRegistro($status): string
    {
        if ($status == 1) {
            return "Ativo";
        } elseif ($status == 2) {
            return "Inativo";
        } else {
            return "...";
        }
    }

    /**
     * getAdministrador
     *
     * @return bool
     */
    public static function getAdministrador()
    {
        if (!isset($_SESSION['nivel'])) {
            return false;
        } else {
            if ($_SESSION['nivel'] == 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * verificarLogin
     *
     * Função estática que verifica se o usuário está logado
     *
     * @return bool
     */
    public static function getLogado(): bool
    {
        // Verifica se as variáveis de sessão essenciais estão setadas
        if (isset($_SESSION['userId']) && isset($_SESSION['userEmail']) && isset($_SESSION['userName']) && isset($_SESSION['userNivel'])) {
            return true; // Usuário está logado
        } else {
            return false; // Usuário não está logado
        }
    }


    /**
     * valorBr
     *
     * @param mixed $valor 
     * @param int $decimais 
     * @return float
     */
    public static function valorBr($valor, $decimais = 2)
    {
        return number_format($valor, $decimais, ",", ".");
    }

    /**
     * strDecimais
     *
     * @param string $valor
     * @return float
     */
    public static function strDecimais($valor)
    {
        // Remove os pontos (separadores de milhar) e substitui a vírgula por ponto
        $valorFormatado = str_replace(",", ".", str_replace(".", "", $valor));

        // Retorna o valor como float
        return (float) $valorFormatado;
    }

    /**
     * strInt
     *
     * Converte uma string para inteiro, removendo qualquer caractere não numérico.
     *
     * @param string $valor
     * @return int
     */
    public static function strInt($valor)
    {
        // Remove qualquer caractere não numérico
        $valor = preg_replace('/\D/', '', $valor);

        // Converte para inteiro
        return (int) $valor;
    }


    /**
     * gerarNomeAleatorio
     *
     * @param string $nomeArquivo 
     * @return string
     */
    public static function gerarNomeAleatorio($nomeArquivo)
    {
        $retNome    = "";
        $arquivo    = explode(".", $nomeArquivo);
        $arqExt     = $arquivo[count($arquivo) - 1];
        $arqNome    = str_replace('.' . $arqExt, "",  $nomeArquivo);
        $aleatorio  = rand(0, 99999);

        return $arqNome . '-' . $aleatorio . '.' .  $arqExt;
    }


    /**
     * userLogado
     *
     * @return bool
     */
    public static function userLogado($nivel = 1)
    {
        if (isset($_SESSION['userId'])) {
            if ($_SESSION['userNivel'] == $nivel) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
