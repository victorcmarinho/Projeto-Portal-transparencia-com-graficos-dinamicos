<?php
include "../../repositorio/Master.php";
echo "<pre>";
printf($_POST['nome']);
printf($_POST['email']);
printf(md5($_POST['senha']));
printf($_POST['sexo']);
printf($_FILES['imagem']['name']);
echo "<br>";
printf($_POST['perm']);
echo "</pre>";

if(strlen($_POST['email'])){
    $sql = "SELECT * FROM usuarios WHERE email = '".$_POST['email']."'";
    $RS = $dbo->query($sql);
        unset($p);
        $p['nome']      = $_POST['nome'];
        $p['email']     = $_POST['email'];
        $p['senha']     = md5($_POST['senha']);
        $p['sexo']      = $_POST['sexo'];
        $p['imagem']    = $_FILES['imagem']['name'];
        $p['nivel']     = $_POST['perm'];
        $p['ativo']     = 1;
        $id = $dbo->cadastraUsuarios($p);
        $dir = $id."/";
        $base = "../usuarios/";
        mkdir($base.$dir,0775);
        if(strlen($_FILES['imagem']['tmp_name'])){
            copy($_FILES['imagem']['tmp_name'], $base.$dir.$_FILES['imagem']['name']);
        }
        #header('Location:cadastro.php'.$id);
    }


#pre($_FILES);
?>
