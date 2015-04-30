<?php
################################################################
#Slogin Kernel Versуo 6.5.1                                    #
#Compilaчуo 311220121938                                       #
#Copyright Sandrinho Info                                      #
#Este cѓdigo щ disponibilizado sob a licenчa                   #
#Creative Commons (Para redestribuir, щ necessсria a menчуo do #
#Autor).                                                       #
################################################################
//Arquivo conf/desc.php
/* Nota sobre o arquivo desc.php
Esse arquivo NУO salva informaчѕes sobre conexуo a banco de dados e etc.
A funчуo desse script щ apenas conduzir as informaчѕes de conexуo.
Para modificar qualquer parтmetro de navegaчуo acesse, com um navegador web, a pasta
"conf", insira "slogin651" como nome de usuсrio e "gingerbread" como senha e siga as instruчѕes
mostradas na pсgina. */
//Rotina de localizaчуo do arquivo de configuraчуo
if(!file_exists("c/conf.txt")){
	if(!file_exists("conf/c/conf.txt")){
		if(!file_exists("../conf/c/conf.txt")){
			echo "O arquivo de configuraчуo nуo existe.<br>Acesse a pasta ''conf'', autentique-se e defina as configuraчѕes de conexуo.";
			exit;
		}
		else{
			$file = "../conf/c/conf.txt";
		}
	}
	else{
		$file = "conf/c/conf.txt";
	}
}
else{
	$file = "c/conf.txt";
}
//Rotina de leitura das configuraчѕes
$set = file($file);
$raiz = chop($set[4]);
$home = $raiz . "/home";
//Rotina de conexуo ao banco de dados
$conn = @mysql_connect(chop($set[0]),chop($set[1]),chop($set[2])) or die (mysql_error());
$db = @mysql_select_db(chop($set[3]),$conn) or die (mysql_error());
?>