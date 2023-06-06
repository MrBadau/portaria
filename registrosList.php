<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
}?>

<!DOCTYPE html>
<html lang="pt-BR">

<? 
include_once("head_menu.php");
include_once("conexao.php");

if ($_SESSION['Access'] == 1) {
  $condicao = "AND IDEN > 0";
} else if ($_SESSION['Access'] == 2 OR $_SESSION['Access'] == 3) {
  $condicao = "AND IDCO = ".$_SESSION['userCon'];
}

$sql = mysqli_query($con,"SELECT IDEN, DATE_FORMAT(DataEntrada, '%d/%m/%Y %H:%i:%s') DataEntrada, DATE_FORMAT(DataSaida, '%d/%m/%Y %H:%i:%s') DataSaida, Name, Empresa 
FROM ENTRADAS 
WHERE DataSaida IS NOT NULL ".$condicao." ORDER BY 1 DESC") or die("Erro"); 
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <? include_once("menu.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <? include_once("header_menu.php");?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-book"></i> Registros</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="Table" width="100%" cellspacing="0">
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
 
                        <tr onclick="mostraModal(<?=$dados['IDEN']?>,1)" style="cursor: pointer;">
                            <td><?=$dados['IDEN']?></td>
                            <td><?=$dados['Name']?></td>
                            <td><?=$dados['Empresa']?></td>
                            <td><?=$dados['DataEntrada']?></td>
                            <td><?=$dados['DataSaida']?></td>
                            
                        </tr>

                      <? } ?>
                      
                      
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" id="detalhes">
            
          </div>
        </div>
      <!-- Modal -->

      <!-- Footer -->
      <? // include_once("footer_menu.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php");?>
  <!-- Scroll to Top Button-->
  <script>
    
    $(document).ready(function () {
      $('#Table').DataTable({
          order: [[0, 'desc']],
      });
  });

  //modal excluir
  function mostraModal(id, tipo){
      var pagina = 'registrosModalDados.php';
      var modal = 'modal';

      var dados = {
        id: id,
        tipo: tipo
      }
      $.post(pagina, dados, function(retorna){
        $('#detalhes').html(retorna);
        $('#'+modal).modal('show');
      });
    }
  </script>

</body>

</html>