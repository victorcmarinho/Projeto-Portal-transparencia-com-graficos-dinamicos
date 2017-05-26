<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../repositorio/Master.php";
$dbo->graficoPie("SELECT `aplicacao_idaplicacao`,SUM(valor) FROM despesa GROUP BY `aplicacao_idaplicacao`","aplicacao_idaplicacao");
?>
