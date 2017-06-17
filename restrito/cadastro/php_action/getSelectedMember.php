<?php
include_once '../../../repositorio/master.php';

$memberId = $_POST['member_id'];

$sql = "SELECT * FROM usuarios WHERE id = $memberId";
$query = $dbo->query($sql);
$result = $query->fetch_assoc();
echo json_encode($result);

