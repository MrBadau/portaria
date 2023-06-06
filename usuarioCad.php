<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="pt-BR">

<? include_once("head_menu.php");
include_once("conexao.php"); ?>

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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-user"></i> Cadastrar Usuário</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form name="form" id="form" enctype="multipart/form-data" action="usuario_db.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirmar Senha</label>
                        <input type="password" class="form-control" name="cosenha" id="cosenha" placeholder="Confirmar Senha">
                    </div>

                    <? 
                    if ($_SESSION['Access'] == 1) {
                      $condicao = " IDCO > 0";
                    } else if ($_SESSION['Access'] == 2) {
                      $condicao = " IDCO = ".$_SESSION['userCon'];
                    }
                    $sql = mysqli_query($con,"SELECT IDCO, Nome FROM CONDOMINIO WHERE ".$condicao." ORDER BY Nome") or die("Erro"); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Condomínio/Empresa</label>
                        <select name="condominio" id="condominio" class="form-control">
                          <option value=""></option>
                          <? while($dados=mysqli_fetch_assoc($sql)) {?>
                            <option value="<?=$dados['IDCO']?>"><?=$dados['Nome']?></option>
                          <? } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                          <option value="1">Administrador</option>
                          <option value="2">Síndico(a)/Gerente</option>
                          <option value="3">Porteiro</option>
                        </select>
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
                email: {
                    required: true,
                    email: true
                },
                nome: {
                  required: true
                },
                senha: {
                  required: true
                },
                cosenha: {
                  equalTo: "#senha"
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