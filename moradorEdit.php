<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} 
$id = preg_replace('/[^[:alnum:]_]/', '',$_GET['id']); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<?
include_once("head_menu.php");
include_once("conexao.php"); 

$sql = mysqli_query($con,"SELECT Nome, IDCO, Documento, Email, Telefone, Ramal, Bloco, Andar, Apartamento
FROM MORADORES WHERE IDMO = ".$id." LIMIT 1") or die("Erro");
$dados = mysqli_fetch_assoc($sql);?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-users"></i> Editar <?=$menuTypePeople?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form name="form" id="form" action="morador_db.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome Completo</label>
                        <input type="text" class="form-control" value="<?=$dados['Nome']?>" name="nome" id="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" value="<?=$id?>" name="id" id="id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Documento</label>
                        <input type="text" class="form-control" value="<?=$dados['Documento']?>" name="doc" id="doc" placeholder="Documento">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" class="form-control" value="<?=$dados['Email']?>" name="email" id="email" placeholder="E-mail">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefone</label>
                        <input type="text" class="form-control" value="<?=$dados['Telefone']?>" name="telefone" id="telefone" placeholder="Telefone">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ramal</label>
                        <input type="text" class="form-control" value="<?=$dados['Ramal']?>" name="ramal" id="ramal" placeholder="Ramal">
                    </div>

                    <? 
                    if ($_SESSION['Access'] == 1) {
                      $condicao = " IDCO > 0";
                    } else if ($_SESSION['Access'] == 2 OR $_SESSION['Access'] == 3) {
                      $condicao = " IDCO = ".$_SESSION['userCon'];
                    }
                    //echo "SELECT IDCO, Nome FROM CONDOMINIO WHERE ".$condicao." ORDER BY Nome";
                    $sql1 = mysqli_query($con,"SELECT IDCO, Nome FROM CONDOMINIO WHERE ".$condicao." ORDER BY Nome") or die("Erro"); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?=$menuTypeCompany?></label>
                        <select name="condominio" id="condominio" class="form-control">
                          <? while($dados1=mysqli_fetch_assoc($sql1)) {?>
                            <option value="<?=$dados1['IDCO']?>" <? if ($dados['IDCO'] == $dados1['IDCO']) echo "selected" ?>><?=$dados1['Nome']?></option>
                          <? } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Bloco</label>
                        <input type="text" class="form-control" value="<?=$dados['Bloco']?>" name="bloco" id="bloco" placeholder="Bloco">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Andar</label>
                        <input type="text" class="form-control" value="<?=$dados['Andar']?>" name="andar" id="andar" placeholder="Andar">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?=$typeLocation;?></label>
                        <input type="text" class="form-control" value="<?=$dados['Apartamento']?>" name="apartamento" id="apartamento" placeholder="<?=$typeLocation;?>">
                    </div>

                    <div class="form-group"> 
                        <button type="submit" class="btn btn-custom">Atualizar</button>
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
      <? include_once("footer_menu.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php");?>
  <!-- Scroll to Top Button-->
  
<script>
    $(document).ready(function(){
        $("#form").validate({
            rules:{
                nome: {
                    required: true
                },
                doc: {
                  required: true
                },
                condominio: {
                    required: true
                }
                
            }

        })
    })
</script>
</body>

</html>