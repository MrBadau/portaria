<!DOCTYPE html>
<html lang="pt-BR">

<?
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
if (!$_SESSION['userLogged']) {
  header('Location: index.php');
}

include_once("head_menu.php");
include_once("conexao.php");

$sql = mysqli_query($con, "SELECT * FROM PAG_VARIABLES") or die("Erro"); ?>

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

          <? include_once("header_menu.php"); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left"></i> Textos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Local</th>
                      <th>Texto</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? while ($dados = mysqli_fetch_assoc($sql)) { ?>

                      <tr>
                        <td><?= $dados['IDPA'] ?></td>
                        <td><?= $dados['Local'] ?></td>
                        <td><?= $dados['Description'] ?></td>
                        <td><a href="edit_text.php?id=<?= $dados['IDPA'] ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a></td>
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
      <? include_once("footer_menu.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!--Modal-->


  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php"); ?>

  <!-- Scroll to Top Button-->


</body>

</html>