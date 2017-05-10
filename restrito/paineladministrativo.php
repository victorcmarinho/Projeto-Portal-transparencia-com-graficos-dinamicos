<?php
include "../repositorio/Master.php";
include "../repositorio/csv.php";
$csv = new csv("despesacajuru.csv",";");
$csv->getObject();
//$csv->mostra();
//$dbo->setReceita($csv->getDados());
$dbo->setDespesa($csv->getDados());
?>
