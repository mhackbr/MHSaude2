<?php
include("config.php");

if (isset($_POST['login'])){
   $login = $_POST['login'];
   //Verifica se existe usuario
   $sql_busca = "SELECT * FROM user WHERE login = '$login'";
   $exe_busca = mysql_query($sql_busca) or die (mysql_error());
   $fet_busca = mysql_fetch_assoc($exe_busca);
   $num_busca = mysql_num_rows($exe_busca);
   //verifica se existe uma linha com o login digitado
   if ($num_busca > 0){
      $email = $fet_busca['email'];
	  $senha = $fet_busca['senha'];
	  $topico = "Esquece senha";
	  $mensagem = "<html>";
	  $mensagem .= "<body>";
	  $mensagem .= "<br>Você efetuou um pedido de recuperação de senha no $nome_site.</br>";
	  $mensagem .=	"<br>Login: $login";
	  $mensagem .=	"<br>Senha: $senha</br>";
	  $mensagem .= "<br>Site oficial do $nome_site";
	  $mensagem .=	"<br><a href='$site'>$site</a></br>";
	  $mensagem .=	"</body>";
	  $mensagem .=	"</html>";
	  $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  $headers .= "From: $nome_site <$email>\r\n";
	  
	  //enviar para o email o login e a senha
	  mail($email, $topico, $mensagem, $headers);
      $ac[] = "Sua senha foi enviado para seu e-mail.";
   }
   else {
      $ac[] = "Esse login não existe.";
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
  <table width="33%" border="0">
    <tr>
      <td colspan="2"><div align="center"><strong>Esquece senha </strong></div></td>
    </tr>
    <tr>
      <td width="22%"><span class="Style2">Login:</span></td>
      <td width="78%"><span class="Style2">
        <label>
        <input name="login" type="text" id="login" />
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
</form>
</body>
</html>
