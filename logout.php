<?php
################################################################

################################################################
//Arquivo logout.php
#Inclui o arquivo de configuração do sistema
require_once "conf/desc.php";
#Faz procedimento da sessão
@session_start();
#Encerra a sessão
session_destroy();
#Redireciona para a página raiz
header("Location:$raiz");
?>