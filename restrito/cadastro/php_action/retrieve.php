<?php
include_once '../../../repositorio/master.php';

$output = array('data' => array());

$query=$dbo ->query("SELECT * FROM `usuarios`");
$x = 1;
while ($row = $query->fetch_assoc()) {
	$active = '';
	if($row['ativo'] == 1) {
		$active = '<label class="label label-success">Ativado</label>';
	} else {
		$active = '<label class="label label-danger">Desativado</label>';
	}
    $nivel = '';
    if($row['nivel'] == 1) {
		$nivel = '<label class="label label-success">Administrativo</label>';
	} else {
		$nivel = '<label class="label label-info">Funcionário</label>';
	}
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Ação <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Editar usuário </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Remover usuário</a></li>
	  </ul>
	</div>
		';

	$output['data'][] = array(
		$row['id'],
		$row['nome'],
        $row['email'],
        $active,
        $nivel,
		$row['cpf'],

		$actionButton
	);

	$x++;
}

echo json_encode($output);
