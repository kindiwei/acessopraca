<?php
	$user = 'sa';
	$pass = 'bd@sql!009';
	$server = 'sbe1-cart\cartsqlserver';
	$database = 'ACESSOPRACA';
	
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
	$conn = odbc_connect($connection_string,$user,$pass) or die('<script>alert("Erro de conexão com o banco!!");</script>');
?>