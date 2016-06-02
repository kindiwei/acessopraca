<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
	session_start();
?>

<html>
	<head>
		<title>Cadastro de veículos autorizados - Bloqueio viário da Prefeitura de Palmital</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="content-language" content="pt-br">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id="site">
			<div id="cabecalho">
				<div id="login">
					<form method="post" action="login.php">
						<table>
							<tr><td>Login:</td><td><input type="text" name="login" size=15></td></tr>
							<tr><td>Senha:</td><td><input type="password" name="senha" size=15></td></tr>
							<tr><td colspan="2" align="center"><input type="submit" value="Entrar" name="Submit"></td></tr>
							<tr>
								<td colspan="2" align="center">
									<?php
										session_start();
										if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true) or (strlen($_SESSION['login'])==0) ){
											echo
												"<div id='cadastro_esqueci'>
													<a href='cadastrousuarios.php'>Cadastrar</a>&nbsp;&nbsp;&nbsp;&nbsp;
													<a href='#'>Esqueci minha senha</a>
												</div>";
										}else{
											echo
												"<div id='cadastro_esqueci'>
													Olá, ".$_SESSION["login"].
												"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='logoff.php'>LOGOUT</a></div>";
										}
									?>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div id="menu">
				<ul>
					<li><a href="index.php">Cadastro de Placas</a></li>
					<li><a href="placascadastradas.php">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<h1 align="center"><u>Placas Cadastradas</u></h1><br>
				<!--<form name="contato" onsubmit="return TestaCampos();" action="envia_email.php" method="post">-->
					<table border="1" align="center">
						<?php
							if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
								include 'loginbd_acessopraca.php';
								
								// $datainicial = $_POST['datainicial1'];
								// $datafinal = $_POST['datafinal1'];
								
								# query
								$query = 
									"select
										placa,
										marca,
										modelo,
										cor,
										estado,
										cidade,
										qtd_eixos,
										data_cadastro,
										data_vigencia,
										ativo
									from
										Placas";
								
								# perform the query
								$result = odbc_exec($conn, $query);
								
								echo "
									<!--Início Cabeçalho/Exemplos-->
										<tr>
											<th>Placa</th>
											<th>Modelo</th>
											<th>Marca</th>
											<th>Cor</th>
											<th>Cidade</th>
											<th>Estado</th>
											<th>Eixos</th>
											<th>Data Cadastro</th>
											<th>Vigência até</th>
											<th>Ativo</th>
										</tr>
										<tr align='center' style='background:#FA8072;color:white;'>
											<td><b><a href='#' id='placa_teste1'>TTT9999</a></b></td>
											<td>TXND 4.0</td>
											<td>".strtoupper('Volkswagen')."</td>
											<td>BRANCO</td>
											<td>SP</td>
											<td>BAURU</td>
											<td>5</td>
											<td>2016-06-02 15:11:35</td>
											<td>2017-06-02 15:11:35</td>
											<td>NÃO</td>
										</tr>
										<tr align='center' style='background:#FA8072;color:white;'>
											<td><b><a href='#' id='placa_teste2'>YYY8888</a></b></td>
											<td>VLV 5.2</td>
											<td>VOLVO</td>
											<td>VERMELHO</td>
											<td>PR</td>
											<td>CURITIBA</td>
											<td>7</td>
											<td>2016-06-02 15:12:10</td>
											<td>2017-06-02 15:12:10</td>
											<td>NÃO</td>
										</tr>
									<!--Fim Cabeçalho/Exemplos-->";
								
								while(odbc_fetch_row($result)){
									$placa = utf8_encode(odbc_result($result, 1));
									$marca = utf8_encode(odbc_result($result, 2));
									$modelo = utf8_encode(odbc_result($result, 3));
									$cor = utf8_encode(odbc_result($result, 4));
									$estado = utf8_encode(odbc_result($result, 5));
									$cidade = utf8_encode(odbc_result($result, 6));
									$qtd_eixos = utf8_encode(odbc_result($result, 7));
									$data_cadastro = utf8_encode(odbc_result($result, 8));
									$data_vigencia = utf8_encode(odbc_result($result, 9));
									$ativo = utf8_encode(odbc_result($result, 10));
									
									//testa campo null e substitui por vazio
									// if (is_null($requisitante)){
										// $requisitante = '  ';
									// }
									
									if($ativo == '1'){
										$ativo = 'SIM';
										echo
											"<tr align='center' style='background:#68ff88;'>
												<td><a href='#'>$placa</a></td><td>$modelo</td><td>$marca</td><td>$cor</td><td>$estado</td>
												<td>$cidade</td><td>$qtd_eixos</td><td>$data_cadastro</td><td>$data_vigencia</td><td>$ativo</td>
											</tr>";
									}else{
										$ativo = 'NÃO';
										"<tr align='center' style='background:#FA8072;color:white;'>
												<td><a href='#'>$placa</a></td><td>$modelo</td><td>$marca</td><td>$cor</td><td>$estado</td>
												<td>$cidade</td><td>$qtd_eixos</td><td>$data_cadastro</td><td>$data_vigencia</td><td>$ativo</td>
											</tr>";
									}
								}
								
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
						
					</table>
				<!--</form>-->
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei - CART
			</div>
		</div>
	</body>
</html>