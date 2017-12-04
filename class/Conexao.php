<?php 

require_once "global.php";

class Conexao{

    public static function pegarConexao(){
        return new PDO(DB_DRIVE. ":host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
    }
}