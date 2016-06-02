<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

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
							<tr><td>Login:</td><td><input type="text" name="Login" size=15></td></tr>
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
					<li><a href="index.php">Cadastro de Placas</a></li>
					<li><a href="placascadastradas.php">Placas Cadastradas</a></li>
					<li><a href="cadastrousuarios.php">Cadastro Usuários</a></li>
				</ul>
			</div>
			<div id="conteudo">
				<p>Foi enviado um email para o administrador do sistema e você receberá um outro e-mail confirmando a solicitação do cadastro...</p>
				
				<?php
					//1 – Definimos Para quem vai ser enviado o email
					$para = "kindi.wei@cart.invepar.com.br";
					//2 - resgatar o nome digitado no formulário e  grava na variavel $nome
					$nomecadastro = $_POST['NomeCad'];
					$cpf = $_POST['CPFCad'];
					$email = $_POST['EmailCad'];
					$telefone = $_POST['TelefoneCad'];
					$login = $_POST['LoginCad'];
					$senha = $_POST['SenhaCad'];
					// 3 - resgatar o assunto digitado no formulário e  grava na variavel
					$assunto = '[Cadastro de usuário] Acesso Praça';
					//4 – Agora definimos a  mensagem que vai ser enviado no e-mail
					$mensagem = "<strong>Nome:  </strong>".$nomecadastro;
					$mensagem .= "<br><strong>CPF:  </strong>".$cpf;	
					$mensagem .= "<br><strong>E-mail:  </strong>".$email;
					$mensagem .= "<br><strong>Telefone:  </strong>".$telefone;
					$mensagem .= "<br><strong>Login:  </strong>".$login;
					$mensagem .= "<br><strong>Senha:  </strong>".md5($senha);
					
					//5 – agora inserimos as codificações corretas e tudo mais.
					$headers =  "Content-Type:text/html; charset=UTF-8\n";
					$headers .= "From:  Kindi Wei <kindi.wei@cart.invepar.com.br>\n"; //Vai ser //mostrado que  o email partiu deste email e seguido do nome
					$headers .= "X-Sender:  <kindi.wei@cart.invepar.com.br>\n"; //email do servidor //que enviou
					$headers .= "X-Mailer: PHP  v".phpversion()."\n";
					$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
					$headers .= "Return-Path:  <no_reply@cartsa.com.br>\n"; //caso a msg //seja respondida vai para  este email.
					$headers .= "MIME-Version: 1.0\n";

					mail($para, $assunto, $mensagem, $headers);  //função que faz o envio do email.
				?>
			</div>
			<div id="rodape">
				<!--<img src="imagens/RodapeCART.png">-->
			</div>
		</div>
	</body>
</html>