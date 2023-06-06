<?php
include_once("conexao.php");
include_once("function.php");

$id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
$status = preg_replace('/[^[:alnum:]_]/', '',$_POST['idStatus']);
$usuario = preg_replace('/[^[:alnum:]_]/', '',$_POST['usuario']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$descricao = protect($_POST['descricao']);

if($status == 1) {
    $sql = "UPDATE OCORRENCIA SET Status = 1 WHERE IDOC = ".$id;
    $con->query($sql);
}
$query = "INSERT INTO OCORRENCIA_MESSAGES (IDOC,IDUR,Descricao) VALUES ('".$id."','".$usuario."','".$descricao."')";
$con->query($query);

mysqli_close($con);
//header('Location: ocorrenciaEdit.php?id='.$id);

echo $status."-status";