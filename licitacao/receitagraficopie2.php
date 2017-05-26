<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../repositorio/Master.php";
$dbo->graficoPie("SELECT `fonte_idfonte`,SUM(valor) FROM receita GROUP BY `fonte_idfonte`","fonte_idfonte");
?>
