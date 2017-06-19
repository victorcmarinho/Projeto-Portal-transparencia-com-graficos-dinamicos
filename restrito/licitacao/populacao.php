<?php
include_once('../../repositorio/master.php');
include('function.php');
$output = array('data' => array());
$query =$dbo ->query("SELECT * FROM `licitacao`");
$x = 1;
while ($row = $query->fetch_assoc()) {
    $arquivo = '<a href="upload/'.$row["arquivo"].'">'.$row["arquivo"].'</a>';
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Ação <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editModal" onclick="editLicitacao('.$row['idlicitacao'].')"> <span class="glyphicon glyphicon-edit"></span> Editar licitação </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeModal" onclick="removeLicitacao('.$row['idlicitacao'].')"> <span class="glyphicon glyphicon-trash"></span> Remover licitação</a></li>
	  </ul>
	</div>
		';

	$output['data'][] = array(
		$row['idlicitacao'],
		$row['contrato'],
        $row['numero'],
		$row['objetivo'],
        $row['inicio'],
        $row['termino'],
        $row['valor'],
        $row['orgao_id'],
        $arquivo,
		$actionButton
	);

	$x++;
}

echo json_encode($output);
?>
