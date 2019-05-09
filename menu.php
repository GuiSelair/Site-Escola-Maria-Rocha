<!--NAVBAR-->

<div class="container-fluid py-0 my-0 " style="height: 30px; background-color: #f2f2f2;">
    <div class="row align-items-center">
        <div class="col-sm-3 col-md-6 col-lg-6 col-xl-6 mx-right">
            <div class="text-center mb-0 pb-0">
                <a href="loginUser.php" target="_blank" class="btn btn-info py-0  my-0" ><i class="fa fa-graduation-cap mx-2"></i>Portal Acadêmico</a>
            </div>
        </div>

        <div class="col-sm-3 col-md-6 col-lg-6 col-xl-6 mx-left">
            <div class="text-center">
                <a href="#"><i class="fa fa-facebook mx-3" style="color: black;"></i></a>
                <?php
                    if (!isset($_SESSION['Logado'])) {
                ?>
                
                <a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user mx-3" style="color: black;"></i></a>

                <?php
                        } 
                        else{
                ?>
                
                <li class="btn-group dropright mb-1">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="navDrop" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user mx-3" style="color: black;"></i></a>
                    <div class="dropdown-menu">
                        <a href="painel/painel.php" class="dropdown-item">Painel de Controle <i class="fa fa-cogs" aria-hidden="true"></i></a>
                        <a href="?deslogar" class="dropdown-item">Deslogar <i class="fa fa-sign-out" aria-hidden="true"></i>
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
<div class="navbar navbar-expand-lg navbar-dark " id="nvcor" style="height: 70px; background-color: #354698; border-bottom: 2px solid #D32022;">

    <div class="container ml-8">

        <a href="index.php" class="navbar-brand text-light">
            <img src="img/log.png" class="d-inline-block align-right mx-2" width="40">
            Escola Maria Rocha
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite" style="background-color: #354698;">

            <ul class="nav navbar-nav ml-auto pull-right">

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

                    <a href="#" class="nav-link dropdown-toggle h7 text-white" data-toggle="dropdown" id="navDrop">Cursos</a>

                    <div class="dropdown-menu">
                        <a href="./infor.php" class="dropdown-item">Informática</a>
                        <a href="./cont.php" class="dropdown-item">Contabilidade</a>
                        <a href="./secret.php" class="dropdown-item">Secretariado</a>
                        <a href="#" class="dropdown-item">Informática Subsequente</a>
                    </div>
                </li>
                
                <li class="nav-item mx-2">
                    <a href="#" class="nav-link h7 text-white">Editais</a>
                </li>
            </ul>

        </div>

    </div>

</div>
