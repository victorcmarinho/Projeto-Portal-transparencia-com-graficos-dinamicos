<?php

include_once '../../../repositorio/master.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];

$sql = "DELETE FROM usuarios WHERE id = {$memberId}";
$query = $dbo->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Usuário foi removido com sucesso';
} else {
	$output['success'] = false;
	$output['messages'] = 'Oops, Ocorreu algum erro, talvez o usuário já foi removido!';
}


echo json_encode($output);
