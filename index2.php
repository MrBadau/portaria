<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <? include_once 'head.php'; ?>
  <title>Login</title>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem Vindo!</h1>
                  </div>
                  <form action="login2.php" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" required class="form-control form-control-user" name="usuario" id="exampleInputEmail" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                      <input type="password" required class="form-control form-control-user" id="senha" name="senha" placeholder="Senha">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!--<label class="custom-control-label" for="customCheck">Remember Me</label>-->
                      </div>
                    </div>
                    <button class="btn btn-custom btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <div class="text-center">
                      <? if ($_SESSION['success']){ ?>
                        <span class="small" style="color: green;"><?=$_SESSION['messageError']?></span>
                        <? } else { ?>
                        <span class="small" style="color: red;"><?=$_SESSION['messageError']?></span>
                        <? } $_SESSION['messageError'] = ''; ?>
                    </div>
                    <div class="text-center">
                      <a class="small" href="register.php">Registre-se!</a>
                    </div>
                    <!--<a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>-->
                  </form>
                  <!--<div class="text-center">
                    <a class="small" href="forgot-password.html">Esqueceu a senha?</a>
                  </div>-->
                  <!--<div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <? include_once 'java.php'; ?>

</body>

</html>
