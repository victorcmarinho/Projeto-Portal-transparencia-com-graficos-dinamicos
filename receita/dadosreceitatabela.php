<?php
include "../repositorio/Master.php";
header('Content-Type: application/json; charset=utf-8');

/*
if ($result = $dbo->query("SELECT * FROM receita")) {
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
        //$row["valor"]= number_format($row["valor"],2,',',' ');
        $row["data"]= date('d m Y',strtotime($row["data"]));
        $myArray[] = $row;
    }
    echo $_GET['callback']. json_encode($myArray);
}
 */
/*
    $dbo->Tabela("SELECT * FROM receita");
 */
echo $_GET['callback'].json_encode($dbo->tabela("SELECT * FROM receita"),JSON_UNESCAPED_UNICODE);
//echo$dbo->tabela("SELECT * FROM receita LIMIT 10");
//$dbo->tabela("SELECT * FROM receita LIMIT 10");
?>
