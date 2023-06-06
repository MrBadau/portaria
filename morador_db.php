<?php
include_once("conexao.php");
include_once("function.php");

$id    = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
$nome   = protect($_POST['nome']);
$doc    = preg_replace('/[^[:alnum:]_]/', '',$_POST['doc']);
$email  = protect($_POST['email']);
$telefone = preg_replace('/[^[:alnum:]_]/', '',$_POST['telefone']);
$ramal  = preg_replace('/[^[:alnum:]_]/', '',$_POST['ramal']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$bloco  = preg_replace('/[^[:alnum:]_]/', '',$_POST['bloco']);
$andar  = preg_replace('/[^[:alnum:]_]/', '',$_POST['andar']);
$apartamento = preg_replace('/[^[:alnum:]_]/', '',$_POST['apartamento']);

$sql = "UPDATE MORADORES SET Nome = '".$nome."', Documento = '".$doc."', Email = '".$email."', Telefone = '".$telefone."', Ramal = '".$ramal."', Bloco = '".$bloco."', Andar = '".$andar."', Apartamento = '".$apartamento."', IDCO = '".$condominio."' WHERE IDMO = ".$id;

if (mysqli_query($con, $sql)) {
    mysqli_close($con);
    header('Location: moradoresList.php');
} else {
mysqli_close($con);
echo "Erro";
}