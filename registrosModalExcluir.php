<? 
if(isset($_POST['id'])){
    include_once 'conexao.php';
    $id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
    $tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
    $resultado = '';

    $query  = "SELECT Name FROM ENTRADAS WHERE IDEN = ".$id." LIMIT 1";
    $result = mysqli_query($con, $query);
    $row    = mysqli_fetch_assoc($result);
    //echo $row['Nome'];

    $resultado .= '<dl class="row">';
    $resultado .= '<dd class="col-sm-9">Tem certeza que deseja registrar a saída de: '.$row['Name'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dd class="col-sm-9">Tipo: '.$tipo.'</dd>';
    $resultado .= '</dl>';
    echo $resultado;
} else {
    echo "Errrouuu!";
}