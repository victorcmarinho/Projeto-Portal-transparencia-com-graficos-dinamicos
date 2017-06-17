<?php
include "../../repositorio/Master.php";
unset($p);
$p['nome']      = $_POST['nome'];
$p['email']     = $_POST['email'];
$p['senha']     = md5($_POST['senha']);
$p['cpf']       = $_POST['cpf'];
$p['nivel']     = $_POST['perm'];
$p['ativo']     = 1;
session_start();
$_SESSION['mensagem'] = $dbo->cadastraUsuarios($p);
header('Location:usuario.php');

?>
