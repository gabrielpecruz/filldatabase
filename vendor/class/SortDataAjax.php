<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/05/18
 * Time: 19:51
 */

namespace FillDataBase;

require_once '../autoload.php';

class SortDataAjax extends Ajax
{

    public function fillDataBase($colunas)
    {
        //Trasnforma o Json em array
        $colunasArray = json_decode($colunas);

        //Prepara o insert
        $insert = $this->insertPrepare($colunasArray);

    }

    private function insertPrepare($colunas)
    {

        $this->dataTrate($colunas);

        //INSERT INTO $tabela ($campo1, ... ) VALUES ($item1, ...)
//        $colunas = [];
//        $valores = [];
//
//        foreach ($colunas as $coluna) {
//
//            array_push($colunas, $coluna['nomeColuna']);
//            array_push($valores, $coluna['tipoColuna']);
////            $coluna['coluna'], ... ) VALUES ($coluna['coluna'], ...)
//        }
//
//        $inserts = "INSERT INTO tabela (";
//
//        foreach ($colunas as $coluna) {
//
//            $coluna['coluna'], ... ) VALUES ($coluna['coluna'], ...)
//        }
//        exit;
    }

    private function dataTrate($data)
    {
        //Cria o objeto da biblioteca Faker

        $faker = Faker\Factory::create();

        //Inicializa os arrays de colunas e valores
        $colunas = [];

        foreach ($data as $coluna) {
            $coluna = [];

            array_push($coluna['coluna'], $coluna['nomeColuna']);
            array_push($coluna['valor'] , $coluna['tipoColuna']);

            array_push($colunas, $coluna);
        }

        var_dump($colunas);exit;

    }

    private static $dataType = array('int', 'varchar');
}

$ajax = new SortDataAjax();