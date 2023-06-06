<? 
//include_once("head_menu.php");
include_once("conexao.php");
   
$sql = mysqli_query($con,"SELECT O.IDOC, DATE_FORMAT(O.Data, '%d/%m/%Y %H:%i:%s') Data, O.Titulo, U.Name, M.Nome, OT.Type, CASE
WHEN O.Status = 0 THEN 'Aberto'
ELSE 'Fechado' 
END Status
FROM OCORRENCIA O
INNER JOIN USER U ON O.IDUR = U.IDUR
INNER JOIN OCORRENCIA_TYPE OT ON O.IDOT = OT.IDOT
LEFT JOIN MORADORES M ON O.IDMO = M.IDMO
ORDER BY O.IDOC DESC") or die("Erro"); ?>

<table>
    <thead>
        <tr>
        <th>ID</th>
        <th>Data</th>
        <th>Usuário</th>
        <th>Título</th>
        <th>Morador</th>
        <th>Tipo</th>
        <th>Status</th>
        <th>#</th>
        </tr>
    </thead>
    <tbody>
    <? while($dados=mysqli_fetch_assoc($sql)) {?>
        <tr>
            <td><?=$dados['IDOC']?></td>
            <td><?=$dados['Data']?></td>
            <td><?=$dados['Name']?></td>
            <td><?=$dados['Titulo']?></td>
            <td><?=$dados['Nome']?></td>
            <td><?=$dados['Type']?></td>
            <td><?=$dados['Status']?></td>
            <td><a href="ocorrenciaEdit.php?id=<?=$dados['IDOC']?>" class="btn btn-warning btn-circle"><i class="fas fa-eye"></i></a></td>
        </tr>
    <? } ?>
    </tboby>
    </table>