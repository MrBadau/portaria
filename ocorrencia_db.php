<?php
include_once("conexao.php");
include_once("function.php");

$titulo = protect($_POST['titulo']);
$tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
$morador = preg_replace('/[^[:alnum:]_]/', '',$_POST['morador']);
$usuario = preg_replace('/[^[:alnum:]_]/', '',$_POST['usuario']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$descricao = protect($_POST['descricao']);

$query = "INSERT INTO OCORRENCIA (IDUR,IDCO,IDMO,IDOT,Titulo) VALUES ('".$usuario."','".$condominio."','".$morador."','".$tipo."','".$titulo."')";
$con->query($query);
$id = $con->insert_id;

if ($id > 0) {
    
    $query = "INSERT INTO OCORRENCIA_MESSAGES (IDOC,IDUR,Descricao) VALUES ('".$id."','".$usuario."','".$descricao."')";
    $con->query($query);
    mysqli_close($con);
    header('Location: ocorrenciaList.php');
} else {
    echo "Erro";
}