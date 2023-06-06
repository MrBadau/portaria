<? session_start(); 
if (!$_SESSION['userLogged']){
  header('Location: index.php');
}
include_once ("conexao.php");
include_once ("variable.php"); ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menuinicial.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo2.png" alt="" style="max-width: 3rem">
        </div>
        <div class="sidebar-brand-text"><?=$menuTitle?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->


      <!-- Nav Item - Pages Collapse Menu -->
      <!--<li class="nav-item">
        <a class="nav-link" href="usuario.php">
          <i class="fas fa-users"></i>
          <span>Usuários</span></a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="menuinicial.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Inicio</span></a>
      </li> 
      
      <? if ($_SESSION['Access'] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-building"></i>
            <span>Empreendimento</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="condominioCad.php">Cadastrar</a>
              <a class="collapse-item" href="condominioList.php">Listar</a>
            </div>
          </div>
        </li>
      <? } 
       if ($_SESSION['Access'] == 1 OR $_SESSION['Access'] == 2) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-user"></i>
          <span>Usuários</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" onclick="carregarEmDiv('usuarioCad.php')">Cadastrar</a> -->
            <a class="collapse-item" href="usuarioCad.php">Cadastrar</a>
            <a class="collapse-item" href="usuarioList.php">Listar</a>
          </div>
        </div>
      </li>
      <? } ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTree">
          <i class="fas fa-users"></i>
          <span><?=$menuTypePeople?></span>
        </a>
        <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="moradoresCad.php">Cadastrar</a>
            <a class="collapse-item" href="moradoresList.php">Listar</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
          <i class="fa-arrow-alt-circle-up fas"></i>
          <span>Entradas</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="registrosCad.php">Cadastrar</a>
            <a class="collapse-item" href="registrosList.php">Listar</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
          <i class="fas fa-bullhorn"></i>
          <span>Ocorrências</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="ocorrenciaCad.php">Cadastrar</a>
            <a class="collapse-item" href="ocorrenciaList.php">Listar</a>
          </div>
        </div>
      </li>
        


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <div>

      </div>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #fff;">SOS - Ligue</span>
      </li>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;"><i class="fas fa-phone-alt"></i> 190 - Policia Militar</span>
      </li>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;"><i class="fas fa-phone-alt"></i> 192 - SAMU</span>
      </li>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;"><i class="fas fa-phone-alt"></i> 193 - Bombeiro</span>
      </li>
      <br>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #fff;">Assistencia à Proteção</span>
      </li>
      <li class="nav-item">
        <span style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;"><i class="fas fa-phone-alt"></i> 4020-6724</span>
      </li>
      <br>
      <li class="nav-item">
        <a href="https://superportaria.com/materia/condicoes-de-uso-do-website" target="_blank" style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;">Política uso do Site</a>
      </li>
      <li class="nav-item">
        <a href="https://superportaria.com/materia/politica-de-privacidade" target="_blank" style="font-size: 0.8rem;    font-size: 0.7rem;font-weight: 800;padding: 1.5rem 1rem;text-transform: uppercase;letter-spacing: 0.05rem;color: #dbd9d9;">Política Privacidade</a>
      </li>
    </ul>