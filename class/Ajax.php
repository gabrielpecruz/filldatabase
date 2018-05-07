<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 06/05/18
 * Time: 20:40
 */


require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "class/Consulta.php";

$tabela = $_POST['tabela'];

$campos = Consulta::retorna_campos($tabela);

echo json_encode($campos);




