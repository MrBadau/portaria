<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registre-se!</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Registre-se!</h1>
              </div>
              <form id="form" name="form" action="register_db.php" method="post">
                <div class="form-group">
                  <input required type="text" class="form-control form-control-user" id="nameEmpresa" name="nameEmpresa" placeholder="Razão Social">
                </div>
                <div class="form-group">
                  <input required type="text" class="form-control form-control-user" id="documento" name="documento" placeholder="CNPJ">
                </div>
                <div class="form-group">
                  <select required class="form-control form-control-user" name="tipo" id="tipo">
                    <option value="">Selecione</option>
                    <option value="1">Condomínio</option>
                    <option value="2">Empresa</option>
                  </select>
                </div>
                <div class="form-group">
                  <input required type="text" class="form-control form-control-user" id="nomeUser" name="nomeUser" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                  <input required type="email" class="form-control form-control-user" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input required type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha">
                  </div>
                  <div class="col-sm-6">
                    <input required type="password" class="form-control form-control-user" id="confirmSenha" name="confirmSenha" placeholder="Confirmar senha">
                  </div>
                </div>
                
                <button class="btn btn-custom btn-user btn-block">
                  Cadastrar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <!-- End of Page Wrapper -->
  <? include_once("footer_java.php");?>
  <!-- Scroll to Top Button-->

  <script>
    $(document).ready(function(){
        $("#form").validate({
            rules:{
                nameEmpresa: {
                  required: true
                },
                documento: {
                  required: true
                },
                tipo: {
                  required: true
                },
                nomeUser: {
                  required: true
                },
                email: {
                    required: true,
                    email: true
                },
                senha: {
                  required: true
                },
                confirmSenha: {
                  equalTo: "#senha"
                }
                
            }

        })
    })

    //mascara
    $("#documento").mask("00.000.000/0000-00");
  </script>

</body>

</html>
