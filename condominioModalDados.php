<? 
if(isset($_POST['id'])){
    include_once ('conexao.php');
    include_once ('function.php');

    $id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
    $resultado = '';

    $query  = "SELECT Nome, Documento, Endereco, Numero, Bairro, Cidade, CEP, DATE_FORMAT(DataCad, '%d/%m/%Y %H:%i:%s') DataCad, CASE
    WHEN Type = 1 THEN 'Condomínio'
    ELSE 'Empresa'
END Type
    FROM CONDOMINIO 
    WHERE IDCO = ".$id." LIMIT 1";
    $result = mysqli_query($con, $query);
    $row    = mysqli_fetch_assoc($result);
    //echo $row['Nome'];

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Nome</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Nome'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Cadastrado em:</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['DataCad'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">CNPJ</dt>';
    $resultado .= '<dd class="col-sm-9">'.formatCnpjCpf($row['Documento']).'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Tipo</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Type'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Endereço</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Endereco'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Número</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Numero'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Bairro</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Bairro'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">Cidade</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['Cidade'].'</dd>';
    $resultado .= '</dl>';
    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-3">CEP</dt>';
    $resultado .= '<dd class="col-sm-9">'.$row['CEP'].'</dd>';
    $resultado .= '</dl>';
    echo $resultado;
} else {
    echo "Errrouuu!";
}