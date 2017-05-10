<?php
include "csv.php";
include_once 'Master.php';
$csv = new csv("cajuru.csv",";");
$csv->getObject();

//$csv->mostra();


//$dbo->setReceita($csv->dado);
?>

