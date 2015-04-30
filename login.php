<?php
################################################################

################################################################
//Arquivo login.php
//Inclui o arquivo de configuração do sistema
require_once "conf/desc.php";
//Variáveis para análise
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
//Consulta MySQL
$sql = "SELECT * FROM slogin_users WHERE Usuario = '" . $usuario . "'";
$query = mysql_query($sql);
$linhas = mysql_num_rows($query);
//Autenticação do usuário
if($linhas != 0){
	if($senha != mysql_result($query,0,"Senha")){
		//Tratamento para senha errada
		header("Location:$raiz?usuario=" . $usuario . "&erro=1");
	}
	else{
		//Tratamento para senha correta
		#Inicia a sessão e insere os dados nela
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		#Redireciona para a página inicial
		header("Location:$home");
	}
}
else{
	//Tratamento se o usuário não existir
	header("Location:$raiz?usuario=" . $usuario . "&erro=2");
}
?>