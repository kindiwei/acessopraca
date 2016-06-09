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
			function isEmail(text){
				var arroba = "@",
						ponto = ".",
						posponto = 0,
						posarroba = 0;
				if (text =="") return false;
				for (var indice = 0; indice < text.length; indice++){
					if (text.charAt(indice) == arroba) {
						posarroba = indice;
						break;
					}
				}
				for (var indice = posarroba; indice < text.length; indice++){
					if (text.charAt(indice) == ponto) {
						posponto = indice;
						break;
					}
				}
				if (posponto == 0 || posarroba == 0) return false;
				if (posponto == (posarroba + 1)) return false;
				if ((posponto + 1) == text.length) return false;
				return true;
			}

			function TestaCampos(){
				document.getElementById("NomeCad").style.backgroundColor = "";
				document.getElementById("CPFCad").style.backgroundColor = "";
				document.getElementById("EmailCad").style.backgroundColor = "";
				document.getElementById("LoginCad").style.backgroundColor = "";
				document.getElementById("SenhaCad").style.backgroundColor = "";
				document.getElementById("FuncaoCad").style.backgroundColor = "";
				
				if (document.contato.NomeCad.value == ""){
					alert("Favor preencher o campo Nome");
					document.getElementById("NomeCad").style.backgroundColor = "ffb8b5";
					document.contato.NomeCad.focus();
					return false;
				}

				if (document.contato.CPFCad.value == ""){
					alert("Favor preencher o campo CPF");
					document.getElementById("CPFCad").style.backgroundColor = "ffb8b5";
					document.contato.CPFCad.focus();
					return false;
				}
				
				if (!isEmail(document.contato.EmailCad.value)){
					alert("Favor verificar o campo e-mail");
					document.getElementById("EmailCad").style.backgroundColor = "ffb8b5";
					document.contato.EmailCad.focus();
					return false;
				}
				
				if (document.contato.LoginCad.value == ""){
					alert("Favor preencher o campo Senha");
					document.getElementById("LoginCad").style.backgroundColor = "ffb8b5";
					document.contato.LoginCad.focus();
					return false;
				}

				if (document.contato.SenhaCad.value == ""){
					alert("Favor preencher o campo Senha");
					document.getElementById("SenhaCad").style.backgroundColor = "ffb8b5";
					document.contato.SenhaCad.focus();
					return false;
				}

				if (document.contato.FuncaoCad.value == ""){
					alert("Favor preencher o campo Senha");
					document.getElementById("FuncaoCad").style.backgroundColor = "ffb8b5";
					document.contato.FuncaoCad.focus();
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
							<tr><td>Login:</td><td><input type="text" name="Login" size=15></td></tr>
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
					<li><a href="cadastrousuarios.php" style="background:#868686;">Cadastro Usuários</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<!--<h1 align="center"><u>Cadastro de usuários</u></h1><br>-->
				<br>
				<form name="contato" onsubmit="return TestaCampos();" action="envia_email.php" method="post">
					<table cellSpacing="0" cellPadding="0" border="0" align="center">
						<tr>
							<td><u><b>Nome (*):</b></u></td>
							<td><input maxLength="255" size="64" name="NomeCad" id="NomeCad"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>CPF (*):</b></u></td>
							<td><input maxLength="255" size="64" name="CPFCad" id="CPFCad"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>E-mail (*):</b></u></td>
							<td><input maxLength="255" size="64" name="EmailCad" id="EmailCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Telefone:</td>
							<td><input maxLength="255" size="22" name="TelefoneCad" id="TelefoneCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>Login: (*)</b></u></td>
							<td><input maxLength="255" size="30" name="LoginCad" id="LoginCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>Senha (*):</u></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input maxLength="255" type="password" size="22" name="SenhaCad" id="SenhaCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><u><b>Função/Cargo (*):</u></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input maxLength="255" size="40" name="FuncaoCad" id="FuncaoCad"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" align="center">(*) Campos obrigatórios</td>
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