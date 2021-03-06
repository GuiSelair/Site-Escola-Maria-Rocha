<?php
//////////////////////////////////////
////      BARRA DE NAVEGAÇÃO      ////
//////////////////////////////////////
?>

<!--BARRA DE NAVEGAÇÃO SUPERIOR-->
<div class="container-fluid py-0" style="background-color: #f2f2f2;">
    <div class="row align-items-center">
        <div class="col-sm-10 col-md-6 col-lg-6 col-xl-6  ">
            <div class="text-center mb-0 pb-0">
                <a href="./portal/loginUser.php" target="_blank" class="btn btn-info p-1 my-0 rounded-0" ><i class="fa fa-graduation-cap mx-2"></i>Plataforma Online</a>
            </div>
        </div>
        <div class="col-sm-2 col-md-6 col-lg-6 col-xl-6 ">
            <div class="text-center">
                <!--LINK PARA O FACEBOOK DA ESCOLA-->
                <a href="https://www.facebook.com/MariaRochaEscola/" target="_blank"><i class="fa fa-facebook mx-3" style="color: black;"></i></a>
                <?php
                    if (!isset($_SESSION['Logado'])) {
                ?>
                <!--LINK PARA ACESSAR O PORTAL ADMINISTRATIVO DO SITE-->
                <a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user mx-3 " style="color: black;"></i></a>
                <?php
                        }
                        else{
                ?>
                <li class="btn-group dropright ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="navDrop" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user ml-2 mb-2 " style="color: black;"></i></a>
                    <div class="dropdown-menu mx-3">
                        <a href="painel/painel.php" class="dropdown-item">Painel de Controle <i class="fa fa-cogs" aria-hidden="true"></i></a>
                        <a href="?deslogar" class="dropdown-item">Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>

                <?php
                        }
                ?>

            </div>
        </div>
    </div>
</div>

<!--BARRA DE NAVEGAÇÃO PRINCIPAL-->
<div class="navbar navbar-expand-lg navbar-dark "  style="background-color: #354698; border-bottom: 2px solid #D32022;">
    <div class="container ml-8">
        <a href="index.php" class="navbar-brand text-light">
            <!--LOGO DA ESCOLA-->
            <img src="img/log.png" class="d-inline-block align-right mx-2" width="40">
            <img src="img/NomeEscola.png" alt="" class="d-inline-block align-right mx-2" width="230">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" aria-controls="navbarSite" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSite" style="background-color: #354698;">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item mx-2">
                    <a href="index.php" class="nav-link h7 text-white">Início</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="escola.php" class="nav-link h7 text-white">História</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="galeria.php" class="nav-link h7 text-white">Galeria</a>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a href="#" class="nav-link dropdown-toggle h7 text-white" data-toggle="dropdown" id="navDrop">Ensino</a>
                    <ul class="dropdown-menu">
                        <li><a href="./cursos.php?curso=0" class="dropdown-item">Ensino Médio</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="./cursos.php?curso=1" class="dropdown-item">Técnico em Informática</a></li>
                        <li><a href="./cursos.php?curso=2" class="dropdown-item">Técnico em Contabilidade</a></li>
                        <li><a href="./cursos.php?curso=3" class="dropdown-item">Técnico em Secretariado</a></li>
                        <li><a href="./cursos.php?curso=4" class="dropdown-item">Técnico em Informática Integrado</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="painel/ModeloTCCTecnicos.docx" class="dropdown-item">Modelo TCC - Cursos Técnicos</a></li>
                    </ul>
                </li>
                <li class="nav-item mx-2">
                    <a href="editais.php?pagina=0" class="nav-link h7 text-white">Editais</a>
                </li>
            </ul>
        </div>
    </div>
</div>
