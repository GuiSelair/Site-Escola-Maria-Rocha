 
 
 <!--NAVBAR-->
    <div class="navbar navbar-expand-lg navbar-dark" id="nvcor" style="height: 70px;"></div>
        <div class="navbar fixed-top navbar-expand-lg navbar-dark" id="nvcor" style="height: 70px; background-color: #354698;">

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

                        <li class="nav-item">
                            <a href="index.php" class="nav-link h7 text-white">Início</a>
                        </li>
                        &nbsp;
                        <li class="nav-item">
                            <a href="escola.php" class="nav-link h7 text-white">A Escola</a>
                        </li>
                        &nbsp;
                        <li class="nav-item">
                            <a href="galeria.php" class="nav-link h7 text-white">Galeria</a>
                        </li>                     
                        &nbsp;
                        <li class="nav-item dropdown">

                            <a href="#" class="nav-link dropdown-toggle h7 text-white" data-toggle="dropdown" id="navDrop">Cursos</a>

                            <div class="dropdown-menu">
                                <a href="infor.php" class="dropdown-item">Informática</a>
                                <a href="cont.php" class="dropdown-item">Contabilidade</a>
                                <a href="secret.php" class="dropdown-item">Secretariado</a>
                            </div>
                        </li>
                        &nbsp;
                        <li class="nav-item">
                            <a href="contato.php" class="nav-link h7 text-white">Contato</a>
                        </li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php

                        if (!isset($_SESSION['Logado'])) {

                        ?>

                        <a href="#" class="nav-link h7 text-white" data-toggle="modal" data-target="#loginModal"><b>Login</b></a>

                        <?php

                        } 
                        else{
                        
                        ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle h6 text-white" data-toggle="dropdown" id="navDrop"><?php echo "Bem-Vindo, <b><i>".$_SESSION["user"]."</i></b>!";  ?></a>
                            <div class="dropdown-menu">
                                <a href="painel/painel.php" class="dropdown-item">Painel de Controle <i class="fa fa-cogs" aria-hidden="true"></i></a>
                                <a href="?deslogar" class="dropdown-item">Deslogar <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>

                </div>

            </div>

        </div>