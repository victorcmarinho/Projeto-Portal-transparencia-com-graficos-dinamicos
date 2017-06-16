<?php
include_once "repositorio/master.php";
session_start();
$email =  preg_replace('/[^[]_]/', '',$_POST['email']);
$senha =  preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']);
$stmt=$dbo->getUsuario($email,$senha);
$stmt->bind_param('ss',$email,$senha);
$stmt->execute();
$stmt->bind_result($id,$nome,$uemail, $usenha,$nivel,$uativo);
$stmt->store_result();
echo $location=$_SESSION['location'];
if($stmt->num_rows == 1){
    if($stmt->fetch()){
        if ($uativo == '0') {

            $_SESSION['loginErro']='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p class="text-center"><strong>Atenção!</strong> Seu acesso foi desativado!</p></div>';
            header("Location:$location");
            exit();
        }elseif($nivel == 1){
            $_SESSION['usuarioId'] = $id;
            $_SESSION['usuarioNome']=$nome;
            $_SESSION['usuarioNivel']=$nivel;
            $_SESSION['usuarioEmail'] = $uemail;
            $_SESSION['usuarioSenha'] = $usenha;
            header("Location:restrito/home.php");
            exit();
        }else{
            $_SESSION['usuarioId'] = $id;
            $_SESSION['usuarioNome']=$nome;
            $_SESSION['usuarioNivel']=$nivel;
            $_SESSION['usuarioEmail'] = $uemail;
            $_SESSION['usuarioSenha'] = $usenha;
            header("Location:restrito/index.php");
            exit();
        }
    }
}else{
    $_SESSION['loginErro']='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p class="text-center"><strong>Atenção!</strong> Email ou Senha errados!</p></div>';
     header("Location:$location");
}

?>
