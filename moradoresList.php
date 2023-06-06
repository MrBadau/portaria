<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} ?>

<!DOCTYPE html>
<html lang="pt-BR">

<? 
include_once("head_menu.php");
include_once("conexao.php");
include_once("variable.php");


if ($_SESSION['Access'] == 1) {
  $condicao = "M.IDMO > 0";
} else if ($_SESSION['Access'] == 2 OR $_SESSION['Access'] == 3) {
  $condicao = "M.IDCO = ".$_SESSION['userCon'];
}
   
$sql = mysqli_query($con,"SELECT M.IDMO, M.Nome, C.Nome Condominio, M.Bloco, M.Andar, M.Apartamento
FROM MORADORES M
INNER JOIN CONDOMINIO C ON M.IDCO = C.IDCO
WHERE ".$condicao) or die("Erro"); ?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-users"></i> <?=$menuTypePeople?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Morador(a)</th>
                        <th>Condomínio</th>
                        <th>Bloco</th>
                        <th>Andar</th>
                        <th>Apartamento</th>
                        <th>#</th>
                      </tr>
                  </thead>
                  <tbody>
                      <? while($dados=mysqli_fetch_assoc($sql)) {?>
                        
                        <tr onclick="visMorador(<?=$dados['IDMO']?>)" style="cursor: pointer;">
                            <td><?=$dados['IDMO']?></td>
                            <td><?=$dados['Nome']?></td>
                            <td><?=$dados['Condominio']?></td>
                            <td><?=$dados['Bloco']?></td>
                            <td><?=$dados['Andar']?></td>
                            <td><?=$dados['Apartamento']?></td>
                            <td><a href="moradorEdit.php?id=<?=$dados['IDMO']?>" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a></td>
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
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do <?=$menuTypePeople?></h5>
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
    function visMorador(id){
      //alert("chamou a função "+id);
      //const dados = await fetch('visMorador.php?id=' +id);
      var dados = {
        id: id
      }
      $.post('moradoresModalDados.php', dados, function(retorna){
        $('#detalhes').html(retorna);
        $('#modalMorador').modal('show');
      });
    }
    
  </script>
  <!-- Scroll to Top Button-->
  

</body>

</html>