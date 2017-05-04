<?php
include "DBO.php";
?>
<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
    //session_start();
    //header("Location: index.html");
    echo "N logado";
    exit;
}else{
    echo "<center>Você está logado</center>";
}
?>
