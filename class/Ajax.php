<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 06/05/18
 * Time: 20:40
 */


require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "class/Consulta.php";

/**
 * Class Ajax
 */
abstract class Ajax
{

    /**
     * @var
     */
    private $function;

    /**
     * @var
     */
    private $params;

    /**
     * Ajax constructor.
     */
    public function __construct()
    {
        //Pega o nome da função via GET
        $this->function = $_GET['function'];

        //Pega os parâmetros via POST
        $this->params   = $_POST['params'];

        //Prepara a chamada da função
        $this->functionPrepare();

        //Chama a função de fato
        $this->{$this->function}($this->params);
    }

    /**
     *
     */
    public function functionPrepare()
    {
        //Variável Temporária
        $temp = "";

        //Põe todos os parâmetros na temporária separados por virgula
        foreach ($this->params as $param) {
            $temp .= " $param,";
        }

        //Procura a posição da última ocorrência da vírgula
        $last = strripos($temp, ",");

        //Onde ficarão os parâmetros
        $params = "";

        //Verifica se a última posição é de fato uma vírgula. Se sim, põe a string sem a vírgula em $params
        if ($temp[$last] === ',') {
            $params = substr($temp, 0, $last);
        }

        //Por fim armazena os parâmetros em $this->params
        $this->params = $params;
    }
}
