<?php
include('../data/server.php');
$id = (int) $_GET['id'];

if(isset($_POST['valor'])){

   $valor = $_POST['valor'];

   if($result=$conn->query("UPDATE receita SET valor = '{$valor}' WHERE idreceita='{$id}';")){
   }

}

if($result=$conn->query("SELECT aplicacao_idaplicacao,fonte_recurso_idfonte_recurso,fonte_idfonte,data,valor FROM `receita` WHERE idreceita='{$id}'")){
    if($result){
        while($row = $result->fetch_assoc()){
            $array[]=$row;
        }
    }
    $result->close();
}
?>
<form action="#" method="post">

   <label>valor</label>
    <input type="text" name="valor" value="<?php echo $array[0]['valor']; ?>">
    <button type="input">Alterar</button>

</form>
