<?php
include "../repositorio/Master.php";
//header("Content-type: text/json");
/*
if ($result = $dbo->query("SELECT valor, data FROM receita ")) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
        // O valor x é o tempo atual do JavaScript, que é o tempo Unix multiplicado por 1000.
        $row['data'] = strtotime($row['data'])*1000;
        $row["valor"]= floatval($row["valor"]);
        $myArray[] = [$row["data"],$row["valor"]];
    }
   echo $_GET['callback']. '('. json_encode($myArray) . ')';
}
*/
$dbo->graficoD("SELECT valor, data FROM despesa");
?>
