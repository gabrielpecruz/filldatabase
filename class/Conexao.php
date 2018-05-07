<?php

require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "global.php";

class Conexao{

    public static function pegarConexao(){
        try {

            return new PDO(DB_DRIVE. ":host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
        } catch (Exception $e) {
           throw new Error($e);
        }
    }
}