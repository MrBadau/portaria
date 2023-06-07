<?php
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
if (!$_SESSION['userLogged']) {
  header('Location: index.php');
} ?>

<!DOCTYPE html>
<html lang="pt-BR">

<?php
include_once("head_menu.php");
include_once("conexao.php");

$id = preg_replace('/[^[:alnum:]_]/', '', $_GET['id']);

$sql1 = mysqli_query($con, "SELECT Titulo, Status
FROM OCORRENCIA
WHERE IDOC = {$id} LIMIT 1") or die("Erro1");
$dados1 = mysqli_fetch_assoc($sql1);

$sql2 = mysqli_query($con, "SELECT DATE_FORMAT(OM.Data, '%d/%m/%Y %H:%i:%s') Data, U.Name, OM.Descricao
FROM OCORRENCIA_MESSAGES OM
INNER JOIN OCORRENCIA O ON OM.IDOC = O.IDOC
INNER JOIN USER U ON OM.IDUR = U.IDUR
WHERE OM.IDOC = {$id}") or die("Erro2"); ?>

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
          <h1 class="h3 mb-4 text-gray-800">Ocorrência <?= $id ?> - <?= $dados1['Titulo'] ?></h1>

          <? while ($dados2 = mysqli_fetch_assoc($sql2)) { ?>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-user"></i> <?= $dados2['Name'] ?> - <?= $dados2['Data'] ?></h6>
              </div>
              <div class="card-body">
                <p><?= $dados2['Descricao'] ?></p>
              </div>
            </div>
          <? } ?>

          <? if (!$dados1['Status']) { ?>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-custom"> Registrar na Ocorrência</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form id="form" class="form">
                    <div class="form-group col-sm-6">
                      <input type="hidden" name="id" id="id" value="<?= $id ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <input type="hidden" name="usuario" id="usuario" value="<?= $_SESSION['userID'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <input type="hidden" name="condominio" id="condominio" value="<?= $_SESSION['userCon'] ?>">
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Descrição"></textarea>
                    </div>



                    <? if ($_SESSION['Access'] == 3) { ?>
                      <div class="form-group">
                        <button class="btn btn-custom" onclick="submitFormOcorrencia('ocorrenciaMessage_db.php',0)">Enviar</button>
                      </div>
                    <? } else { ?>
                      <div class="dropdown mb-4">
                        <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Enviar como
                        </button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                          <button class="dropdown-item" onclick="submitFormOcorrencia('ocorrenciaMessage_db.php',0)">Aberto</button>
                          <button class="dropdown-item" onclick="submitFormOcorrencia('ocorrenciaMessage_db.php',1)">Fechado</button>
                        </div>
                      </div>
                    <? } ?>

                  </form>
                </div>
              </div>
            </div>
        </div>
      <? } ?>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <? include_once("footer_menu.php"); ?>
      <!-- End of Footer -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php"); ?>
  <!-- Scroll to Top Button-->

  <script>
    $(document).ready(function() {
      $("#form").validate({
        rules: {
          descricao: {
            required: true,
            minlength: 5

          }

        }

      })
    })
  </script>
</body>

</html>