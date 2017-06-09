<?php
session_start();
$usuariot = $_POST['email'];
$senhat = $_POST['senha'];
include_once("repostitorio/master.php");
$result= $dbo->query("SELECT * FROM usuarios WHERE login='$usuariot' AND senha='$senhat' LIMIT 1");
$resultado = mysqli_fetch_assoc($result);
//echo "Usuario: ".$resultado['nome'];
if(empty($resultado)){
	//Mensagem de Erro
	$_SESSION['loginErro'] = "Usuário ou senha Inválido";
	//Manda o usuario para a tela de login
	header("Location: login.php");
}else{
   	//Define os valores atribuidos na sessao do usuario
	$_SESSION['usuarioId'] 			= $resultado['id'];
	$_SESSION['usuarioNome'] 		= $resultado['nome'];
	$_SESSION['usuarioNivelAcesso'] = $resultado['nivel_acesso_id'];
	$_SESSION['usuarioLogin'] 		= $resultado['login'];
	$_SESSION['usuarioSenha'] 		= $resultado['senha'];

	if($_SESSION['usuarioNivelAcesso'] == 1){
		header("Location: administrativo.php");
	}else{
		header("Location: usuario.php");
	}
}
?>
