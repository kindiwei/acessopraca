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
				<b><u><p align="center">CADASTRO DE PLACAS</p></u></b><br><br>
				<form name="contato" onsubmit="return TestaCampos();" action="envia_email.php" method="post">
					<table cellSpacing="0" cellPadding="0" border="0" align="center">
						<tr>
							<td><b><u>PLACA (*)</u></b>:</td>
							<td><input maxLength="255" size="40" name="placa"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td >MARCA:</td>
							<td><input maxLength="255" size="40" name="marca"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>MODELO:</td>
							<td><input maxLength="255" size="40" name="modelo"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>COR:</td>
							<td><input maxLength="255" size="40" name="cor"></td>
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
							<td><input maxLength="255" size="22" name="cidade"></td>
						</tr>
						<tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						
							<td>QTDE EIXOS:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="uf" id="uf">
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
				<!--<img src="imagens/RodapeCART.png">-->
			</div>
		</div>
	</body>
</html>