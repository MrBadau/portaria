<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="pt-BR">

<? 
include_once("head_menu.php");
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

          <? include_once("header_menu.php");?>
        </nav>
        <!-- End of Topbar -->
        <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-custom"><i class="fa-arrow-alt-circle-up fas"></i> Formulário de Entrada</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form id="form" class="form" method="post">
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" name="documento" id="documento" placeholder="CPF">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa">
                        </div>
                        <div class="form-group col-sm-4">
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1">Visitou</option>
                                <option value="2">Buscou</option>
                                <option value="3">Entrou</option>
                                <option value="4">Serviço</option>
                                <option value="5">Encomenda</option>
                            </select>
                        </div>

                        <? 
                        if ($_SESSION['Access'] == 1) {
                          $condicao = "IDMO > 0";
                        } else if ($_SESSION['Access'] == 2 OR $_SESSION['Access'] == 3) {
                          $condicao = "IDCO = ".$_SESSION['userCon'];
                        }
                        $sql1 = mysqli_query($con,"SELECT IDMO, CONCAT(Nome, CASE WHEN Type = 1 THEN ' - Ap: ' ELSE ' - Sala: ' END,Apartamento) Nome FROM MORADORES WHERE ".$condicao." ORDER BY Type, Nome") or die("Erro"); 
                        //$sql2 = mysqli_query($con,"SELECT IDMO, CONCAT(Nome, CASE WHEN Type = 1 THEN ' - Ap: ' ELSE ' - Sala: ' END,Apartamento) Nome FROM MORADORES WHERE Type = 2 ".$condicao." ORDER BY Type, Nome") or die("Erro");
                        ?>
                        <div class="form-group col-sm-4">
                            <select name="morador" id="morador" class="form-control">
                                <optgroup label="<?=$menuTypePeople?>">
                                <? while($dados=mysqli_fetch_assoc($sql1)) {?>
                                  <option value="<?=$dados['IDMO']?>"><?=$dados['Nome']?></option>
                                <? } ?>
                                </optgroup>
                            </select>
                        </div>
                        
                    </div>

                    <div class="row">

                        <div class="form-group col-sm-3">
                            <input type="number" class="form-control" name="pessoas" id="pessoas" placeholder="Quantidade Pessoas">
                        </div>
                        
                        <div class="form-group col-sm-3">
                            <select onchange="removeForm()" name="entrou" id="entrou" class="form-control">
                                <option value="1">Veículo</option>
                                <option value="2">Apé</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text" class="form-control" name="veiculo" id="veiculo" placeholder="Descrição Veículo">
                        </div>
                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa">
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="hidden" name="usuario" id="usuario" value="<?=$_SESSION['userID']?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="hidden" name="condominio" id="condominio" value="<?=$_SESSION['userCon']?>">
                        </div>
                    </div>
                    
                    <div class="form-group"> 
                        <button class="btn btn-custom">Cadastrar</button>
                    </div>

                  </form>
              </div>
            </div>
          </div>
        </div>

        <? 
        if ($_SESSION['Access'] == 1) {
          $condicao = "AND IDEN > 0";
        } else if ($_SESSION['Access'] == 2 OR $_SESSION['Access'] == 3) {
          $condicao = "AND IDCO = ".$_SESSION['userCon'];
        }
        $sql = mysqli_query($con,"SELECT IDEN, DATE_FORMAT(DataEntrada, '%d/%m/%Y %H:%i:%s') DataEntrada, Name, Empresa FROM ENTRADAS WHERE DataSaida IS NULL ".$condicao." ORDER BY 1 DESC") or die("Erro");  ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">          

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-custom"><i class="far fa-clipboard"></i> Entradas Pendentes</h6>
            </div>
            <div class="card-body">
              <div id="regEntradas" class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Data e Hora</th>
                        <th>Saída</th>
                        
                      </tr>
                  </thead>
                  <tbody>
                    <? while($dados=mysqli_fetch_assoc($sql)) {?>
                        <tr id="tr<?=$dados['IDEN']?>" style="cursor: pointer;">
                          <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['IDEN']?></td>
                          <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['Name']?></td>
                          <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['Empresa']?></td>
                          <td onclick="mostraModal(<?=$dados['IDEN']?>,1)"><?=$dados['DataEntrada']?></td>
                          <!--<td><button onclick="mostraModal(<$dados['IDEN']?>,2)" class="btn btn-danger">R. Saída</button></td>-->
                          <td><button class="btn btn-danger btn-icon-split btn-sm" onclick="mostraModal(<?=$dados['IDEN']?>,2)"><span class="icon text-white-50"><i class="fa-window-close fas"></i></span><span class="text">R. Saída</span></button></td>
                          <!--<td><button onclick="submitForm('regSaida.php',<=$dados['IDEN']?>)" class="btn btn-danger">R. Saída</button></td>-->
                        </tr>
                      <? } ?>
                    </tbody>
                </table>
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
      <? //include_once("footer_menu.php");?>
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
                documento: {
                  required: true
                },
                tipo: {
                  required: true
                },
                placa: {
                  required: true
                }
                
            },
            submitHandler: function(form){
              //alert("Passou na validação")
              submitFormPost('regEntrada.php');
            }
            
        })
    })

    //mascara
    $("#documento").mask("000.000.000-00");

    //modal dados
    function visEntrada(id){
      //alert("chamou a função "+id);
      //const dados = await fetch('visMorador.php?id=' +id);
      var dados = {
        id: id
      }
      $.post('registrosModalDados.php', dados, function(retorna){
        $('#detalhes').html(retorna);
        $('#modalEntrada').modal('show');
      });
    }

    //modal excluir
    function mostraModal(id, tipo){
      var pagina = 'registrosModalDados.php';
      var modal = 'modal';

      var dados = {
        id: id,
        tipo: tipo
      }
      $.post(pagina, dados, function(retorna){
        $('#detalhes').html(retorna);
        $('#'+modal).modal('show');
      });
    }
    
    
</script>
</body>

</html>