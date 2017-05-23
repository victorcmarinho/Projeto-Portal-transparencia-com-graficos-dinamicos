<?php
    include "../../repositorio/Master.php";
    include "../../repositorio/csv.php";
    if(isset($_FILES['arquivo'])){
        $tipos = array('text/csv','.csv','csv','application/vnd.ms-excel');
        if(array_search($_FILES['arquivo']['type'] , $tipos)){
            $nomearquivo = "temporario/".$_FILES['arquivo']['name'];
            copy($_FILES['arquivo']['tmp_name'], $nomearquivo);
        }
        $csv = new csv("temporario/".$_FILES['arquivo']['name'],";");
        set_time_limit(600);
        $csv->getObject();
        $dbo->setDespesa($csv->getDados());
    }
header("Location:cadastrodespesa.html");
?>
