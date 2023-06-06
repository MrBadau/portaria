<?php
include_once("conexao.php");
include_once("function.php");

$nome = protect($_POST['nome']);
$cnpj = preg_replace('/[^[:alnum:]_]/', '',$_POST['cnpj']);
$tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
$endereco = protect($_POST['endereco']);
$numero = protect($_POST['numero']);
$bairro = protect($_POST['bairro']);
$cidade = protect($_POST['cidade']);
$cep = preg_replace('/[^[:alnum:]_]/', '',$_POST['cep']);

$query = "SELECT IDCO FROM CONDOMINIO WHERE Documento = '".$cnpj."'";
$res = mysqli_query($con, $query);
$total = mysqli_num_rows($res);

if($total == 0) {
    $sql = "INSERT INTO CONDOMINIO (Nome, Documento, Type, Endereco, Numero, Bairro, Cidade, CEP) VALUES ('".$nome."','".$cnpj."','".$tipo."','".$endereco."','".$numero."','".$bairro."','".$cidade."','".$cep."')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header('Location: condominioList.php');
    } else {
    mysqli_close($con);
    echo "Ocorreu um erro, teste novamente!";
    }
} else {
    mysqli_close($con);
    //echo "Está empresa já está cadastrada!";
    header('Location: error.php?message=Empresa já cadastrada!');
}