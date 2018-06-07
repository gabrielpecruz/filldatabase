<?php

require_once "vendor/autoload.php";
require_once "global.php";

use FillDataBase\Conexao;




if((isset($_POST['host'])       && $_POST['host']       != "") &&
   (isset($_POST['banco']) 		&& $_POST['banco'] 		!= "") &&
   (isset($_POST['usuario'])    && $_POST['usuario']    != "") &&
   (isset($_POST['senha'])      && $_POST['senha']      != "")){



}else{
	$_SESSION['preenchimento'] = "falha";
}

header("Location: index.php");





