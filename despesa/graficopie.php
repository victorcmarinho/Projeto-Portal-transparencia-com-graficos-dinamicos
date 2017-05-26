<?php
header('Content-Type: text/html; charset=utf-8');
include_once "../repositorio/Master.php";
$dbo->graficoPie("SELECT `tipo_despesa_idtipo_despesa`,SUM(valor) FROM despesa GROUP BY `tipo_despesa_idtipo_despesa`","tipo_despesa_idtipo_despesa");
?>
