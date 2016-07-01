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
					<li><a href="index.php" style="background:#868686;">Manual de Uso</a></li>
					<li><a href="cadastroplacas.php">Cadastro de Placas</a></li>
					<li><a href="placascadastradas.php">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<h1>Utilização do Sistema</h1>
				<p>
					Primeiramente, para que possa cadastrar qualquer placa no sistema, deve-se ter um usuário 
					com permissão necessária para cadastro.
				</p>
				<p>
					Para tal, entre em <a href='cadastrousuarios.php'>Cadastro Usuários</a> para cadastrar devidamente.
				</p>
				<h1>
					<a href='cadastroplacas.php' style="color:#000;text-decoration:none;">Cadastro de Placas</a>
				</h1>
				<p>
					Existe a obrigatoriedade <u>(com validação de campos)</u> o preenchimento dos campos:
					<br>- Placa;
					<br>- Estado;
					<br>- Cidade;
					<br>- Categoria;
					<br>- Quantidade de Eixos.
				</p>
				<p>
					O restante dos preenchimentos é opcional, porém o quanto mais preenchido o formulário, 
					melhor para identificá-lo na praça de pedágio.
					<br>Após o preenchimento dos campos, basta clicar em enviar e verificar se está cadastrado 
					em <a href="placascadastradas.php">Placas Cadastradas</a>.
				</p>
				<h1>
					<a href="placascadastradas.php" style="color:#000;text-decoration:none;">Placas Cadastradas</a>
				</h1>
				<p>
					Nesta sessão (<a href="placascadastradas.php">link</a>) estão todas as placas cadastradas no sistema.
					<br>
					<img src="http://localhost/acessopraca/imagens/printplacas.png" width="700" height="344">
				</p>
				<p>
					Enxergará todo o histórico de cada placa cadastrada e ainda conseguirá pesquisar pela placa que necessita.
				</p>
				<p>
					Ativar, desativar e mudar vigência do placa.
				</p>
			</div>
			<div id="rodape">
			</div>
			<div id="direitos">
				Desenvolvido por Kindi Wei
			</div>
		</div>
	</body>
</html>