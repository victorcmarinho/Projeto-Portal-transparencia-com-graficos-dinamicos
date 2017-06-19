<?php

include_once '../../repositorio/master.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];

$sql = "DELETE FROM `licitacao` WHERE idlicitacao = {$memberId}";
$query = $dbo->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Licitação foi removido com sucesso';
} else {
	$output['success'] = false;
	$output['messages'] = 'Oops, Ocorreu algum erro, talvez a licitação já foi removida!';
}


echo json_encode($output);
