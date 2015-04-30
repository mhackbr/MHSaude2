<?php
$host = "localhost"; //Servidor do mysql
$user = "admin"; //Usuario do banco de dados
$senha = "admin"; //senha do banco de dados
$db = "mhsaudeDB"; //banco de dados
$nome_site = "mhsaude"; //Nome do site
$email = "italosantos.fernandes@gmail.com"; //E-mail do administrador
$site = "http://www.mhackbr.com/mhsaude"; //Seu site n se esuqece de botar o http://

mysql_connect($host, $user, $senha) or die (mysql_error());
mysql_select_db($db) or die (mysql_error()); 
?>
