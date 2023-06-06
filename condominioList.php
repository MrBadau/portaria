<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="pt-BR">

<?
include_once("head_menu.php");
include_once("conexao.php");
   
$sql = mysqli_query($con,"SELECT IDCO, Nome, CASE WHEN Type = 1 THEN 'Condomínio' ELSE 'Empresa' END Type FROM CONDOMINIO") or die("Erro"); ?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-building"></i> Empreendimentos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                      </tr>
                  </thead>
                  <tbody>
                      <? while($dados=mysqli_fetch_assoc($sql)) {?>
 
                        <tr onclick="visModal(<?=$dados['IDCO']?>)" style="cursor: pointer;">
                            <td><?=$dados['IDCO']?></td>
                            <td><?=$dados['Nome']?></td>
                            <td><?=$dados['Type']?></td>
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
      <div class="modal fade" id="modalMorador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes Condomínio/Empresa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <span id="detalhes"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
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
    
  <script>
    //modal
    function visModal(id){
      //alert("chamou a função "+id);
      //const dados = await fetch('visMorador.php?id=' +id);
      var dados = {
        id: id
      }
      $.post('condominioModalDados.php', dados, function(retorna){
        $('#detalhes').html(retorna);
        $('#modalMorador').modal('show');
      });
    }
    
  </script>
  <!-- Scroll to Top Button-->
  

</body>

</html>