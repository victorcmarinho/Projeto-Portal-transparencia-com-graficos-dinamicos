<?php
include "DBO.php";
print_r ($_POST);
?>
<html>
    <head>
        <title>Autenticando</title>
        <script type="text/javascript">
            function sucessologin(){
                setTimeout("window.location='painel.php'",5000);
            }
            function falhalogin(){
                setTimeout("window.location='index.html'",10);
            }
        </script>
    </head>
    <body>
<?php
$email=$_POST["email"];
$senha=$_POST["senha"];
$id;
$sql = $mysqli->query( "SELECT * FROM usuarios WHERE email = '$email' and senha ='$senha'")or die("Erro na busca do usuário no banco");
$row = $mysqli->affected_rows;
if($row>0){
    session_start();
    $_SESSION["email"]=$_POST["email"];
    $_SESSION["senha"]=$_POST["senha"];
    echo "<center>Você foi autenticado com sucesso! Aguarde um instante.</center>";
    echo "<script>sucessologin()</script>";

}else{
    $_SESSION["email"]=null;
    $_SESSION["senha"]=null;
    echo "<center>Nome ou Senha invalidos!</center>";
    echo "<script>falhalogin()</script>";
}
?>
    </body>
</html>
