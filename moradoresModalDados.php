<? session_start(); 
if(isset($_POST['id'])){
    include_once ('conexao.php');
    include_once ('function.php');
    include_once ('variable.php');
    

    $id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
    $resultado = '';

    $query  = "SELECT M.Nome, M.Documento, M.Email, M.Telefone, M.Ramal, M.Bloco, M.Andar, M.Apartamento, C.Nome Condominio, CASE WHEN M.Type = 1 THEN 'Morador' ELSE 'Funcionário' END Type FROM MORADORES M INNER JOIN CONDOMINIO C ON M.IDCO = C.IDCO WHERE M.IDMO = ".$id." LIMIT 1";
    $result = mysqli_query($con, $query);
    $row    = mysqli_fetch_assoc($result);
    //echo $row['Nome'];

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Tipo</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Type'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Nome</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Nome'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Documento</dt>';
    $resultado .= '<dd class="col-sm-9">'.formatCnpjCpf($row['Documento']).'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">'.$menuTypeCompany.'</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Condominio'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">E-mail</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Email'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Telefone</dt>';
    $resultado .= '<dd class="col-sm-9">'.formatPhone($row['Telefone']).'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Ramal</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Ramal'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Bloco</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Bloco'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Andar</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Andar'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Apartamento</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Apartamento'].'</dd>';
    $resultado .= '</dl>';
    echo $resultado;
} else {
    echo "Errrouuu!";
}