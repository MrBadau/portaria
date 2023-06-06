<? include_once("conexao.php");

$name =     $_POST['nome'];
$documento = $_POST['documento'];
$empresa = $_POST['empresa'];
$tipo = $_POST['tipo'];
$veiculo = $_POST['veiculo'];
$placa = $_POST['placa'];
$pessoas = $_POST['pessoas'];
$descricao = $_POST['descricao'];

$query = "INSERT INTO ENTRADAS (DataEntrada,DataSaida,Name,Documento,Empresa,Tipo,Veiculo,Placa,Pessoas,Descricao) 
VALUES (NOW(),NULL,'".$name."','".$documento."','".$empresa."','".$tipo."','".$veiculo."','".$placa."','".$pessoas."','".$descricao."')";
mysqli_query($con, $query);