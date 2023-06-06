<? include_once("conexao.php");

$usuario = preg_replace('/[^[:alnum:]_]/', '',$_POST['usuario']);
$condominio = preg_replace('/[^[:alnum:]_]/', '',$_POST['condominio']);
$morador = preg_replace('/[^[:alnum:]_]/', '',$_POST['morador']);
$name =     $_POST['nome'];
$documento = $_POST['documento'];
$empresa = $_POST['empresa'];
$tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
$veiculo = $_POST['veiculo'];
$placa = $_POST['placa'];
$pessoas = preg_replace('/[^[:alnum:]_]/', '',$_POST['pessoas']);
$descricao = $_POST['descricao'];


$query = "INSERT INTO ENTRADAS (IDUR,IDCO,IDMO,DataEntrada,DataSaida,Name,Documento,Empresa,Tipo,Veiculo,Placa,Pessoas,Descricao) 
VALUES ('".$usuario."','".$condominio."','".$morador."',NOW(),NULL,'".$name."','".$documento."','".$empresa."','".$tipo."','".$veiculo."','".$placa."','".$pessoas."','".$descricao."')";
mysqli_query($con, $query);