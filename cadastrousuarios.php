<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
	<head>
		<title>Sistema interno - CART</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="content-language" content="pt-br">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id="site">
			<div id="cabecalho">
				<!--<img src="imagens/CabecalhoCART.png">-->
				<div id="login">
					<form method="post" action="login.php">
						<table>
							<tr><td>Login:</td><td><input type="text" name="login" size=15></td></tr>
							<tr><td>Senha:</td><td><input type="password" name="senha" size=15></td></tr>
							<tr><td colspan="2" align="center"><input type="submit" value="Entrar" name="Submit"></td></tr>
							<tr>
								<td colspan="2" align="center">
									<?php
										// session_start();
										// if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true) or (strlen($_SESSION['login'])==0) ){
											echo
												"<div id='cadastro_esqueci'>
													<a href='cadastrousuarios.php'>Cadastrar</a>&nbsp;&nbsp;&nbsp;&nbsp;
													<a href='#'>Esqueci minha senha</a>
												</div>";
										// }else{
											// echo
												// "<div id='cadastro_esqueci'>
													// Olá, ".$_SESSION["login"].
												// "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='logoff.php'>LOGOUT</a></div>";
										// }
									?>
									<!--<div id="cadastro_esqueci">
										<a href="cadastrousuarios.php">Cadastrar</a>&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="#">Esqueci minha senha</a>
									</div>-->
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div id="menu">
				<ul>
					<li><a href="index.php">Cadastro de Placas</a></li>
					<li><a href="#">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<b><u><p align="center">Cadastro de usuários</p></u></b><br><br>
				<form name="contato" onsubmit="return TestaCampos();" action="envia_email.php" method="post">
					<table cellSpacing="0" cellPadding="0" border="0" align="center">
						<tr>
							<td>Nome (*):</td>
							<td><input maxLength="255" size="64" name="NomeCad"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td >E-mail:</td>
							<td><input maxLength="255" size="64" name="EmailCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Telefone:</td>
							<td><input maxLength="255" size="22" name="TelefoneCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>Funcao (*):</b></u></td>
							<td>
								<select name="FuncaoCad">
									<option value="admin">Administrador</option>
									<option value="user">User</option>
									<option value="cca">CCA</option>
									<option value="pco">PCO</option>
									<option value="cca">CCO</option>
									<option value="ti">TI</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td><u><b>Login (*):</b></u></td>
							<td><input maxLength="255" size="22" name="LoginCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>Senha (*):</u></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input maxLength="255" type="password" size="22" name="SenhaCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" align="center">(*) Campos são obrigatórios</td>
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