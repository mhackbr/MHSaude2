<?php
################################################################

################################################################
//Arquivo home/index.php
//Inclui o arquivo de configura��o do sistema e o validador de sess�o
#Para proteger as suas p�ginas, coloque sempre as duas linhas abaixo no seu script PHP
require_once "../conf/desc.php";
require_once "../sessao.php";
/* Essa p�gina � um exemplo de como devem ser configuradas as p�ginas do seu sistema.
Recomendamos que voc� coloque as suas p�ginas nesata pasta, mas voc� pode colocar em qualquer parte. */
#C�digo HTML a ser enviado
$html = "
<!-- Arquivo home/index.php -->
<html>
<head>
<meta name='developer' content='MH Sistemas'>
<title>Entrada - MH Saúde</title>
<link href='../conf/tela.css' rel='stylesheet' media='all'>
</head>
<body>
<div class='header'><h2>Slogin v6.5</h2><br><b>Home</b></div><br>
<div class='sucess'>O usuário " .  $usuario . " está logado.</div><br>
<div class='cprg'><h5>&copy <a href='http://www.mhackbr.com/mhsistemas'>MH Sistemas</a> - <a href='../notas.php'>Notas da vers�o</a> - <a href='../logout.php'>Sair</a></h5></div>
</body>
</html>";
#Manda a p�gina
echo $html;
?>