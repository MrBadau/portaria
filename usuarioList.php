<?
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
if (!$_SESSION['userLogged']) {
  header('Location: index.php');
} ?>

<!DOCTYPE html>
<html lang="pt-BR">

<?
include_once("head_menu.php");
include_once("conexao.php");

if ($_SESSION['Access'] == 1) {
  $condicao = "U.IDUR > 0";
} else if ($_SESSION['Access'] == 2) {
  $condicao = "U.IDCO = " . $_SESSION['userCon'];
}

$sql = mysqli_query($con, "SELECT U.IDUR, U.Name, U.Login, CASE
WHEN U.Access = 1 THEN 'Administrador'
WHEN U.Access = 2 THEN 'Sindico(a)/Gerente'
ELSE 'Porteiro'
END Access, U.Active, C.Nome Condominio
FROM USER U
INNER JOIN CONDOMINIO C ON U.IDCO = C.IDCO
WHERE " . $condicao) or die("Erro"); ?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-user"></i> Usuários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Usuário</th>
                      <th>Empreendimento</th>
                      <th>Tipo</th>
                      <th>Ativo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? while ($dados = mysqli_fetch_assoc($sql)) { ?>

                      <tr>
                        <td><?= $dados['IDUR'] ?></td>
                        <td><?= $dados['Name'] ?></td>
                        <td><?= $dados['Login'] ?></td>
                        <td><?= $dados['Condominio'] ?></td>
                        <td><?= $dados['Access'] ?></td>
                        <? if ($dados['Active']) { ?>
                          <td id="ativo<?= $dados['IDUR'] ?>"><button class="btn btn-success btn-icon-split btn-sm" onclick="mostraModal(<?= $dados['IDUR'] ?>,1)"><span class="text">Ativo</span></button></td>
                        <? } else { ?>
                          <td id="inativo<?= $dados['IDUR'] ?>"><button class="btn btn-danger btn-icon-split btn-sm" onclick="mostraModal(<?= $dados['IDUR'] ?>,2)"><span class="text">Inativo</span></button></td>
                        <? } ?>

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
        <? // include_once("footer_menu.php");
        ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <? include_once("footer_java.php"); ?>
    <script>
      function mostraModal(id, tipo) {
        var pagina = 'usuarioModalDados.php';
        var modal = 'modal';

        var dados = {
          id: id,
          tipo: tipo
        }
        $.post(pagina, dados, function(retorna) {
          $('#detalhes').html(retorna);
          $('#' + modal).modal('show');
        });
      }
    </script>

    <!-- Scroll to Top Button-->


</body>

</html>