<?php
include_once("conexao.php");

$nome = preg_replace('/[^[:alpha:]_]/', '',$_POST['name']);
$image = $_FILES['image']['name'];
$ativo = $_POST['ativo'];

if($ativo == true){
    $ativo = "1";
} else {
    $ativo = "0";
}

$_UP['pasta'] = "../img/servico/";

//Tamanho máximo do arquivo em Bytes
$_UP['tamanho'] = 1920*1080*200; //5mb

$_UP['extensoes'] = array('png', 'jpg', 'jpeg');

$_UP['renomeia'] = false;

$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
if($_FILES['image']['error'] != 0){
    die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['image']['error']]);
    exit; //Para a execução do script
}

//Faz a verificação da extensao do arquivo
$extensao = strtolower(end(explode('.', $_FILES['image']['name'])));
if(array_search($extensao, $_UP['extensoes'])=== false){		
    echo "A imagem não foi cadastrada extensão inválida.";
}
			
//Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['image']['size']){
    echo "Arquivo muito grande.";
}
			
//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
else{
    
    //mantem o nome original do arquivo
    $nome_final = $_FILES['image']['name'];
        
    //Verificar se é possivel mover o arquivo para a pasta escolhida
    if(move_uploaded_file($_FILES['image']['tmp_name'], $_UP['pasta'].$nome_final)){
        //Upload efetuado com sucesso, exibe a mensagem
        $query = mysqli_query($con, "INSERT INTO SERVICE (
        Name, Image, Active) VALUES ('".$nome."','".$nome_final."','".$ativo."')");

        mysqli_close($con);
        
        header('Location: servico.php');	
    }else{
        //Upload não efetuado com sucesso, exibe a mensagem
        echo "Imagem não foi cadastrada com Sucesso.";
    }
}