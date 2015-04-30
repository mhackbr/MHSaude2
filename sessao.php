<?php
################################################################
#MH Saude - MH Sistemas                                        #
#Copyright Italo Cesar Fernandes                               #
################################################################

////Arquivo sessao.php
//Inclui o arquivo de configuração do sistema
require_once "conf/desc.php";
/* Uma breve descriçãoo dos erros que serão exibidos:
Erro 0791: É quando a senha existente na sessão é diferente da existente no Banco de dados
Erro 0790: É quando o usu�rio definido na sessão não existe
Erro 0789: É quando a sessão não existe
*/
#Procedimento de sess�o
@session_start();
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
//Rotina de autentica��o de usu�rio
#Verifica se usuario foi definido na sess�o
if($_SESSION['usuario'] != ""){
	#Verifica se senha foi definida na sess�o
	if($_SESSION['senha'] != ""){
		#Se usuario e senha n�o forem nulos, verifica se existem no banco de dados
		$query = mysql_query("SELECT * FROM slogin_users WHERE Usuario = '" . $_SESSION['usuario'] . "'");
		$res = mysql_fetch_array($query);
		$linhas = mysql_num_rows($query);
		#Verifica se o usuario definido na sess�o existe
		if($linhas != 0){
			#Se existir, verifica a senha definida na sess�o
			if($_SESSION['senha'] != $res['Senha']){
				session_destroy();
				echo "Sessão inválida.<br>Erro 0791.<br><a href='$raiz'>Voltar</a>";
				exit;
			}
		}
		else{
			#Se n�o houver registros do usu�rio, encerra a sess�o
			session_destroy();
			echo "Sessão inválida.<br>Erro 0790.<br><a href='$raiz'>Voltar</a>";
			exit;
		}
	}
}
else{
	session_destroy();
	echo "Sessão inválida.<br>Erro 0789.<br><a href='$raiz'>Voltar</a>";
	exit;
}
?>