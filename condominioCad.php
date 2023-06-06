<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="pt-BR">

<? 
include_once("head_menu.php");
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
              <h6 class="m-0 font-weight-bold text-custom"><i class="fas fa-building"></i> Cadastrar Empreendimento</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form name="form" id="form" action="condominio_db.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">CNPJ</label>
                        <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="Número">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
                    </div>

                    <div class="form-check">
                          <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="1" checked="">
                          <label class="form-check-label" for="exampleRadios1">
                            Condominio
                          </label>
                    </div>
                    <div class="form-check form-group">
                        <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="2">
                        <label class="form-check-label" for="exampleRadios2">
                          Empresa
                        </label>
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
                nome: {
                    required: true
                },
                cnpj: {
                    required: true
                }
                
            }

        })
    })

    //mascara
    $("#cnpj").mask("00.000.000/0000-00");
</script>
</body>

</html>