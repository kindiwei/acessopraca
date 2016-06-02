<?php
	//dados digitados da tela de login
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		
		include 'loginbd_sinterno.php';
		
		$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
		$conn = odbc_connect($connection_string,$user,$pass) or die('<script>alert("Erro de conexão com o banco!!");</script>');
		
		# query
		// $query = "select * from usuarios u where u.login='$login' and u.passw='".md5($senha)."'";
		$query = "
				select
					u.login,
					u.passw,
					f.descricao
				from
					Usuarios u
					left join Funcao f on f.idfuncao = u.idfuncao
				where
					u.login='$login'
					and u.passw='".md5($senha)."'
		";
		
		
		if ($res=odbc_exec($conn, $query)) {
			session_start();
			$_SESSION["login"]=utf8_encode(odbc_result($res, 1));
			$_SESSION["senha"]=utf8_encode(odbc_result($res, 2));
			$_SESSION["funcao"]=utf8_encode(odbc_result($res, 3));
			
			echo "<br><br><p>Bem vindo, ".$_SESSION["login"]."!</p><br>Aguarde alguns segundos para ser transferido.";
			echo 
				"<script>
					window.location='index.php'; 
				</script>

				<noscript>
					Se não for direcionado automaticamente, clique <a href='index.php'>aqui</a>. 
				</noscript>"
			;
		}else{
			echo "Houve algum erro!";
		}
		
		// # close the connection
		odbc_close($conn);
	?>