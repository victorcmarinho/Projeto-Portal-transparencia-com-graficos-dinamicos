<?php
include_once '../../../repositorio/master.php';
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$name = $_POST['editName'];
	$email = $_POST['editEmail'];
	$nivel = $_POST['editNivel'];
	$ativo = $_POST['editActive'];
	$sql = "UPDATE usuarios SET nome = '$name', email = '$email', nivel = '$nivel', ativo = '$ativo' WHERE id = $id";
	$query = $dbo->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Editado com sucesso";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Erro em alguma informação";
	}

	echo json_encode($validator);

}
