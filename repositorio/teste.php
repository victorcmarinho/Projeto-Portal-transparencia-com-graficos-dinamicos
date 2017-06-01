<?php
include "master.php";
$r=$dbo->query("select * from receita limit 10");
$data=array();
while($result = $r->fetch_assoc()){
    $data[]=$result;
}
$i=0;
foreach ($data as $key) {
	$data[$i]['button'] = "<button class='btn btn-default' type='submit' name='".$data[$i]['idreceita']."' >Editar</button>";
	$i++;
}
$datax = array('data' => $data);
echo json_encode($datax);
?>
