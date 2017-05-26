<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../repositorio/Master.php";
$dbo->graficoPie("SELECT `rubrica_idrubrica`,SUM(valor) FROM receita GROUP BY `rubrica_idrubrica`","rubrica_idrubrica");
?>
