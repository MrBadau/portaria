<? include_once("conexao.php");

$ID = preg_replace('/[^[:alnum:]_]/', '',$_POST['ID']);

$query = "UPDATE ENTRADAS SET DataSaida = NOW() WHERE IDEN = ".$ID;
mysqli_query($con, $query);