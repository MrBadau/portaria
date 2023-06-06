<? include_once("conexao.php");

$ID = preg_replace('/[^[:alnum:]_]/', '',$_POST['ID']);
//$ID = preg_replace('/[^[:alnum:]_]/', '',$_GET['ID']);

$sql = mysqli_query($con,"SELECT Active FROM USER WHERE IDUR = ".$ID." LIMIT 1") or die("Erro");
$dados = mysqli_fetch_assoc($sql);

if ($dados['Active']){
    $query = "UPDATE USER SET Active = 0 WHERE IDUR = ".$ID;
} else {
    $query = "UPDATE USER SET Active = 1 WHERE IDUR = ".$ID;
}
mysqli_query($con, $query);

echo $query;