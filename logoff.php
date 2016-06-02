<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
	session_start();
	session_destroy();
	echo 
		"<script> 
			window.location='index.php'; 
		</script> 

		<noscript> 
			Se não for direcionado automaticamente, clique <a href='index.php'>aqui</a>. 
		</noscript>"
	;
?>
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
					<li><a href="cadastroosa.php">Cadastro OSAs</a></li>
					<!--<li><a href="usuarios.php">Usuários</a></li>-->
					<li><a href="#">Cadastro de Usuários</a></li>
					<li><a href="nagios.php">Nagios</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<?php
					// $login = $_POST['login'];
					// $senha = $_POST['senha'];
					
					// include 'loginbd_sinterno.php';
					
					// $connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
					// $conn = odbc_connect($connection_string,$user,$pass) or die('<script>alert("Erro de conexão com o banco!!");</script>');
					
					// # query
					// // $query = "select * from usuarios u where u.login='$login' and u.passw='".md5($senha)."'";
					// $query = "select u.login, u.passw from usuarios u where u.login='$login' and u.passw='".md5($senha)."'";
					
					// // $res=odbc_exec($conn, $query);
					
					// //echo "alert('teste');";
					// //echo "alert('".$res."');";
					
					// // echo $_POST['login'];
					// // echo '<br>'.$_POST['senha'];
					// // echo '<br>'.md5($senha);
					
					// if ($res=odbc_exec($conn, $query)) {
						// session_start();
						// $_SESSION["login"]=$login;
						// echo "<br><br><p>Bem vindo, ".$_SESSION["login"]."!</p><br>Aguarde alguns segundos para ser transferido.";
						// echo 
							// "<script> 
								// window.location='index.php'; 
							// </script> 

							// <noscript> 
								// Se não for direcionado automaticamente, clique <a href='index.php'>aqui</a>. 
							// </noscript>"
						// ;
					// }else{
						// echo "Houve algum erro!";
					// }
					
					// // # close the connection
					// odbc_close($conn);
				?>
			</div>
			<div id="rodape">
				<!--<img src="imagens/RodapeCART.png">-->
			</div>
		</div>
	</body>
</html>