<?php

include "class.bd.php";
$banco = new Bd('localhost','root','','cursophp');

include "class.String.php";
$strings = new String();

//include "class.mail.php";
//$mail = new Mail('cursophppremium@gmail.com','cursophppremium@gmail.com','123premium','smtp.gmail.com','587','tls');

include "repositorio/strings.php";
include "repositorio/imagens.php";
include "repositorio/calculos.php";
include "repositorio/arquivos.php";
?>
