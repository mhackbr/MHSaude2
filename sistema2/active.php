<?php
include("config.php");

if (isset($_GET['ac'])){
   $sessao = $_GET['ac'];
   
   $sql_busca = "SELECT * FROM user WHERE sessao = '$sessao'";
   $exe_busca = mysql_query($sql_busca) or die (mysql_error());
   $num_busca = mysql_num_rows($exe_busca);
   
   if ($num_busca > 0){
      $sql_up = "UPDATE user SET activo = 'S' WHERE sessao = '$sessao'";
	  $exe_up = mysql_query($sql_up) or die (mysql_error());
   }
   else {
      echo "Esse usuario não pode ser ativado.";
   }
}
?>
