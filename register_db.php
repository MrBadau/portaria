<?php
session_start();
include_once("conexao.php");
include_once("function.php");

$nameEmpresa = protect($_POST['nameEmpresa']);
$docEmpresa = preg_replace('/[^[:alnum:]_]/', '',$_POST['documento']);
$tipoEmpresa = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
$nomeUser = protect($_POST['nomeUser']);
$email  = protect($_POST['email']);
$senha  = protect($_POST['senha']);

$hash = password_hash($senha, PASSWORD_DEFAULT);

$query1  = "SELECT IDCO FROM CONDOMINIO WHERE Documento = '".$docEmpresa."'";
$res1 = mysqli_query($con, $query1);
$total1  = mysqli_num_rows($res1);

$query2  = "SELECT IDUR FROM USER WHERE Login = '".$email."'";
$res2 = mysqli_query($con, $query2);
$total2  = mysqli_num_rows($res2);

if ($total1 + $total2 == 0) {
    $sql1   = mysqli_query($con, "INSERT INTO CONDOMINIO (Nome, Documento, Type) VALUES ('".$nameEmpresa."', '".$docEmpresa."', '".$tipoEmpresa."')");
    $idCon  = mysqli_insert_id($con);

    $sql2   = mysqli_query($con, "INSERT INTO USER (Login, Hash, Name, Access, Active, IDCO) VALUES ('".$email."', '".$hash."', '".$nomeUser."', '2','1','".$idCon."')");
    $_SESSION['success'] = true;
    $_SESSION['messageError'] = 'Faça login e comece a utilizar o nosso sistema!';

} else if ($total1 > 0) {
    $_SESSION['messageError'] = 'Empresa já está cadastrada!';
    $_SESSION['success'] = false;
} else if ($total2 > 0) {
    $_SESSION['messageError'] = 'Usuário já está cadastrado!';
    $_SESSION['success'] = false;
}

mysqli_close($con);
header('Location: index.php');