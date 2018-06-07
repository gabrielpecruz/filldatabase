<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/05/18
 * Time: 19:51
 */

namespace FillDataBase;

use Faker\Factory;

require_once '../autoload.php';

class SortDataAjax extends Ajax
{

    private $faker;

    private $types;



    public function __construct(){

        $this->faker = Factory::create();

        $this->types = [
            "varchar(255)" => $this->faker->name(),
        ];

        parent::__construct();
    }

    public function fillDataBase($colunas)
    {
        //Trasnforma o Json em array
        $colunasArray = json_decode($colunas);

        //Prepara o insert
        $insert = $this->insertPrepare($colunasArray);

    }

    private function insertPrepare($dados)
    {
        //Trata os dados para um array
        $this->dataTrate($dados);


        //INSERT INTO $tabela ($campo1, ... ) VALUES ($item1, ...)
        $insert = "INSERT INTO filldatabase (";

        //Gera a primeira parte do INSERT
        $cols = "";
        foreach ($dados as $key => $colunas) {
            foreach ($colunas as $coluna) {
                $cols .= " " . $coluna['nome'] . ",";
            }
        }

        //Remove a última vírgula das colunas
        $insert .= $this->trataVirgula($cols);

        $insert .= ") VALUES (";

        //Gera os dados de fato usando o \Faker
        $vals = "";
        foreach ($dados as $key => $colunas) {
            foreach ($colunas as $coluna) {

                $dado = $this->gerarDado($coluna['valor']);

                $vals .= " " . $dado . ",";
            }
        }

        //Remove a última vírgula dos valores
        $insert .= $this->trataVirgula($vals);

        $insert .= ")";


        var_dump($insert);exit;

    }

    private function dataTrate(&$data)
    {
        //Inicializa os arrays de colunas e valores
        $colunas = [];

        foreach ($data as $columns) {
            foreach ($columns as $column) {

                $coluna = [
                    'nome' => $column->nomeColuna,
                    'valor' => $column->tipoColuna
                ];

                array_push($colunas, $coluna);
            }
        }

        $data = [];
        array_push($data, $colunas);
    }

    private function gerarDado($tipoDado)
    {
        $tipo = strtolower($tipoDado);
        return $this->getDado($tipo);
    }

    private function getDado($tipo)
    {
      return $this->types[$tipo];
    }


}

$ajax = new SortDataAjax();