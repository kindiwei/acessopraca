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
							<tr><td>Login:</td><td><input type="text" id="login1" name="login" size=15></td></tr>
							<tr><td>Senha:</td><td><input type="password" name="senha" size=15></td></tr>
							<tr><td colspan="2" align="center"><input type="submit" value="Entrar" name="Submit"></td></tr>
							<tr>
								<td colspan="2" align="center">
									<?php
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
			<div id="conteudo">
				<?php
					//dados digitados da tela de login
						$login = $_POST['login'];
						$senha = $_POST['senha'];
						
						include 'loginbd_acessopraca.php';
						
						# query
						$query = "
								select
									u.usuario,
									u.passw,
									f.funcao
								from
									Usuarios u
									left join Funcao f on f.idfuncao = u.idfuncao
								where
									u.usuario='$login'
									and u.passw='".md5($senha)."'
						";
						
						// echo "<br><br>$query";
						
						$res=odbc_exec($conn, $query);
						$userteste = utf8_encode(odbc_result($res, 1));
						
						if (($userteste != '') and ($res=odbc_exec($conn, $query))) {
							$_SESSION["login"]=utf8_encode(odbc_result($res, 1));
							$_SESSION["senha"]=utf8_encode(odbc_result($res, 2));
							$_SESSION["funcao"]=utf8_encode(odbc_result($res, 3));
							
							echo "<br><br><p>Bem vindo, ".$_SESSION["login"]."!</p><br>Aguarde alguns segundos para ser transferido.";
							echo "<br>Se não for direcionado automaticamente, clique <a href='index.php'>aqui</a>.";
							echo 
								"<script>
									setTimeout(
										function(){
											window.location='index.php';
										}
										, 4000
									);
								</script>";
						}else{
							echo
								"Você não está cadastrado ou digitiou a senha incorretamente. Tente novamente.";
						}
						
						# close the connection
						odbc_close($conn);
					?>
	
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>