<?php
include "Master.php";
if(isset($_FILES['arquivo'])){
    $tipos = array('image/jpg','image/png','image/gif','image/jpeg','text/plain');
    if(array_search($_FILES['arquivo']['type'], $tipos)){
        $nomearquivo = "../usuarios/".$_FILES['arquivo']['name'];
        copy($_FILES['arquivo']['tmp_name'], $nomearquivo);
    }
}
?>
<form action="" enctype="multipart/form-data" method="post">
    <input name="arquivo" type="file" />
    <input type="submit" value="Enviar" />
</form>
