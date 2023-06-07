<?
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
if (!$_SESSION['userLogged']) {
  header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="pt-BR">

<? include_once("head_menu.php");
include_once("conexao.php");
include_once("variable.php"); ?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-bullhorn"></i> Cadastrar Ocorrência</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form name="form" id="form" enctype="multipart/form-data" action="ocorrencia_db.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
                  </div>

                  <? $sql1 = mysqli_query($con, "SELECT * FROM OCORRENCIA_TYPE") or die("Erro"); ?>
                  <div class="form-group">
                    <select name="tipo" id="tipo" class="form-control">
                      <option value="">Tipo</option>
                      <? while ($dados1 = mysqli_fetch_assoc($sql1)) { ?>
                        <option value="<?= $dados1['IDOT'] ?>"><?= $dados1['Type'] ?></option>
                      <? } ?>
                    </select>
                  </div>

                  <?
                  if ($_SESSION['Access'] == 1) {
                    $condicao = "IDMO > 0";
                  } else if ($_SESSION['Access'] == 2 or $_SESSION['Access'] == 3) {
                    $condicao = "IDCO = " . $_SESSION['userCon'];
                  }
                  $sql1 = mysqli_query($con, "SELECT IDMO, CONCAT(Nome, CASE WHEN Type = 1 THEN ' - Ap: ' ELSE ' - Sala: ' END,Apartamento) Nome FROM MORADORES WHERE " . $condicao . " ORDER BY Type, Nome") or die("Erro");
                  //$sql2 = mysqli_query($con,"SELECT IDMO, CONCAT(Nome, CASE WHEN Type = 1 THEN ' - Ap: ' ELSE ' - Sala: ' END,Apartamento) Nome FROM MORADORES WHERE Type = 2 ".$condicao." ORDER BY Type, Nome") or die("Erro");
                  ?>
                  <div class="form-group">
                    <select name="morador" id="morador" class="form-control">
                      <optgroup label="<?= $menuTypePeople ?>">
                        <? while ($dados = mysqli_fetch_assoc($sql1)) { ?>
                          <option value="<?= $dados['IDMO'] ?>"><?= $dados['Nome'] ?></option>
                        <? } ?>
                      </optgroup>

                    </select>
                  </div>


                  <div class="form-group col-sm-6">
                    <input type="hidden" name="usuario" id="usuario" value="<?= $_SESSION['userID'] ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="hidden" name="condominio" id="condominio" value="<?= $_SESSION['userCon'] ?>">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Descrição"></textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-custom">Cadastrar</button>
                  </div>

                </form>
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
  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php"); ?>
  <!-- Scroll to Top Button-->

  <script>
    $(document).ready(function() {
      $("#form").validate({
        rules: {
          titulo: {
            required: true
          },
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