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
		
		<script>
			function carregaDivExclusao(valor1,ativo1) {
				if (ativo1 == 'SIM'){
					document.getElementById("idlinha"+valor1).style.background = "#FA8072";
					document.getElementById("idlinha"+valor1).style.color = "#ffffff";
					document.getElementById("idcelula"+valor1).innerHTML = "NÃO <a href='#' onclick=carregaDivExclusao('valor1','ativo1')><b>(alterar)</b></a>";
				}else{
					document.getElementById("idlinha").style.background = "#68ff88";
					document.getElementById("idlinha").style.color = "#000000";
					document.getElementById("idcelula").innerHTML = "SIM <a href='#' onclick=carregaDivExclusao('valor1','ativo1')><b>(alterar)</b></a>";
				}
				
				var xhttp = new XMLHttpRequest();
				xhttp.open("GET", "atualizaplaca.php?placa="+valor1+"&ativo="+ativo1, true);
				xhttp.send();
			}
		</script>
		
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
					<table border="1" align="center">
						<?php
							if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
								include 'loginbd_acessopraca.php';
								
								# query
								$query = 
									"select
										placa,
										marca,
										modelo,
										cor,
										e.Sigla,
										c.Nome,
										qtd_eixos,
										data_cadastro,
										data_vigencia,
										ativo,
										categoria
									from
										Placas p
										inner join Cidade c on c.CidadeId = p.cidade
										inner join Estado e on e.EstadoId = p.estado";
								
								# perform the query
								$result = odbc_exec($conn, $query);
								
								echo "
									<!--Início Cabeçalho/Exemplos-->
										<tr style='background:#eeeeee;'>
											<th>Placa</th>
											<th>Estado</th>
											<th>Cidade</th>
											<th>Categoria</th>
											<th>Eixos</th>
											<th>Marca</th>
											<th>Modelo</th>
											<th>Cor</th>
											<th>Data Cadastro</th>
											<th>Vigência até</th>
											<th>Ativo</th>
										</tr>
									<!--Fim Cabeçalho-->";
								
								while(odbc_fetch_row($result)){
									$placa = utf8_encode(odbc_result($result, 1));
									$marca = utf8_encode(odbc_result($result, 2));
									$modelo = utf8_encode(odbc_result($result, 3));
									$cor = utf8_encode(odbc_result($result, 4));
									$estado = utf8_encode(odbc_result($result, 5));
									$cidade = strtoupper(utf8_encode(odbc_result($result, 6)));
									$qtd_eixos = utf8_encode(odbc_result($result, 7));
									$data_cadastro = utf8_encode(odbc_result($result, 8));
									$data_vigencia = utf8_encode(odbc_result($result, 9));
									$ativo = utf8_encode(odbc_result($result, 10));
									$categoria = utf8_encode(odbc_result($result, 11));
									
									if($ativo == '1'){
										$ativo = 'SIM';
										// echo "<script>alert(placa: ".$placa.");</script>";
										echo
											"<tr id='idlinha$placa' align='center' style='background:#68ff88;'>
												<td><b>$placa</b></td><td>$estado</td><td>$cidade</td><td>$categoria</td><td>$qtd_eixos</td>
												<td>$marca</td><td>$modelo</td><td>$cor</td><td>$data_cadastro</td><td>$data_vigencia</td><td id='idcelula$placa'>$ativo <a href='#' onclick=carregaDivExclusao('$placa','$ativo')><b>(alterar)</b></a></td>
											</tr>";
									}else{
										$ativo = 'NÃO';
										"<tr id='idlinha$placa' align='center' style='background:#FA8072;color:white;'>
												<td><b>$placa</b></td><td>$estado</td><td>$cidade</td><td>$categoria</td><td>$qtd_eixos</td>
												<td>$marca</td><td>$modelo</td><td>$cor</td><td>$data_cadastro</td><td>$data_vigencia</td><td id='idcelula$placa'>$ativo <a href='#' onclick=carregaDivExclusao('$placa','$ativo')><b>(alterar)</b></a></td>
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
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>