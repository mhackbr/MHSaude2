<?php
error_reporting(0);
include("config.php");

if (isset($_POST['login'])){

   //pega a sess�o id do usuario
   session_start();
   $sessao = session_id();
   $login = $_POST['login'];
   $senha = $_POST['senha'];
   $email = $_POST['email'];

   $sql_busca = "SELECT * FROM user WHERE login = '$login'";
   $exe_busca = mysql_query($sql_busca) or die (mysql_error());
   $num_busca = mysql_num_rows($exe_busca);

   $sql_busca2 = "SELECT * FROM user WHERE email = '$email'";
   $exe_busca2 = mysql_query($sql_busca2) or die (mysql_error());
   $num_busca2 = mysql_num_rows($exe_busca2);

   //Verifica se os campos est�o preenchidos
   if ($_POST['login'] == "" || $_POST['senha'] == "" || $_POST['senha2'] == "" || $_POST['email'] == ""){
      $ac[] = "Por favou preencha todos os campos corretamente.";
   }
   //Verifica se ja existe o login
   if ($num_busca > 0){
      $ac[] = "Esse login j� esta sendo usado por outro usuario.";
   }
   //Verifica se ja existe o e-mail
   if ($num_busca2 > 0){
      $ac[] = "Esse e-mail j� esta sendo usado por outro usuario.";
   }
   //Verifica se o e-mail esta correto
   if (!ereg("@.", $_POST['email'])){
      $ac[] = "E-mail invalido.";
   }
   //Verifica se as duas senha s�o diferente
   if ($_POST['senha'] != $_POST['senha2']){
      $ac[] = "Verifique se as duas senha est�o correta.";
   }
   //Verifica se todas est�o corretas
   if (!isset($ac)){
	  //Inclui o cadastro no mysql
	  $sql_inclu = "INSERT INTO user(login, senha, email, sessao) VALUES
	                ('$login', '$senha', '$email', '$sessao')";
	  $exe_inclu = mysql_query($sql_inclu) or die (mysql_error());
	  
	  $topico = "Cadastro $nome_site";
	  $mensagem = "<html>";
	  $mensagem .= "<body>";
	  $mensagem .= "Ol� $login\r\n";
	  $mensagem .= "<br>Voc� efetuou um cadastro no $nome_site.</br>";
	  $mensagem .=	"<br>Login: $login";
	  $mensagem .=	"<br>Senha: $senha";
	  $mensagem .=	"<br>Ativar conta <a href='$site/active.php?ac=$sessao'>$site/active.php?ac=$sessao</a></br>";
	  $mensagem .=	"</body>";
	  $mensagem .=	"</html>";
	  $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  $headers .= "From: $nome_site <$email>\r\n";
	  $ac[] = "Cadastro efetuado com sucesso, verifique seu e-mail para ativa a conta.";
	  //enviar para o email o login, senha e o codigo de ativa��o
	  mail($email, $topico, $mensagem, $headers);
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>
<style type="text/css">
<!--
.Style2 {font-size: 13px}
-->
</style>
</head>

<body>
<?php
if (isset($ac)){
   for($i=0;$i<count($ac);$i++){
      echo "<li>".$ac[$i];
   }
}
?>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
  <table width="100%" border="0">
    <tr>
      <td colspan="2"><div align="center"><strong>Cadastro</strong></div></td>
    </tr>
    <tr>
      <td width="13%"><span class="Style2">Login:</span></td>
      <td width="87%"><span class="Style2">
        <label>
        <input name="login" type="text" id="login" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td><span class="Style2">Senha:</span></td>
      <td><span class="Style2">
        <label>
        <input name="senha" type="password" id="senha" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td><span class="Style2">Repetir senha: </span></td>
      <td><span class="Style2">
        <label>
        <input name="senha2" type="password" id="senha2" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td><span class="Style2">E-mail:</span></td>
      <td><span class="Style2">
        <label>
        <input name="email" type="text" id="email" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Style2">
        <label>
        <input type="submit" name="Submit" value="Enviar" />
        </label>
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
