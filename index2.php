<?php

#Verifica se foi retornada alguma coisa de login.php
if(isset($_GET['erro']) && isset($_GET['usuario'])){
	$usuario = $_GET['usuario'];
	#Verifica o erro
	if($_GET['erro'] == 1){
		$erro_div = "<div class='alert'>A senha está incorreta.</div><br>";
	}
	elseif($_GET['erro'] == 2){
		$erro_div = "<div class='alert'>Esse usuário não existe.</div><br>";
	}
	else{
		$erro_div = "";
	}
}
#Se nada for retornado, define variáveis vazias
else{
	$usuario = "";
	$erro_div = "";
}
#Código HTML a ser enviado
$html = "
<!-- Arquivo index.php -->
<html lang=pt-br>
<head>
<meta name='developer' content='MH Saude' charset=utf-8 >
<title>MH Saude - Alpha</title>
<link href='./conf/tela.css' rel='stylesheet' media='all'>
</head>
<body>
<div class='header'><h2>MH Saude - Alpha</h2><br><b>Login</b></div><br>
" . $erro_div . "
<form action='./login.php' method='post'>
<table align='center'>
<tr><td>Usuário: </td><td><input type='text' name='usuario' value='" . $usuario . "'></td></tr>
<tr><td>Senha: </td><td><input type='password' name='senha'></td></tr>
<tr><td><input type='submit' value='Logar' /></td></tr>
</table>
</form>
<div class='cprg'><h5>&copy <a href='http://www.mhackbr.com'>MH Sistemas</a> - <a href='./notas.php'>Notas</a> - <a href='./cadastro.html'>Cadastre-se</a></h5></div>
</body>
</html>";

#Envia a página html
echo $html;
?>