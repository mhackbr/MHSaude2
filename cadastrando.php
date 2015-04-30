<?php
error_reporting(0);
################################################################

################################################################
//Arquivo cadastrando.php
//Inclui o arquivo de configura��o do sistema
require_once "conf/desc.php";
//Define as var�veis para an�lise
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$confsenha = $_POST['confsenha'];
$cartaosus = $_POST['cartaosus'];
$nome = $_POST['nome'];
$sexo = $_POST['sexo'];
$dtanasc = $_POST['nascimento'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cep = $_POST['cep'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

//Rotina de verifica��o de formul�rio
#Consultas de verifica��o
$query1 = mysql_query("SELECT * FROM slogin_users WHERE Usuario = '$usuario'");
$query2 = mysql_query("SELECT * FROM slogin_users WHERE Email = '$email'");
$res1 = mysql_num_rows($query1);
$res2 = mysql_num_rows($query2);
#vari�vel de reporta��o de erros
/*$erro = array();
#Vari�vel de valida��o do formul�rio
$run = true;
#Verifica se digitou o nome de usu�rio
if($usuario == ""){
	$erro[0] = "Digite o nome de usuário desejado.<br>";
	$run = false;
}
else{
	#Se algo foi digitado, verifica se o nome de ussu�rio inserido existe
	if($res1 != 0){
		$erro[0] = "O nome de usuário escolhido já existe.<br>";
		$run = false;
	}
}
#Verifica se o email foi digitado
if($email == ""){
	$erro[1] = "Digite o seu endereço de email.<br>";
	$run = false;
}
else{
	#Se algo foi digitado, verifica se o email inserido j� est� sendo usado
	if($res2 != 0){
		$erro[1] = "O endereço de email já está sendo usado.<br>";
		$run = false;
	}
}
#Verifica se o sexo foi escolhido
if($sexo == ""){
	$erro[2] = "Selecione o seu sexo.<br>";
	$run = false;
}
else{
	#Se foi escolhido, verifica o conte�do enviado
	if($sexo != "Masculino" && $sexo != "Feminino"){
		$erro[2] = $sexo . " Sexo não reconhecido.<br>";
		$run = false;
	}
}
#Verifica se a senha foi digitada
if($senha == ""){
	$erro[3] = "Digite a senha desejada.<br>";
	$run = false;
}
else{
	#Se foi digitada, verifica se a senha de confirma��o foi digitada
	if($confsenha == ""){
		$erro[3] = "Digite a senha de confirmação.<br>";
		$run = false;
	}
	else{
		#Verifica se as senhas s�o iguais
		if($senha != $confsenha){
		$erro[3] = "As senhas não conferem.<br>";
		$run = false;
		}
	}
}
#Verifica se o dia de nascimento foi inserido
if($_POST['nascimento'] == ""){
	$erro[4] = "Digite o dia do seu nascimento.<br>";
	$run = false;
}
else{
	#Se o dia foi inserido, verifica see o m�s foi enviado
	if($_POST['mes'] == ""){
		$erro[4] = "Digite o mês do seu nascimento.<br>";
		$run = false;
	}
	else{
		#Se o m�s foi inserido, verifica o ano
		if($_POST['ano'] == ""){
			$erro[4] = "Digite o ano do seu nascimento.<br>";
			$run = false;
		}
	}
}
#Verifica se o endere�o foi recebido
if($endereco == ""){
	$erro[5] = "Digite o seu endereço.<br>";
	$run = false;
}
#Verifica se a cidade foi inserida
if($cidade == ""){
	$erro[6] = "Insira a sua cidade.<br>";
	$run = false;
}
#Verfica se o estado foi enviado
if($estado == ""){
	$erro[7] = "Insira o seu estado.<br>";
	$run = false;
}
#Verifica se o estado foi digitado
if($cep == ""){
	$erro[8] = "Insira o seu CEP.<br>";;
	$run = false;
}
#Verifica se a pergunta secreta foi inserida
if($pergunta == ""){
	$erro[9] = "Insira a sua pergunta secreta.<br>";
	$run = false;
}
else{
	#se foi inserida, verifica se a resposta foi digitada
	if($resposta == ""){
		$erro[9] = "Responda a sua pergunta secreta.<br>";
		$run = false;
	}
}
#Verifica se o número do cartão do SUS foi digitado
if($cartaosus == ""){
    $erro[10] = "Insira o número do Cartão do SUS.<br>";
    $run = false;
}
#Verifica se o número do telefone foi digitado.
if ($telefone == ""){
    $erro[11] = "Insira seu telefone.<br>";
    $run = false;
}
#Verifica se o formul�rio conteve erros
if($run){
	#Se n�o houver erros, ele vai executar a inser��o no banco de dados
	//Rotina de MySQL - N�o altere
	$sql = "INSERT INTO slogin_users (`ID`,`Usuario`, `Senha`, Cartaosus,`Nome`, `Sexo`,`Nascimento`, `Endereco`,`Cidade`, `Estado`,`Cep`, `Email`, telefone,`Pergunta`, `Resposta`) VALUES (NULL,'$usuario','$senha',$cartaosus,'$nome','$sexo','$dtanasc','$endereco','$cidade','$estado','$cep','$email', $telefone,'$pergunta','$resposta');";
	$query = mysql_query($sql);
	#Verifica se a inser��o foi bem sucedida
	if($query){
		#Se houver sucesso, inicia a sess�o e apresenta a mensagem de boas vindas
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		$res = "<div class='sucess'>Seu cadastro foi realizado com sucesso.</div><br>
		Clique <a href='start.php'>aqui</a> para ir a página inicial.";
	}
	else{
		#Se n�o houver sucesso na inser��o, exibe mensagem de erro
		$res = "<div class='alert'Seu cadastro não foi realizado,<br>tente novamente mais tarde.</div><br>
		<a href='$raiz/cadastro.html'>Voltar</a>";
	}
}
else{
	#Se houver erros no formul�rio, notifiica o utilizador
	$res =  "<div class='alert'>Seu cadastro não foi realizado, verifique os erros a seguir.</div><br><div class='code'>
	" . $erro[0] . $erro[1] . $erro[2] . $erro[3] . $erro[4] . $erro[5] . $erro[6] . $erro[7] . $erro[8]. $erro[9] . $erro[10] . $erro[11] . "</div><br>
	<a href='$raiz/cadastro.html'>Voltar</a>";
}*/

echo $usuario . "<br>";
echo $cartaosus . "<br>";
echo $cep . "<br>";
echo $cidade . "<br>";
echo $confsenha . "<br>";
echo $dtanasc . "<br>";
echo $email . "<br>";
echo $endereco . "<br>";
echo $estado . "<br>";
echo $nome . "<br>";
echo $senha . "<br>";
echo $sexo . "<br>";
echo $telefone . "<br>";

echo $query1 . "<br>";
echo $query2 . "<br>";
echo $res1 . "<br>";
echo $res2 . "<br>";

//Rotina de MySQL - N�o altere
	$sql = "INSERT INTO slogin_users (`ID`,`Usuario`, `Senha`, Cartaosus,`Nome`, `Sexo`,`Nascimento`, `Endereco`,`Cidade`, `Estado`,`Cep`, `Email`, telefone) VALUES (NULL,'$usuario','$senha',$cartaosus,'$nome','$sexo','$dtanasc','$endereco','$cidade','$estado','$cep','$email', $telefone);";
	$query = mysql_query($sql);
	#Verifica se a inser��o foi bem sucedida
	if($query){
		#Se houver sucesso, inicia a sess�o e apresenta a mensagem de boas vindas
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		$res = "<div class='sucess'>Seu cadastro foi realizado com sucesso.</div><br>
		Clique <a href='start.php'>aqui</a> para ir a página inicial.";
	}
	


$html = "
<!-- Arquivo cadastrando.php -->
<html>
<head>
<meta name='developer' content='MH Sistemas' charset='utf-8'>
<title>MH Saúde</title>
<link href='./conf/tela.css' rel='stylesheet' media='all'>
</head>
<body>
<div class='header'><h2>MH Saúde</h2><br><b>Cadastro</b></div><br>
" . $res . "
<div class='cprg'><h5>&copy <a href='http://www.mhackbr.com/mhsistemas'>MH Sistemas</a> - <a href='./notas.php'>Wiki</a> - <a href='./'>P�gina Inicial</a></h5></div>
</head>
</html>";
echo $html;
?>
	