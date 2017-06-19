<?php
include_once("../../repositorio/master.php");
include_once("function.php");
//if form is submitted

if($_POST) {
	$validator = array('success' => false, 'messages' => array());

	$contrato = $_POST['contrato'];
	$numero = $_POST['numero'];
	$objetivo = $_POST['objetivo'];
	$inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $valor = $_POST['valor'];
    $orgao = $_POST['orgao'];
    if($_FILES["arquivo"]["name"] != ''){
			if(isset($_FILES["arquivo"])){
                $extension = explode('.', $_FILES['arquivo']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = './upload/' . $new_name;
                move_uploaded_file($_FILES['arquivo']['tmp_name'], $destination);
                $arquivo=$new_name;
	       }
    }

	$sql = "INSERT INTO `licitacao` (`contrato`, `numero`, `objetivo`, `inicio`, `termino`, `valor`, `orgao_id`, `arquivo`) VALUES('$contrato', '$numero', '$objetivo', '$inicio','$termino','$valor','$orgao','$arquivo')";
	$query = $dbo->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Sucesso a licitação foi adicionada";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error: existe algum erro, por favor tente mais tarde";
	}

	echo json_encode($validator);
    header("location:licitacao.php");
}
