<!DOCTYPE html>
<html lang="pt-BR">

<?
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
if (!$_SESSION['userLogged']) {
  header('Location: index.php');
}

include("head_menu.php");
include("conexao.php");

$sql = mysqli_query($con, "SELECT * FROM USER") or die("Erro"); ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <? include("menu.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <? include("header_menu.php"); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Usuários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>Ativo</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? while ($dados = mysqli_fetch_assoc($sql)) { ?>

                      <tr>
                        <td><?= $dados['IDUR'] ?></td>
                        <td><?= $dados['Login'] ?></td>
                        <td><?= $dados['Active'] ?></td>
                        <td><a href="excluir_usuario.php?id=<?= $dados['IDUR'] ?>" data-confirm='Tem certeza de que deseja excluir o item selecionado?' class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
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
      <? include("footer_menu.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <? include("footer_java.php"); ?>

  <script>
    $(document).ready(function() {
      $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        if (!$('#confirm-delete').length) {
          $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"><div class="modal-dialog"role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button></div><div class="modal-body"><p>Deseja excluir este usuário?</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button><a class="btn btn-danger" id="dataComfirmOK">Sim</a></div></div></div></div>');
        }
        $('#dataComfirmOK').attr('href', href);
        $('#confirm-delete').modal({
          show: true
        });
        return false;

      });
    });
  </script>
  <!-- Scroll to Top Button-->


</body>

</html>