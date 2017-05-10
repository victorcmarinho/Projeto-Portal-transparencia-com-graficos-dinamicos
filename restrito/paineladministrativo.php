<?php
include "../repositorio/Master.php";
include "../repositorio/csv.php";
$csv = new csv("cajuru.csv",";");
$csv->getObject();
//$csv->mostra();
$dbo->setReceita($csv->getDados());
?>
