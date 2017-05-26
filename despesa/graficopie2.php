<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../repositorio/Master.php";
$dbo->graficoPie("SELECT `funcao_idfuncao`,SUM(valor) FROM despesa GROUP BY `funcao_idfuncao`","funcao_idfuncao");
?>
