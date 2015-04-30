<?php
################################################################

################################################################
//Arquivo conf/index.php
#Usu�rio de configura��o do sistema
$slogin_user = "mhackbr";
#Senha
$slogin_pass = "Mad26101184";
#Rotina de autentica��o de usu�rios
if(!isset($_SERVER['PHP_AUTH_USER']) or $_SERVER['PHP_AUTH_USER'] != $slogin_user){
	header('WWW-Authenticate: Basic realm="Slogin - Diret�rio de configura��o"');
	header('HTTP/1.0 401 Unauthorized');
	echo "Voc� n�o est� autorizado a ver esta p�gina.";
	exit;
}
elseif(!isset($_SERVER['PHP_AUTH_PW']) or $_SERVER['PHP_AUTH_PW'] != $slogin_pass){
	header('WWW-Authenticate: Basic realm="Slogin - Diret�rio de configura��o"');
	header('HTTP/1.0 401 Unauthorized');
	echo "Voc� n�o est� autorizado a ver esta p�gina.";
	exit;
}
#Verifica se foi enviada altera��es nos par�metros de conex�o ao banco de dados
if(isset($_POST['edita'])){
	#Se existir, define as configura��es e prepara para salva-las
	$ar_conf = $_POST['linha1'] . "\r\n" . $_POST['linha2'] . "\r\n" . $_POST['linha3'] . "\r\n" . $_POST['linha4'] . "\r\n" . $_POST['linha5'];
	#Verifica se h� algo em branco
	if($_POST['linha1'] == "" || $_POST['linha2'] == "" || $_POST['linha3'] == "" || $_POST['linha4'] == "" || $_POST['linha5'] == ""){
		$res = "<div class='alert'Est� faltando algo, verifique os dados e tente novamente.</div><br><a href='./?edita'>Voltar</a>";
	}
	else{
	#Se estiver tudo ok, salva o arquivo
		$arquivo = fopen("c/conf.txt","w+");
		$salvando = fwrite($arquivo,$ar_conf);
		$fechando = fclose($arquivo);
		#Verifica se o arquivo foi salvo
		if($salvando && $fechando){
			$res = "<div class='sucess'>A configura��o foi salva com sucesso.</div><br>
			<b>Detalhes</b><br>
			Servidor MySQL: <code>" . $_POST['linha1'] . "</code><br>
			Usu�rio: <code>" . $_POST['linha2'] . "</code><br>
			Senha: <code>" . $_POST['linha3'] . "</code><br>
			Banco de dados: <code>" . $_POST['linha4'] . "</code><br>
			Diret�rio raiz do sistema: <code>" . $_POST['linha5'] . "</code><br>
			&nbsp;<br>
			<a href='./?tabela'>Verificar configura��es da tabela</a>";
		}
		else{
		#Se n�o foi poss�vel salvar, mostra instru��es para inserir o arquivo de configura��o manualmente
			$res = "<div class='alert'>A configura��o n�o pode ser salva.</div><br>
			Intru��es para salvamento manual:<br>
			Salve um arquivo na pasta ''conf/c'' do sistemaa com o nome ''conf.txt'' com o seguinte conte�do:<br>
			<code>" . $_POST['linha1'] . "<br>" . $_POST['linha2'] . "<br>" . $_POST['linha3'] . "<br>" . $_POST['linha4'] . "<br>" . $_POST['linha5'] . "</code><br>
			AVISO: Para o funcionamento do Slogin, � necess�rio que este arquivo esteja devidamente configurado.<br>
			<a href='./'>Voltar</a>";
		}
	}
}
elseif(isset($_GET['edita'])){
	$config = file("c/conf.txt");
	$linha1 = $config[0];
	$linha2 = $config[1];
	$linha3 = $config[2];
	$linha4 = $config[3];
	$linha5 = $config[4];
	$res = "<b>Editar arquivo de configura��o</b><br>
	<form action='./' method='post'>
	<table align='center'>
	<tr><td>Servidor&nbsp;MySQL:&nbsp;</td><td><input type='text' name='linha1' value='$linha1'></td></tr>
	<tr><td>Usu�rio:&nbsp;</td><td><input type='text' name='linha2' value='$linha2'></td></tr>
	<tr><td>Senha:&nbsp;</td><td><input type='text' name='linha3' value='$linha3'></td></tr>
	<tr><td>Banco&nbsp;de&nbsp;dados:&nbsp;</td><td><input type='text' name='linha4' value='$linha4'></td</tr>
	<tr><td>Diret�rio&nbsp;raiz&nbsp;do&nbsp;sistema:&nbsp;</td><td><input type='text' value='$linha5' name='linha5'></td></tr>
	<input type='hidden' name='edita' value='sim'>
	<tr><td><input type='submit' value='Salvar'></td></tr>
	</table>
	</form>";
}
elseif(isset($_GET['tabela'])){
//Rotina de configura��o da tabela
	require_once "desc.php";
	#Verifica se recebeu a ordem de criar a tabela
	if(isset($_GET['cria'])){
		$sql = "CREATE TABLE `slogin_users` (
		`ID` int(11) NOT NULL auto_increment,
		`Usuario` varchar(50) NOT NULL,
		`Senha` char(15) NOT NULL,
		`Cartaosus` varchar(30) NOT NULL,
		`Nome` varchar(200) NOT NULL,
		`Sexo` varchar(15) NOT NULL,
		`Nascimento` varchar(15) NOT NULL,
		`Endereco` varchar(200) NOT NULL,
		`Cidade` varchar(50) NOT NULL,
		`Estado` varchar(50) NOT NULL,
		`Cep` varchar(20) NOT NULL,
		`Email` varchar(50) NOT NULL,
		`Telefone` varchar(15) NOT NULL,
		`Recuperar` varchar(200) NOT NULL,
		PRIMARY KEY  (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
		$query = mysql_query($sql);	
		#Verifica se a tabela foi criada com sucesso
		if($query){
			$res = "<div class='sucess'>Tabela configurada com sucesso.</div><br>
			<a href='./'>Voltar</a>";
		}
		else{
			$res = "<div class='alert>A tabela n�o foi configurada.</div><br>
			Verifique as <a href='./?edita'>Configura��es da conex�o</a> e tente novamente.";
		}
	}
	#Verifica se a tabela existe no banco de dados
	elseif(!mysql_query("SELECT * FROM slogin_users")){
		$res = "<div class='alert'>A tabela ''slogin_users'' n�o foi encontrada no banco de dados.</div><br>
		Clique <a href='?tabela&cria'>aqui</a> para criar a tabela.<br>";
	}
	else{
		$res = "<div class='sucess'>As configura��es da tabela est�o corretas!</div><br>
		<a href='./'>Voltar</a>";
	}
}
elseif(!file_exists("c/conf.txt")){
	$res = "<div class='alert'>O arquivo de configura��o n�o foi encontrado</div><br>
	Insira as informa��oes solicitadas para configurar o Slogin.<br>
	<form action='./' method='post'>
	<table align='center'>
	<tr><td>Servidor&nbsp;MySQL:&nbsp;</td><td><input type='text' name='linha1'></td></tr>
	<tr><td>Usu�rio:&nbsp;</td><td><input type='text' name='linha2'></td></tr>
	<tr><td>Senha:&nbsp;</td><td><input type='text' name='linha3'></td></tr>
	<tr><td>Banco&nbsp;de&nbsp;dados:&nbsp;</td><td><input type='text' name='linha4'></td></tr>
	<tr><td>Diret�rio&nbsp;raiz&nbsp;do&nbsp;sistema:&nbsp;</td><td><input type='text' name='linha5'></td></tr>
	<input type='hidden' name='edita' value='sim'>
	<tr><td><input type='submit' value='Criar arquivo de configura��o'>
	</table>
	</form>";
}
else{
	$res = "<a href='?edita'>Editar configura��es da conex�o</a><br>
	<a href='?tabela'>Configura��es da tabela</a>";
}
#C�digo HTML a ser enviado
$html = "
<!-- Arquivo conf/index.php -->
<html>
<head>
<meta name='developer' content='Sandrinho Info Software'>
<title>Slogin - Configura��es</title>
<link href='tela.css' rel='stylesheet' media='all'>
</head>
<body>
<div class='header'><h2>Slogin v6.5</h2><br><b>Configura��es</b></div><br>
$res
<div class='cprg'><h5>&copy <a href='http://www.mhackbr.com/mhsistemas'>MH Sistemas</a> - <a href='../notas.php'>Wiki</a> - <a href='../'>P�gina Inicial</a> - <a href='./'>Configura��es do Slogin</a></h5></div>
</body>
</html>";
#Envia a p�gina
echo $html;
?>