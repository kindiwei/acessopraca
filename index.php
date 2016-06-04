﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

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
			function isValidatePlate(text){
				alert('validação placa');
				text = text.trim();
				text = text.replace(" ", "");
				text = text.replace(' ', '');
				text = text.replace(',', '');
				text = text.replace('.', '');
				text = text.replace('-', '');
				text = text.replace('+', '');
				text = text.replace('/', '');
				text = text.replace('*', '');
				text = text.replace('+', '');
				text = text.replace('_', '');
				text = text.replace('-', '');
				text = text.replace(')', '');
				text = text.replace('(', '');
				text = text.replace('*', '');
				text = text.replace('&', '');
				text = text.replace('%', '');
				text = text.replace('$', '');
				text = text.replace('#', '');
				text = text.replace('@', '');
				text = text.replace('!', '');
				
				text = text.toUpperCase();
				
				//funcao testa alfabeto
				function isAlphaOrParen(str){
					// alert('entrou teste alfabeto');
					return /^[a-zA-Z()]+$/.test(str);
				}
				
				// alert('saiu teste alfabeto');
				
				//testa se caracter 3 primeiros caracteres da string são letras - retorna falso se encontrar numero nos 3 primeiros caracteres
				for (var i = 0; i < 3; i++){
					// alert('letra: '+text.charAt(i));
					if (!isAlphaOrParen(text.charAt(i))){
						//alert('valida alfabeto da placa. PRIMEIROS 3 CARACTERES NÃO OK: '+text.charAt(i));
						return false;
					}
					// else{}
				}
				
				//testa se algum do 4o ao último caracter é letra
				for (var i = 3; i < text.length ; i++){
					if (isAlphaOrParen(text.charAt(i))){
						// alert('valida alfabeto da placa. 4 ÚLTIMOS CARACTERES NÃO OK: '+text.charAt(i));
						return false;
					}
				}
				
				// alert('valida alfabeto da placa. TUDO OK!');
				return true;
			}

			function TestaCampos(){
				document.getElementById("placa").style.backgroundColor = "";
				document.getElementById("uf").style.backgroundColor = "";
				document.getElementById("cidade").style.backgroundColor = "";
				document.getElementById("categoria").style.backgroundColor = "";
				
				// alert("tamanho da string: "+document.cadastroplaca.placa.value.length);
				
				if (document.cadastroplaca.placa.value == ""){
					alert("Favor preencher o campo Placa");
					document.getElementById("placa").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.placa.focus();
					return false;
				}else{
					if (document.cadastroplaca.placa.value.length > 7){
						alert("Favor preencher corretamente o campo Placa");
						document.getElementById("placa").style.backgroundColor = "ffb8b5";
						document.cadastroplaca.placa.focus();
						return false;
					}else{
						if (document.getElementById("placa").value.length < 7){
							alert("Favor preencher corretamente o campo Placa");
							document.getElementById("placa").style.backgroundColor = "ffb8b5";
							document.cadastroplaca.placa.focus();
							return false;
						}else{
							if (!isValidatePlate(document.cadastroplaca.placa.value)){
								alert("Existe algo no preenchimento da placa!\n"+
											"- Verifique o tamanho do que foi digitado;\n"+
											"- Se foi digitado as letras corretas;\n"+
											"- Se foi digitado os números corretamente.");
								document.getElementById("placa").style.backgroundColor = "ffb8b5";
								document.cadastroplaca.placa.focus();
								return false;
							}
						}
					}
				}

				if (document.cadastroplaca.uf.value == ""){
					alert("Favor preencher o campo Estado");
					document.getElementById("uf").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.uf.focus();
					return false;
				}
				
				if (document.cadastroplaca.cidade.value == "Selecione"){
					alert("Favor preencher o campo Cidade");
					document.getElementById("cidade").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.categoria.focus();
					return false;
				}
				
				if (document.cadastroplaca.categoria.value == "Selecione"){
					alert("Favor preencher o campo Categoria");
					document.getElementById("categoria").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.categoria.focus();
					return false;
				}
				
				if (document.cadastroplaca.categoria.value == "Selecione"){
					alert("Favor preencher o campo Categoria");
					document.getElementById("categoria").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.categoria.focus();
					return false;
				}
				
				if (document.cadastroplaca.eixos.value == "Selecione"){
					alert("Favor preencher o campo Categoria");
					document.getElementById("eixos").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.eixos.focus();
					return false;
				}
				
				return true;
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
				<h1 align="center"><u>Cadastro de Placas</u></h1><br>
				<form name="cadastroplaca" onsubmit="return TestaCampos();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<table cellSpacing="0" cellPadding="0" border="0" align="center">
						<tr>
							<td><b><u>PLACA (*)</u></b>:</td>
							<td><input maxLength="255" size="40" name="placa" id="placa"> </td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><b><u>ESTADO (*)</u></b>:</td>
							<td>
								<select name="uf" id="uf">
									<option value="">Selecione</option>
									<option value="AC">AC</option>
									<option value="AL">AL</option>
									<option value="AM">AM</option>
									<option value="AP">AP</option>
									<option value="BA">BA</option>
									<option value="CE">CE</option>
									<option value="DF">DF</option>
									<option value="ES">ES</option>
									<option value="GO">GO</option>
									<option value="MA">MA</option>
									<option value="MG">MG</option>
									<option value="MS">MS</option>
									<option value="MT">MT</option>
									<option value="PA">PA</option>
									<option value="PB">PB</option>
									<option value="PE">PE</option>
									<option value="PI">PI</option>
									<option value="PR">PR</option>
									<option value="RJ">RJ</option>
									<option value="RN">RN</option>
									<option value="RS">RS</option>
									<option value="RO">RO</option>
									<option value="RR">RR</option>
									<option value="SC">SC</option>
									<option value="SE">SE</option>
									<option value="SP">SP</option>
									<option value="TO">TO</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><b><u>CIDADE (*)</u></b>:</td>
							<td><input maxLength="255" size="22" name="cidade" id="cidade"></td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><b><u>CATEGORIA (*)</u></b>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="categoria" id="categoria">
									<option value="">Selecione</option>
									<option value="AC">Comercial</option>
									<option value="AL">Passeio</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><b><u>QTDE EIXOS (*)</u></b>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="eixos" id="eixos">
									<option value="">Selecione</option>
									<option value="um">01</option>
									<option value="dois">02</option>
									<option value="tres">03</option>
									<option value="quatro">04</option>
									<option value="cinco">05</option>
									<option value="seis">06</option>
									<option value="sete">07</option>
									<option value="oito">08</option>
									<option value="nove">09</option>
									<option value="dez">10</option>
									<option value="onze">11</option>
									<option value="doze">12</option>
									<option value="treze">13</option>
									<option value="quatorze">14</option>
									<option value="quinze">15</option>
									<option value="dezesseis">16</option>
									<option value="dezessete">17</option>
									<option value="dezoito">18</option>
									<option value="dezenove">19</option>
									<option value="vinte">20</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td >MARCA:</td>
							<td><input maxLength="255" size="40" name="marca" id="marca"></td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>MODELO:</td>
							<td><input maxLength="255" size="40" name="modelo" id="modelo"></td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>COR:</td>
							<td><input maxLength="255" size="40" name="cor" id="cor"></td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td colspan="2" align="center">(*) Campos obrigatórios!</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td colspan="2" align="center"><input type="submit" value="Enviar" name="Submit">
							&nbsp; &nbsp;<input type="reset" value="Limpar" name="Submit2"></td>
						</tr>
						
					</table>
					
					<?php
						//permission inside if test
						
						
						if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
							if($_SERVER["REQUEST_METHOD"] == "POST"){
								include 'loginbd_acessopraca.php';
								
								$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
								$conn = odbc_connect($connection_string,$user,$pass) or die('<script>alert("Erro de conexão com o banco!!");</script>');
								
								$placa = $_POST['placa'];
								$marca = $_POST['marca'];
								$modelo = $_POST['modelo'];
								$cor = $_POST['cor'];
								$uf = $_POST['uf'];
								$cidade = $_POST['cidade'];
								$eixos = $_POST['eixos'];
								
								# query
								$query =
									"insert into
										Placas values (
											(select max(idplaca)+1 from Placas),
											'".strtoupper($placa)."',
											'$marca',
											'$modelo',
											'$cor',
											'$estado',
											'$cidade',
											'$eixos',
											'GETDATE()',
											'DATEADD(YEAR,1,GETDATE())',
											1
										)";
								
								//echo $query;
								
								# perform the query
								$result = odbc_exec($conn, $query);
								
								# close the connection
								odbc_close($conn);
							}
						}
						
						
					?>
				</form>
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>