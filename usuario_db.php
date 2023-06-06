<?php
include_once("conexao.php");
include_once("function.php");

$email = protect($_POST['email']);
$name = protect($_POST['nome']);
$senha = protect($_POST['senha']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);

$hash = password_hash($senha, PASSWORD_DEFAULT);

$query = "SELECT IDUR FROM USER WHERE Login = '".$email."'";
$res = mysqli_query($con, $query);
$total = mysqli_num_rows($res);

if($total == 0) {
    $sql = "INSERT INTO USER (Login, Hash, Name, Access, IDCO, Active)
VALUES ('".$email."', '".$hash."','".$name."','".$tipo."','".$condominio."',1)";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header('Location: usuarioList.php');
    } else {
    mysqli_close($con);
    echo "Erro";
    }
} else {
    mysqli_close($con);
    //echo "Este usuário já está cadastrado!";
    header('Location: error.php?message=Este usuário já está cadastrado!');
}