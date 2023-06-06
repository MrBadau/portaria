<? 
if(isset($_POST['id'])){
    include_once 'conexao.php';
    $id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
    $tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
    $resultado = "";

    $query  = "SELECT Name FROM USER WHERE IDUR = ".$id." LIMIT 1";
    $result = mysqli_query($con, $query);
    $row    = mysqli_fetch_assoc($result);
    $url = '"regUsuario.php"';
    //echo $row["Nome"];

    $resultado .= "<div class='modal-header'>";
    $resultado .= "<h5 class='modal-title' id='exampleModalLabel'>Ativar/Inativar Usuário</h5>";
    $resultado .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    $resultado .= "<span aria-hidden='true'>&times;</span>";
    $resultado .= "</button>";
    $resultado .= "</div>";
    $resultado .= "<div class='modal-body'>";

    $resultado .= "<dl class='row'>";
    if ($tipo == 1) {
        $resultado .= "<dd class='col-sm-9'>Tem certeza que deseja inativar: ".$row['Name']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<div class='modal-footer'>";
        $resultado .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>";
        $resultado .= "<button type='button' class='btn btn-danger' onclick='submitFormUsuario(".$url.",$id)'>Confirmar</button>";
        $resultado .= "</div>";
    } else {
        $resultado .= "<dd class='col-sm-9'>Tem certeza que deseja ativar: ".$row['Name']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<div class='modal-footer'>";
        $resultado .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>";
        $resultado .= "<button type='button' class='btn btn-success' onclick='submitFormUsuario(".$url.",$id)'>Confirmar</button>";
        $resultado .= "</div>";
    } 
    
    echo $resultado;
} else {
    echo "Errrouuu!";
}