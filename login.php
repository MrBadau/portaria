<?php
session_start();
include_once ('conexao.php');
include_once("function.php");


$usuario = protect($_POST['usuario']);
$senha = protect($_POST['senha']);


$sql   = mysqli_query($con,"SELECT IDUR, Name, IDCO, Access, Hash FROM USER WHERE Active = 1 AND Login = '{$usuario}'") or die("Erro");
$dados = mysqli_fetch_assoc($sql);
$row = mysqli_num_rows($sql);
mysqli_close($con);

if(
    ($row == 1) 
    AND 
    (password_verify($senha, $dados['Hash']))
    ){
    $_SESSION['userLogged'] = true;
    $_SESSION['userID'] = $dados['IDUR'];
    $_SESSION['userCon'] = $dados['IDCO'];
    $_SESSION['userName'] = $dados['Name'];
    $_SESSION['Access'] = $dados['Access'];
    header('Location: menuinicial.php');
    
} else {
    if (!password_verify($senha, $dados['Hash'])){
        $_SESSION['messageError'] = 'Senha inválida';
    } else if ($row == 0){
        $_SESSION['messageError'] = 'E-mail não encontrado';
    }
    $_SESSION['success'] = false;
    header('Location: index.php');
}