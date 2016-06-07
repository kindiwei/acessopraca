<?php
	header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	//dados da conexao
	include 'loginbd_acessopraca.php';
	
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
	$conn = odbc_connect($connection_string,$user,$pass) or die('Erro de conexao com o banco!!');
	
	//aqui ele pega o valor do codigo do estado selecionado no site
	$placa = htmlspecialchars($_GET["placa"]);
	$ativar = htmlspecialchars($_GET["ativar"]);
	
	if($ativar == 'SIM'){
		$ativar = 0;
	}else{
		$ativar = 1;
	}
	
	# query
	$query = 
			"UPDATE Placas
				set ativo = $ativar
			WHERE
				placa='$placa'";
				
	//exec query
	$result = odbc_exec($conn, $query);
	
	odbc_fetch_row($result);

	
	# query
	$query = 
		"select
			p.ativo
		from
			Placas p
		where
			p.placa='$placa'";
	
	# perform the query
	$result = odbc_exec($conn, $query);
	
	odbc_fetch_row($result);
	
	$ativobanco = utf8_encode(odbc_result($result, 1));
	
	echo "Ativo no banco: $ativobanco";

	# close the connection
	odbc_close($conn);
?>