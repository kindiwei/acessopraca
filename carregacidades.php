<?php
	header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	//dados da conexao
	include 'loginbd_acessopraca.php';
	
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
	$conn = odbc_connect($connection_string,$user,$pass) or die('Erro de conexão com o banco!!');
	
	//aqui ele pega o valor do codigo do estado selecionado no site
	$idestado = htmlspecialchars($_GET["codestados"]);
	
	// cria uma array pra guardar as cidades
	// $cidades = array();
	
	# query
	$sql = 
		"SELECT
			CidadeId, nome
		FROM
			cidade
		WHERE
			EstadoId=$idestado
		ORDER BY
			nome asc";
								
	# perform the query
	$result = odbc_exec($conn, $sql);
	
	$cidades_array = array();
	
	echo "<select>";
	
	while(odbc_fetch_row($result)){
		$codcidade = utf8_encode(odbc_result($result, 1));
		$cidade = utf8_encode(odbc_result($result, 2));
		echo "<option value = ".$codcidade.">".$cidade."</option>";
	}
	
	echo "</select>";
?>