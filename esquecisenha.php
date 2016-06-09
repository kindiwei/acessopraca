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
					<li><a href="index.php">Cadastro de Placas</a></li>
					<li><a href="placascadastradas.php">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			
			<div id='demo'></div>
			
			<div id="conteudo">
				<h1 align="center"><u>Recuperação de senha</u></h1><br>
				<p>Para recuperar sua senha, envie um novo cadastro <a href='cadastrousuarios.php'>(acesse aqui)</a> com seus dados e nova senha. Receberá um novo e-mail com o cadastro.</p>
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>