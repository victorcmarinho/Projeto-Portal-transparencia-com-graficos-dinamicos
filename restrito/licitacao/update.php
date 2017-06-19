<?php

require_once '../../repositorio/master.php';
session_start();
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());
    $id = $_POST['member_id'];
	$contrato = $_POST['editcontrato'];
	$numero = $_POST['editnumero'];
	$objetivo = $_POST['editobjetivo'];
	$inicio = $_POST['editinicio'];
    $termino = $_POST['edittermino'];
    $valor = $_POST['editvalor'];
    $orgao = $_POST['editorgao'];
    if($_FILES["editarquivo"]["name"] != ''){
			if(isset($_FILES["arquivo"])){
                $extension = explode('.', $_FILES['editarquivo']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = './upload/' . $new_name;
                move_uploaded_file($_FILES['arquivo']['tmp_name'], $destination);
                $arquivo=$new_name;
	       }
        $sql = "UPDATE `licitacao` SET contrato = '$contrato', numero = '$numero', objetivo = '$objetivo', inicio = '$inicio' , termino = '$termino' , valor ='$valor', orgao_id='$orgao' , arquivo='$arquivo' WHERE idlicitacao = $id";
    }else{
        $sql = "UPDATE `licitacao` SET contrato = '$contrato', numero = '$numero', objetivo = '$objetivo', inicio = '$inicio' , termino = '$termino' , valor ='$valor', orgao_id='$orgao' WHERE idlicitacao = $id";
    }
    echo "$sql<br>";
	$query = $dbo->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Atualizado com sucesso";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error tente novamente mais tarde";
	}
	echo json_encode($validator);
    if(isset($_SESSION['location'])){
        header("location:".$_SESSION['location']);
    }else{
        header("location:licitacao.php");
    }

}
