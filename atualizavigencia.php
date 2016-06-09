<?php
	session_start();
	
	if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
		header( 'Cache-Control: no-cache' );
		// header( 'Content-type: application/xml; charset="utf-8"', true );
		//dados da conexao
		include 'loginbd_acessopraca.php';
		
		$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
		$conn = odbc_connect($connection_string,$user,$pass) or die('Erro de conexao com o banco!!');
		
		//aqui ele pega o valor do codigo do estado selecionado no site
		$placa = htmlspecialchars($_GET["placa"]);
		
		//here, will update with new datas have been passed with parameters (get method)
		$query_update_new =
				"UPDATE Placas
					set data_vigencia = DATEADD(YEAR,1,GETDATE()),dataatualizacao=GETDATE()
				WHERE
					placa='$placa'";
		
		//exec update query one time
		$result = odbc_exec($conn, $query_update_new);
		odbc_fetch_row($result);
		
		$query_oldDatas_plate = 
			"select
				[idplaca]
				,[placa]
				,[idmarca]
				,[cor]
				,GETDATE()
				,GETDATE()
				,[data_vigencia]
				,[ativo]
			from
				Placas
			where
				placa='$placa'";
		
		#exec one time
		$result = odbc_exec($conn, $query_oldDatas_plate);
		odbc_fetch_row($result);

		//get datas of that plate
		$idplaca = utf8_encode(odbc_result($result, 1));
		$placa = utf8_encode(odbc_result($result, 2));
		$idmarca = utf8_encode(odbc_result($result, 3));
		$cor = utf8_encode(odbc_result($result, 4));
		$datainsercao = utf8_encode(odbc_result($result, 5));
		$datacadastro = utf8_encode(odbc_result($result, 6));
		$datavigencia = utf8_encode(odbc_result($result, 7));
		$ativo = utf8_encode(odbc_result($result, 8));
		$usuario = $_SESSION['login'];
		
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
				(select idusuario from usuarios where usuario = '$usuario'),
				$idplaca
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