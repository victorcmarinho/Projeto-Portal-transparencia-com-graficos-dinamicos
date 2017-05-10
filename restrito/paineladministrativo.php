<?php
include "../repositorio/Master.php";
include "../repositorio/csv.php";
$csv = new csv("cajuru.csv",";");
set_time_limit(600);
$csv->getObject();
//$csv->mostra();
$dbo->setReceita($csv->getDados());
//$dbo->setDespesa($csv->getDados());
?>
