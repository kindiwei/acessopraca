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
				<?php
					session_start();
						if( (isset($_SESSION['login']) == true) and (isset($_SESSION['senha']) == true) and ( ($_SESSION['funcao'] == 'admin') or ($_SESSION['funcao'] == 'ti') ) ){
							if($_SERVER["REQUEST_METHOD"] == "POST"){
								include 'loginbd_acessopraca.php';
								
								$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
								$conn = odbc_connect($connection_string,$user,$pass) or die('<script>alert("Erro de conexão com o banco!!");</script>');
								
								$placa = $_POST['placa'];
								$marca = $_POST['marca'];
								$modelo = $_POST['modelo'];
								$cor = $_POST['cor'];
								$uf = $_POST['cod_estados'];
								$cidade = $_POST['cod_cidades'];
								$eixos = $_POST['eixos'];
								$categoria = $_POST['categoria'];
								
								# query select to find result exists
								$query =
									"select p.placa from Placas p where p.placa = '".strtoupper($placa)."'";
								
								//exec query
								$result = odbc_exec($conn, $query);
								
								odbc_fetch_row($result);
								
								$placa_banco = utf8_encode(odbc_result($result, 1));
								
								if ($placa_banco != '') {
									echo "Placa já existente: <b>".strtoupper($placa)."</b>! Verifique no menu Placas Cadastradas!";
								}
								else{
									echo "<br><br>Placa cadastrada com sucesso! Verifique no menu Placas Cadastradas.";
									
									$query =
										"insert into
											Placas values (
												(select max(idplaca)+1 from Placas),
												'".strtoupper($placa)."',
												'".strtoupper($marca)."',
												'".strtoupper($modelo)."',
												'".strtoupper($cor)."',
												".strtoupper($uf).",
												".strtoupper($cidade).",
												".strtoupper($eixos).",
												GETDATE(),
												DATEADD(YEAR,1,GETDATE()),
												1,
												'".strtoupper($categoria)."'
											)";
											
									$result = odbc_exec($conn, $query);
									odbc_fetch_row($result);
								}
								
								# close the connection
								odbc_close($conn);
							}
						}else{
							echo
								"
								Você não está cadastrado ou não faz parte do grupo de permissão de acesso. 4 Segundos para redirecionar...
								<script>
									setTimeout(redirect, 4000);
									function redirect() {
										window.location='index.php';
									}
								</script>";
						}
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