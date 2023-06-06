<?php
include_once("conexao.php");
include_once("function.php");

$nome   = protect($_POST['nome']);
$doc    = preg_replace('/[^[:alnum:]_]/', '',$_POST['doc']);
$email  = protect($_POST['email']);
$telefone = preg_replace('/[^[:alnum:]_]/', '',$_POST['telefone']);
$ramal  = preg_replace('/[^[:alnum:]_]/', '',$_POST['ramal']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$bloco  = preg_replace('/[^[:alnum:]_]/', '',$_POST['bloco']);
$andar  = preg_replace('/[^[:alnum:]_]/', '',$_POST['andar']);
$apartamento = preg_replace('/[^[:alnum:]_]/', '',$_POST['apartamento']);

$sql    = mysqli_query($con,"SELECT Type FROM CONDOMINIO WHERE IDCO = '".$condominio."'");
$dados  = mysqli_fetch_assoc($sql);

$query  = "SELECT IDMO FROM MORADORES WHERE Documento = '".$doc."'";
$res    = mysqli_query($con, $query);
$total  = mysqli_num_rows($res);

if($total == 0) {
    $sql = "INSERT INTO MORADORES (Nome, Type, IDCO, Documento, Email, Telefone, Ramal, Bloco, Andar, Apartamento)
VALUES ('".$nome."', '".$dados['Type']."', '".$condominio."','".$doc."','".$email."','".$telefone."','".$ramal."','".$bloco."','".$andar."','".$apartamento."')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header('Location: moradoresList.php');
    } else {
    mysqli_close($con);
    echo "Erro";
    }
} else {
    mysqli_close($con);
    //echo "Já existe um morador com este documento!";
    header('Location: error.php?message=Já existe um morador com este documento!');
}