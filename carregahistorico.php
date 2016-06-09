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
		
		
		echo '<table align="center" style="border-collapse: collapse;border: 1px solid black;">';
		echo 
			"<!--Início Cabeçalho/Exemplos-->
				<tr style='background:#d4d4d4;border: 1px solid black;'>
					<th style='border: 1px solid black;'>Placa</th>
					<th style='border: 1px solid black;'>Marca</th>
					<th style='border: 1px solid black;'>Modelo</th>
					<th style='border: 1px solid black;'>Cor</th>
					<th style='border: 1px solid black;'>Data Cadastro Historico</th>
					<th style='border: 1px solid black;'>Vigencia Historico</th>
					<th style='border: 1px solid black;'>Ativo Historico</th>
					<th style='border: 1px solid black;'>Data Insercao</th>
					<th style='border: 1px solid black;'>Atualizado por</th>
				</tr>
			<!--Fim Cabeçalho-->";
		
		$query_history_plate1 = 
			"select
				ph.placa,
				m.marca,
				p.modelo,
				ph.cor,
				ph.datacadastro_hist,
				ph.datavigencia_hist,
				case when ph.ativo_hist = 1 then 'ATIVO'
				else 'INATIVO'
				end,
				ph.datainsercao,
				u.usuario
			FROM
				Placas_Historico ph
				inner join placas p on p.idplaca = ph.idplaca
				left join marcas m on m.idmarca = ph.idmarca
				left join Usuarios u on u.idusuario = ph.idusuario
			where
				ph.placa='$placa'
			order by 8 asc
			";
		
		// echo "<br><br>$query_history_plate1";
		
		#exec one time
		$result = odbc_exec($conn, $query_history_plate1);
		
		while(odbc_fetch_row($result)){
			//get history datas of the plate
			$placa1 = utf8_encode(odbc_result($result, 1));
			$marca = utf8_encode(odbc_result($result, 2));
			$modelo = utf8_encode(odbc_result($result, 3));
			$cor = utf8_encode(odbc_result($result, 4));
			$datacadatrohist = utf8_encode(odbc_result($result, 5));
			$datavigenciahist = utf8_encode(odbc_result($result, 6));
			$ativohist = utf8_encode(odbc_result($result, 7));
			$datainsercao = utf8_encode(odbc_result($result, 8));
			$useratualizacao = utf8_encode(odbc_result($result, 9));

			echo
				"<tr id='idlinha$placa' align='center' style='background:#eee;'>
					<td style='border: 1px solid black;'>$placa1</td>
					<td style='border: 1px solid black;'>$marca</td>
					<td style='border: 1px solid black;'>$modelo</td>
					<td style='border: 1px solid black;'>$cor</td>
					<td style='border: 1px solid black;'>".date_format(date_create($datacadatrohist), 'd-m-Y H:i')."</td>
					<td style='border: 1px solid black;'>".date_format(date_create($datavigenciahist), 'd-m-Y H:i')."</td>
					<td style='border: 1px solid black;'>$ativohist</td>
					<td style='border: 1px solid black;'>".date_format(date_create($datainsercao), 'd-m-Y H:i')."</td>
					<td style='border: 1px solid black;'>$useratualizacao</td>
				</tr>";
		}
		
		echo '</table>';
		
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