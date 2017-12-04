<?php

require_once "global.php";


/** 
 * O if abaixo serve para controlar a sessão
 * 
 * Se a sessão estiver ativa e esta sessão conter uma variável chamada sucesso
 * quer dizer que esse arquivo já foi aberto antes e consegui abrir uma conexão
 * com o banco de dados.
 * 
 * Neste caso a sessão deve ser destruída porque a página foi redirecionada da index.php
 * pelo botão 'logout'.
 * 
 * No entanto, se se o 	'if' resultar em falso, quer dizer que ainda não foi feita uma
 * conexão com o banco, logo não há porque destruir a sessão que não foi criada
 * 
 * Este trecho de código foi extraído da página da documentação oficial do PHP
 * 
 * link("http://php.net/manual/pt_BR/function.session-destroy.php");
 * 
*/

if(isset($_SESSION['sucesso']) && isset($_SESSION)){
	// Apaga todas as variáveis da sessão
	$_SESSION = array();

	// Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
	// Nota: Isto destruirá a sessão, e não apenas os dados!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// Por último, destrói a sessão
	session_destroy();
}

if((isset($_POST['host'])       && $_POST['host']       != "") &&
   (isset($_POST['banco']) 		&& $_POST['banco'] 		!= "") &&
   (isset($_POST['usuario'])    && $_POST['usuario']    != "") &&
   (isset($_POST['senha'])      && $_POST['senha']      != "")){

	//Remove a variável que mostrava erro de preenchimento
	unset($_SESSION['preenchimento']);

	//Dados para acessar o banco
	$db_host     = $_POST['host'];
	$db_name     = $_POST['banco'];
	$db_user     = $_POST['usuario'];
	$db_password = $_POST['senha'];

	//Configuração do config.php
	$file = fopen("config.php", "w");

	$string = 
	'<?php 

	define("DB_DRIVE", "mysql"); 
	define("DB_HOSTNAME", "'.$db_host.'");
	define("DB_DATABASE", "'.$db_name.'");
	define("DB_USER",     "'.$db_user.'");
	define("DB_PASSWORD", "'.$db_password.'");
	';
	
	fwrite($file, $string);

	//Conexão
	try{
		$conexao = Conexao::pegarConexao();
	} catch( Exception $e){
		$_SESSION['erro-conexao'] = "erro-conexao";
	}
	

	if($conexao){
		$_SESSION['sucesso'] = "sucesso";
		$_SESSION['banco']   = $db_name;
		$_SESSION['usuario'] = $db_user;
		$_SESSION['senha']   = $db_password;
		$_SESSION['host']    = $db_host;

		//Remove a variável que mostrava erro de conexão
		unset($_SESSION['erro-conexao']);
	}

}else{
	$_SESSION['preenchimento'] = "falha";
}

header("Location: index.php");





