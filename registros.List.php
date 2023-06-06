<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
}?>

<!DOCTYPE html>
<html lang="pt-BR">

<? include_once("head_menu.php");
include_once("conexao.php");
   
$sql = mysqli_query($con,"SELECT O.IDOC, DATE_FORMAT(O.Data, '%d/%m/%Y %H:%i:%s') Data, O.Titulo, U.Name, M.Nome, OT.Type, CASE
WHEN O.Status = 0 THEN 'Aberto'
ELSE 'Fechado' 
END Status
FROM OCORRENCIA O
INNER JOIN USER U ON O.IDUR = U.IDUR
INNER JOIN OCORRENCIA_TYPE OT ON O.IDOT = OT.IDOT
LEFT JOIN MORADORES M ON O.IDMO = M.IDMO
ORDER BY 1 DESC") or die("Erro"); ?>

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
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-bullhorn"></i> Ocorrências</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="Table" width="100%" cellspacing="0">
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
                      
                      
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <? include_once("footer_menu.php");?>
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
  </script>

</body>

</html>