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
			function isValidatePlate(text){
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
					return /^[a-zA-Z()]+$/.test(str);
				}
				
				
				//testa se caracter 3 primeiros caracteres da string são letras - retorna falso se encontrar numero nos 3 primeiros caracteres
				for (var i = 0; i < 3; i++){
					if (!isAlphaOrParen(text.charAt(i))){
						return false;
					}
				}
				
				//testa se algum do 4o ao último caracter é letra
				for (var i = 3; i < text.length ; i++){
					if (isAlphaOrParen(text.charAt(i))){
						return false;
					}
				}
				
				return true;
			}

			function TestaCampos(){
				document.getElementById("placa").style.backgroundColor = "";
				document.getElementById("cod_estados").style.backgroundColor = "";
				document.getElementById("cod_cidades").style.backgroundColor = "";
				document.getElementById("categoria").style.backgroundColor = "";
				document.getElementById("eixos").style.backgroundColor = "";
				
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
								alert("Existe algo no preenchimento da placa!\n\n"+
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
				
				if (document.cadastroplaca.cod_estados.value == ""){
					alert("Favor preencher o campo Estado");
					document.getElementById("cod_estados").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.cod_estados.focus();
					return false;
				}
				
				if (document.cadastroplaca.cod_cidades.value == ""){
					alert("Favor preencher o campo Cidade");
					document.getElementById("cod_cidades").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.categoria.focus();
					return false;
				}
				
				if (document.cadastroplaca.categoria.value == ""){
					alert("Favor preencher o campo Categoria");
					document.getElementById("categoria").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.categoria.focus();
					return false;
				}
				
				if (document.cadastroplaca.eixos.value == ""){
					alert("Favor preencher o campo Quantidade de Eixos");
					document.getElementById("eixos").style.backgroundColor = "ffb8b5";
					document.cadastroplaca.eixos.focus();
					return false;
				}
				
				return true;
			}
			
			function carregaCidades(codCidade) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("cod_cidades").innerHTML = xhttp.responseText;
					}
				};
				xhttp.open("GET", "carregacidades.php?codestados="+codCidade, true);
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
				<form name="cadastroplaca" onsubmit="return TestaCampos();" action="envia_placa_banco.php" method="post">
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
								<select name="cod_estados" id="cod_estados" onchange="carregaCidades(this.value)">
									<option value=""></option>
									<option value="1">AC</option>
									<option value="2">AL</option>
									<option value="3">AM</option>
									<option value="4">AP</option>
									<option value="5">BA</option>
									<option value="6">CE</option>
									<option value="7">DF</option>
									<option value="8">ES</option>
									<option value="9">GO</option>
									<option value="10">MA</option>
									<option value="11">MG</option>
									<option value="12">MS</option>
									<option value="13">MT</option>
									<option value="14">PA</option>
									<option value="15">PB</option>
									<option value="16">PE</option>
									<option value="17">PI</option>
									<option value="18">PR</option>
									<option value="19">RJ</option>
									<option value="20">RN</option>
									<option value="21">RO</option>
									<option value="22">RR</option>
									<option value="23">RS</option>
									<option value="24">SC</option>
									<option value="25">SE</option>
									<option value="26">SP</option>
									<option value="27">TO</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						
						<tr>
							<td><b><u>CIDADE (*)</u></b>:</td>
							<td>
								<div id="cidadeAjax">
									<select name="cod_cidades" id="cod_cidades">
										<option value="">Selecione</option>
									</select>
								</div>
							</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><b><u>CATEGORIA (*)</u></b>:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="categoria" id="categoria">
									<option value="">Selecione</option>
									<option value="comercial">Comercial</option>
									<option value="passeio">Passeio</option>
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
									<option value="1">01</option>
									<option value="2">02</option>
									<option value="3">03</option>
									<option value="4">04</option>
									<option value="5">05</option>
									<option value="6">06</option>
									<option value="7">07</option>
									<option value="8">08</option>
									<option value="9">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
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