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
			//carrega div para a desativação do cadastro
			function carregaDivExclusao(valor1,ativo1) {
				var xhttp = new XMLHttpRequest();
				
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						//document.getElementById("demo").innerHTML = "atualizaplaca.php?placa="+valor1+"&ativar="+ativo1;
						window.location='placascadastradas.php';
					}
				};
				xhttp.open("GET", "atualizaplaca.php?placa="+valor1+"&ativar="+ativo1, true);
				xhttp.send();
			}
			
			function carregaHistorico(placa1) {
				var xhttp = new XMLHttpRequest();
				
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("placascadastro").style.display='none';
						document.getElementById("searchInPage").style.display='none';
						document.getElementById("carregahistoricodiv").style.display='block';
						document.getElementById("carregahistoricodiv").innerHTML = xhttp.responseText;
						document.getElementById("botaovoltarplacas").style.display='block';
					}
				};
				xhttp.open("GET", "carregaHistorico.php?placa="+placa1, true);
				xhttp.send();
			}
			
			// function atualizaCadastro(placa,estado,cidade,categoria,qtdeixos,marca,modelo,cor,datacadastro,datavigencia,ativo) {
			function atualizaCadastro(placa1) {
				var xhttp = new XMLHttpRequest();
				
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						// document.getElementById("demo").innerHTML = xhttp.responseText;
						window.location='placascadastradas.php';
					}
				};
				
				xhttp.open("GET", "atualizavigencia.php?placa="+placa1, true);
				xhttp.send();
			}
			
			function atualizaPagina() {
				window.location='placascadastradas.php';
			}
			
			var TRange=null;
			
			function findString(){
				str = document.getElementById("valorprocuraplaca").value;
				if (parseInt(navigator.appVersion)<4)
					return;
				var strFound;
				if(window.find){
					// alert(document.getElementById("placascadastro").value);
					// CODE FOR BROWSERS THAT SUPPORT window.find
					strFound=self.find(str);
					// alert(strFound);
					// if(!strFound){
						// strFound=self.find(str,0,1);
						// if (!self.find(str,0,1))
							// return;
						// while (self.find(str,0,1)){
							// alert(self.find(str,0,1));
							// //continue;
						// }
					// }
				}else
					if(navigator.appName.indexOf("Microsoft")!=-1){
					// EXPLORER-SPECIFIC CODE
						if(TRange!=null){
							TRange.collapse(false);
							strFound=TRange.findText(str);
						if(strFound)
							TRange.select();
						}
						if(TRange==null || strFound==0){
							TRange=self.document.body.createTextRange();
							strFound=TRange.findText(str);
							if(strFound)
								TRange.select();
						}
					}else
						if(navigator.appName=="Opera"){
							alert ("Navegador Opera não suportado.")
							return;
						}
						if (!strFound)
							alert ("Texto '"+str+"' não enconttrado!")
						return;
			}
		</script>
		
	</head>
	<body>
		<div id="site">
			<div id="cabecalho">
				<div id="login">	
					<form method="post" action="login.php">
						<table>
							<tr><td>Login:</td><td><input type="text" id="login1" name="login" size=15></td></tr>
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
													<a href='esquecisenha.php'>Esqueci minha senha</a>
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
					<li><a href="index.php">Manual de Uso</a></li>
					<li><a href="cadastroplacas.php">Cadastro de Placas</a></li>
					<li><a href="placascadastradas.php" style="background:#868686;">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			
			<div id='demo'></div>
			
			<div id='divcarregacsv'></div>
			
			<div id="conteudo">
				<!--<h1 align="center"><u>Placas Cadastradas</u></h1><br>-->
					<br>
					<div id="searchInPage" style="text-align:center">
						<!--<form name="procuraplaca" id="procuraplaca" onsubmit="findString()">-->
							<input id="valorprocuraplaca" type="text" size=15> <button onclick="findString()">Procurar Placa</button>
						<!--</form>-->
						<br><br><br>
					</div>
					<div id="carregahistoricodiv" style="display:none;text-align:center">
					</div>
					<div id="placascadastro">
						<table align="center" style="border-collapse: collapse;border: 1px solid black;" id="tableidplacas">
							<?php
								if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
									include 'loginbd_acessopraca.php';
									
									# query
									$query = 
										"select
											placa,
											m.marca,
											modelo,
											cor,
											e.Sigla,
											c.Nome,
											qtd_eixos,
											dataatualizacao,
											data_vigencia,
											ativo,
											categoria
										from
											Placas p
											inner join Cidade c on c.CidadeId = p.cidade
											inner join Estado e on e.EstadoId = p.estado
											left join Marcas m on m.idmarca = p.idmarca";
									
									# perform the query
									$result = odbc_exec($conn, $query);
									
									if(odbc_fetch_row($result)){
										//exec again the script to back start
										$result = odbc_exec($conn, $query);
										echo "
											<!--Início Cabeçalho/Exemplos-->
												<tr style='background:#eeeeee;border: 1px solid black;'>
													<th style='border: 1px solid black;'>Placa</th>
													<th style='border: 1px solid black;'>Estado</th>
													<th style='border: 1px solid black;'>Cidade</th>
													<th style='border: 1px solid black;'>Categoria</th>
													<th style='border: 1px solid black;'>Eixos</th>
													<th style='border: 1px solid black;'>Marca</th>
													<th style='border: 1px solid black;'>Modelo</th>
													<th style='border: 1px solid black;'>Cor</th>
													<th style='border: 1px solid black;'>Data Cadastro</th>
													<th style='border: 1px solid black;'>Vigência até</th>
													<th style='border: 1px solid black;'>Ativo</th>
													<th style='border: 1px solid black;'>Atualizar vigência</th>
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
												echo
													"<tr id='idlinha$placa' align='center' style='background:#68ff88;'>
														<td style='border: 1px solid black;'>
															<a href='#' style='text-decoration:none;' onclick=carregaHistorico('$placa')><b>$placa</b></a>
														</td>
														<td style='border: 1px solid black;'>$estado</td>
														<td style='border: 1px solid black;'>$cidade</td>
														<td style='border: 1px solid black;'>$categoria</td>
														<td style='border: 1px solid black;'>$qtd_eixos</td>
														<td style='border: 1px solid black;'>$marca</td>
														<td style='border: 1px solid black;'>$modelo</td>
														<td style='border: 1px solid black;'>$cor</td>
														<td style='border: 1px solid black;'>".date_format(date_create($data_cadastro), 'd-m-Y H:i')."</td>
														<td style='border: 1px solid black;'>".date_format(date_create($data_vigencia), 'd-m-Y H:i')."</td>
														<td style='border: 1px solid black;' id='idcelula$placa'>$ativo <button onclick=carregaDivExclusao('$placa','$ativo')>Alterar</button></td>
														<td style='border: 1px solid black;' id='idatualizacelula$placa'>
															<br><button onclick=atualizaCadastro('$placa')>Atualizar</button>
														</td>
													</tr>";
											}else{
												$ativo = 'NÃO';
												echo
													"<tr id='idlinha$placa' align='center' style='background:#FA8072;color:white;'>
														<td style='border: 1px solid black;'>
															<a href='#' style='text-decoration:none;' onclick=carregaHistorico('$placa')><b>$placa</b></a>
														</td>
														<td style='border: 1px solid black;'>$estado</td>
														<td style='border: 1px solid black;'>$cidade</td>
														<td style='border: 1px solid black;'>$categoria</td>
														<td style='border: 1px solid black;'>$qtd_eixos</td>
														<td style='border: 1px solid black;'>$marca</td>
														<td style='border: 1px solid black;'>$modelo</td>
														<td style='border: 1px solid black;'>$cor</td>
														<td style='border: 1px solid black;'>".date_format(date_create($data_cadastro), 'd-m-Y H:i')."</td>
														<td style='border: 1px solid black;'>".date_format(date_create($data_vigencia), 'd-m-Y H:i')."</td>
														<td style='border: 1px solid black;' id='idcelula$placa'>$ativo <button onclick=carregaDivExclusao('$placa','$ativo')>Alterar</button></td>
														<td style='border: 1px solid black;' id='idatualizacelula$placa'>
															<br><button onclick=atualizaCadastro('$placa')>Atualizar</button>
														</td>
													</tr>";
											}
										}
									}else{
										echo "<p style='font-size:20px;text-align:center;'>Sem placas cadastradas</p>";
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
					<div id="botaovoltarplacas" style='text-align:center;display:none;'>
						<br>
						<input type="submit" value="Voltar" name="Submit" onclick=atualizaPagina()>
					</div>
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>