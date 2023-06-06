<?php
include_once("head_menu.php");
include_once("conexao.php");

$id = preg_replace('/[^[:alnum:]_]/', '',$_GET['id']);

$sql1 = mysqli_query($con,"SELECT Titulo, Status
                            FROM OCORRENCIA
                            WHERE IDOC = {$id} LIMIT 1") or die("Erro");

$sql2 = mysqli_query($con,"SELECT DATE_FORMAT(OM.Data, '%d/%m/%Y %H:%i:%s') Data, U.Name, OM.Descricao
    FROM OCORRENCIA_MESSAGES OM
    INNER JOIN OCORRENCIA O ON OM.IDOC = O.IDOC
    INNER JOIN USER U ON OM.IDUR = U.IDUR
    WHERE OM.IDOC = {$id}") or die("Erro");

while ($dados1 = mysqli_fetch_assoc($sql1)) {
    echo $dados1['Titulo']." - ".$dados1['Status']."<br><br>";
}

while ($dados2 = mysqli_fetch_assoc($sql2)) {
    echo $dados2['Data']." - ".$dados2['Descricao']."<br>";
}