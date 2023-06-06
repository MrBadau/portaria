<?

include_once("conexao.php"); 

$sql = mysqli_query($con,"SELECT IDEN, DATE_FORMAT(DataEntrada, '%d/%m/%Y %H:%i:%s') DataEntrada, Name, Empresa FROM ENTRADAS WHERE DataSaida IS NULL ORDER BY 1 DESC") or die("Erro");  ?>

<div id="regEntradas" class="table-responsive">
    <table class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Empresa</th>
            <th>Entrada</th>
            <th>Saída</th>
            
            </tr>
        </thead>
        <tbody>
        <? while($dados=mysqli_fetch_assoc($sql)) {?>
            <tr id="tr<?=$dados['IDEN']?>" style="cursor: pointer;">
                <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['IDEN']?></td>
                <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['Name']?></td>
                <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['Empresa']?></td>
                <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['DataEntrada']?></td>
                <!-- <td><button onclick="mostraModal(<=$dados['IDEN']?>,2)" class="btn btn-danger">R. Saída</button></td> -->
                <td><button class="btn btn-danger btn-icon-split btn-sm" onclick="mostraModal(<?=$dados['IDEN']?>,2)"><span class="icon text-white-50"><i class="fa-window-close fas"></i></span><span class="text">R. Saída</span></button></td>
                <!--<td><button onclick="submitForm('regSaida.php',<=$dados['IDEN']?>)" class="btn btn-danger">R. Saída</button></td>-->
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>