<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 07/05/18
 * Time: 00:16
 */

require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "class/Ajax.php";

/**
 * Class CamposAjax
 */
class CamposAjax extends Ajax
{
    /**
     * @param $tabela
     */
    public function ajaxCampos($tabela)
    {
        $campos = Consulta::retorna_campos($tabela);

        echo json_encode($campos);
    }
}

$ajax = new CamposAjax();