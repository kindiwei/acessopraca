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