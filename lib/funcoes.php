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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>';
            
            unset($_SESSION['msgSuccess']);
        }

        if (isset($_SESSION['msgError'])) {
            $ret = '<div class="row">
                        <div class="col-12 m-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>' . $_SESSION['msgError'] . '</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
    public static function getStatusRegistro($status) : string
    {
        if ($status == 1) {
            return "Ativo";
        } elseif ($status == 2) {
            return "Inativo";
        } else {
            return "...";
        }
    }

}