<?php
	header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	//dados da conexao
	include 'loginbd_acessopraca.php';
	
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
	$conn = odbc_connect($connection_string,$user,$pass) or die('Erro de conexao com o banco!!');
	
	//aqui ele pega o valor do codigo do estado selecionado no site
	$placa = htmlspecialchars($_GET["placa"]);
	$ativo = htmlspecialchars($_GET["ativo"]);
	
	if($ativo == 'SIM'){
		$ativo = 1;
	}else{
		$ativo = 0;
	}
	
	# query
	$query = 
			"UPDATE Placas
				set ativo = $ativo
			WHERE
				placa='$placa'";
				
	//exec query
	$result = odbc_exec($conn, $query);
	
	odbc_fetch_row($result);

	# close the connection
	odbc_close($conn);
?>