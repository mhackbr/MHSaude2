<?php

//Arquivo notas.php
#C�digo HTML a ser enviado
$html = "
<!-- Arquivo notas.php -->
<html>
<head>
<meta name='developer' content='Sandrinho Info Software'>
<title>Slogin - Notas da vers�o</title>
<link href='./conf/tela.css' rel='stylesheet' media='all'>
</head>
<body>
<div class='header'><h2>Slogin v6.5.1</h2><br><b>Notas da vers�o</b></div><br>
Desenvolvido por Alessandro Pereira<br>
String da vers�o: <code>6.5.6701.slogin65_sp1</code><br>
Rodando em: <code>http://" . $_SERVER['SERVER_NAME'] . "</code><br>
Este sistema de login � disponibilizado sob a licensa Creative Commons<br>
&copy; Sandrinho Info 2013<br>
<div class='cprg'><h5>&copy <a href='http://www.sandrinhoinfo.com.br/?ref=Slogin65'>Sandrinho Info</a> - <a href='./notas.php'>Notas da vers�o</a> - <a href='./'>P�gina inicial</a></h5></div>
</body>
</html>";
#Manda a p�gina
echo $html;
?>