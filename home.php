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
					<li><a href="index.php">Home</a></li>
					<li><a href="relatorios.php">Relatórios</a></li>
					<li><a href="relat_tripper.php">Tripper</a></li>
					<li><a href="cadastroosa.php">Cadastro OSAs</a></li>
					<!--<li><a href="usuarios.php">Usuários</a></li>-->
					<li><a href="cadastrousuarios.php">Cadastro de Usuários</a></li>
					<!--<li><a href="nagios.php">Nagios</a></li>-->
				</ul>
			</div>
			<div id="conteudo">
				<h1>
					O "Sistema Interno"
				</h1>
				<p>
					O Sistema Interno foi criado primeiramente como um "atalho" para o CCA extrair relatórios básicos e facilitar o trabalho
					e dia a dia dos colaboradores, porém como uma forma de "atalho" da Gerência de TI criamos diversas outras funções para
					o, apelidado carinhosamente, "puxadinho".
				</p>
				<p>
					Agora você pode encontrar relatórios do KCor (GPS), Tripper, MIP, Nagios.
				</p>
				<p>
					Caso você entrou neste portal e não encontrou algum relatório que deseja extrair, de forma a facilitar o seu trabalho
					(e o da TI), algum relatório e ainda não esteja no BI, entre em contato com a TI.
				</p>
				<p>
					Outro recado que é importante para todos os colaboradores que utilizam este portal, lembrem-se, existem relatórios que
					é necessário o total funcionamento (nenhuma manutenção) da rede da CART pois extraem dados de bancos de dados que
					localizam-se nas praças. Portanto, caso haja algum erro na extração, muito possívelmente seja alguma manutenção na rede
					ou algum problema de conexão com internet. Qualquer erro, não deixem de contatar a TI.
				</p>
			</div>
			<div id="rodape">
				<!--<img src="imagens/RodapeCART.png">-->
			</div>
			<div id="usuario">
			</div>
		</div>
	</body>
</html>