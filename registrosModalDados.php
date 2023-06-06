<? 
if(isset($_POST['id'])){
    include_once ('conexao.php');
    include_once ('function.php');
    
    $id = preg_replace('/[^[:alnum:]_]/', '',$_POST['id']);
    $tipo = preg_replace('/[^[:alnum:]_]/', '',$_POST['tipo']);
    $resultado = "";

    if ($tipo == 1){
        $query  = "SELECT DATE_FORMAT(E.DataEntrada, '%d/%m/%Y %H:%i:%s') DataEntrada, DATE_FORMAT(E.DataSaida, '%d/%m/%Y %H:%i:%s') DataSaida, E.Name, E.Documento, E.Empresa, CASE
        WHEN E.Tipo = 1 THEN 'Visitou'
        WHEN E.Tipo = 2 THEN 'Buscou'
        WHEN E.Tipo = 3 THEN 'Entrou'
        WHEN E.Tipo = 4 THEN 'Serviço'
        ELSE 'Encomenda'
    END Tipo, E.Veiculo, E.Placa, E.Pessoas, E.Descricao, C.Nome Condominio
    FROM ENTRADAS E
    INNER JOIN CONDOMINIO C ON E.IDCO = C.IDCO WHERE IDEN = ".$id." LIMIT 1";
        $result = mysqli_query($con, $query);
        $row    = mysqli_fetch_assoc($result);
        //echo $row['Nome'];

        $resultado .= "<div class='modal-header'>";
        $resultado .= "<h5 class='modal-title' id='exampleModalLabel'>Detalhes do Registro de Entrada</h5>";
        $resultado .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $resultado .= "<span aria-hidden='true'>&times;</span>";
        $resultado .= "</button>";
        $resultado .= "</div>";
        $resultado .= "<div class='modal-body'>";

        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Condomínio</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Condominio']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Entrada</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['DataEntrada']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Saída</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['DataSaida']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Nome</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Name']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Documento</dt>";
        $resultado .= "<dd class='col-sm-9'>".formatCnpjCpf($row['Documento'])."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Empresa</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Empresa']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Tipo</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Tipo']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Veículo</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Veiculo']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Placa</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Placa']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Qtde Pessoas</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Pessoas']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "<dl class='row'>";
        $resultado .= "<dt class='col-sm-3'>Descrição</dt>";
        $resultado .= "<dd class='col-sm-9'>".$row['Descricao']."</dd>";
        $resultado .= "</dl>";
        $resultado .= "</div>";

        $resultado .= "<div class='modal-footer'>";
        $resultado .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>";
        $resultado .= "</div>";

    } else if ($tipo == 2) {
        $query  = "SELECT Name FROM ENTRADAS WHERE IDEN = ".$id." LIMIT 1";
        $result = mysqli_query($con, $query);
        $row    = mysqli_fetch_assoc($result);
        $url = '"regSaida.php"';
        //echo $row["Nome"];

        $resultado .= "<div class='modal-header'>";
        $resultado .= "<h5 class='modal-title' id='exampleModalLabel'>Confirmar Saída</h5>";
        $resultado .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $resultado .= "<span aria-hidden='true'>&times;</span>";
        $resultado .= "</button>";
        $resultado .= "</div>";
        $resultado .= "<div class='modal-body'>";

        $resultado .= "<dl class='row'>";
        $resultado .= "<dd class='col-sm-9'>Tem certeza que deseja registrar a saída de: ".$row['Name']."</dd>";
        $resultado .= "</dl>";

        $resultado .= "<div class='modal-footer'>";
        $resultado .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>";
        $resultado .= "<button type='button' class='btn btn-danger' onclick='submitForm(".$url.",$id)'>Confirmar</button>";
        $resultado .= "</div>";
    }
    
    echo $resultado;
} else {
    echo "Errrouuu!";
}