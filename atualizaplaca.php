<?php
	session_start();
	
	if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
		header( 'Cache-Control: no-cache' );
		//dados da conexao
		include 'loginbd_acessopraca.php';
		
		$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
		$conn = odbc_connect($connection_string,$user,$pass) or die('Erro de conexao com o banco!!');
		
		//aqui ele pega o valor do codigo do estado selecionado no site
		$placa = htmlspecialchars($_GET["placa"]);
		$ativar = htmlspecialchars($_GET["ativar"]);
		
		//change value of variable to number
		if($ativar == 'SIM'){
			$ativar = 0;
		}else{
			$ativar = 1;
		}
		
		//here, will update with new datas have been passed with parameters (get method)
		$query_update_new =
			"UPDATE Placas
				set ativo = $ativar,dataatualizacao=getdate()
			WHERE
				placa='$placa'";
		
		//exec update query one time
		$result = odbc_exec($conn, $query_update_new);
		odbc_fetch_row($result);
		
		$query_oldDatas_plate = 
			"select
				[placa]
				,[idmarca]
				,[cor]
				,GETDATE()
				,[data_cadastro]
				,[data_vigencia]
				,[ativo]
				,[idplaca]
			from
				Placas
			where
				placa='$placa'";
		
		#exec one time
		$result = odbc_exec($conn, $query_oldDatas_plate);
		odbc_fetch_row($result);
		
		//get datas of that plate
		$placa = utf8_encode(odbc_result($result, 1));
		$idmarca = utf8_encode(odbc_result($result, 2));
		$cor = utf8_encode(odbc_result($result, 3));
		$datainsercao = utf8_encode(odbc_result($result, 4));
		$datacadastro = utf8_encode(odbc_result($result, 5));
		$datavigencia = utf8_encode(odbc_result($result, 6));
		$ativo = utf8_encode(odbc_result($result, 7));
		$usuario = $_SESSION['login'];
		$idplaca = utf8_encode(odbc_result($result, 8));
		
		# query to insert values of plate history
		$query_insert =
			"insert into
				Placas_Historico
			values (
				(select case when max(idplacahistorico)+1 is null then 1 else max(idplacahistorico)+1 end from placas_historico),
				'$placa',
				$idmarca,
				'$cor',
				'$datainsercao',
				'$datacadastro',
				'$datavigencia',
				$ativo,
				(select idusuario from usuarios where usuario = '$usuario')
				,$idplaca
			)";
		
		//exec the query one time
		odbc_exec($conn, $query_insert);

		# close the connection
		odbc_close($conn);
	}else{
		echo 
			"
			<script>
				alert('Você não está cadastrado ou não faz parte do grupo de permissão de acesso. 6 Segundos para redirecionar...');
				setTimeout(redirect, 6000);
				function redirect() {
					window.location='index.php';
				}
			</script>
			Se não for direcionado automaticamente, clique <a href='index.php'>aqui</a>.";
	}
?>