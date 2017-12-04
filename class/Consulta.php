<?php

require_once "global.php";



class Consulta{

    public static function retorna_tabelas(){

        $query = "show tables";
        $conexao = Conexao::pegarConexao();

        $resultado = $conexao->query($query);
        
        $tabelas = array();

        foreach($resultado as $key => $tabela){
            array_push($tabelas, $tabela['Tables_in_'. DB_DATABASE]);
        }

        return $tabelas;
    }

    public static function retorna_campos($tabela){

        $conexao = Conexao::pegarConexao();
        $query = "desc $tabela";
        $results = $conexao->query($query);
        
        $campos = array();

        foreach($results as $key => $campo){
            if(!$campo['Key'] == "PRI"){
                array_push($campos, $campo['Field']);
            }
        }

        return $campos;

    }
    

}