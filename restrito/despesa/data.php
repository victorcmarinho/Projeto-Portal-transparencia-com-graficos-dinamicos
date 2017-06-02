<?php
//    $dbo =  new mysqli("localhost","root","",'projeto');
//    $query=$dbo->query("SELECT idreceita,data,valor,fonte_idfonte FROM `receita`");
//    $data=array();
//    while($result = $query->fetch_assoc()){
//        $data[]=$result;
//    }
//    $i=0;
//    foreach ($data as $key) {
//        $data[$i]['button'] = "<button class='btn btn-default' type='submit' name='editar' value='".$data[$i]['idreceita']."' >Editar</button>";
//        $i++;
//    }
//    $datax = array('data' => $data);
//    echo json_encode($datax);
include "../../repositorio/master.php";
$dbo->tabelaD("SELECT * FROM despesa","iddespesa");
?>
