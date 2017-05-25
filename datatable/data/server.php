<?php

$table = 'datatables_demo';
$primaryKey = 'id';
$columns = array(
    array( 'db' => 'aplicacao_variavel_idaplicacao_variavel', 'dt' => 0 ),
    array( 'db' => 'fonte_recurso_idfonte_recurso',  'dt' => 1 ),
    array( 'db' => 'aplicacao_idaplicacao',   'dt' => 2 ),
    array( 'db' => 'valor',     'dt' => 3 ),
    array( 'db' => 'data', 'dt'=>4));
$sql_details = array(
    'user' => '',
    'pass' => '',
    'db'   => '',
    'host' => ''
);

$conn = new mysqli('localhost','root','','projeto');
$conn->set_charset("utf8");
//if($result=$conn->query("SELECT aplicacao_idaplicacao,fonte_recurso_idfonte_recurso,fonte_idfonte,data,valor FROM `receita` LIMIT 20")){
//    if($result){
//        while($row = $result->fetch_assoc()){
//            echo "<pre>";
//            $array[]=$row;
//            print_r($array);
//            echo "</pre>";
//        }
//    }
//    $result->close();
//}
//print (json_encode($array));
