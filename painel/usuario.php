<?php

include_once("../conexao/config.php");
include_once("../conexao/conexao.php");
include_once("../conexao/function.php");

session_start();

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

if(isset($_POST['criar'])) {
    $conn = DBConecta();

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $cript = md5($senha);
    $email = $_POST['email'];

    $criar = mysqli_query($conn, "INSERT INTO mr_usuarios (login, senha, email) VALUES ('$login', '$cript', '$email')");

}

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
        <link rel="shortcut icon" href="../Img/favicon.ico"/>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link href="componentes/css/bootstrap.min.css" rel="stylesheet" />

        <link href="componentes/css/animate.min.css" rel="stylesheet"/>

        <link href="componentes/css/painel.css" rel="stylesheet"/>

        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="componentes/css/icons.css" rel="stylesheet" />

    </head>
    <body>

    <div class="wrapper ">

<div class="sidebar" data-color="dark" data-image="../Galeria/04.png">

    <div class="sidebar-wrapper ">

        <div class="logo">

            <a href="../index.php" class="simple-text">
                Maria Rocha
            </a>

        </div>

        <ul class="nav ">

            <li>

                <a href="painel.php">

                    <i class="pe-7s-graph"></i>
                    <p>Painel de controle</p>

                </a>

            </li>

            <li >

                <a href="posts.php">

                    <i class="pe-7s-pin"></i>
                    <p>Posts</p>

                </a>

            </li>

            <li>

                <a href="../editor/publicar.php">

                    <i class="pe-7s-pen"></i>
                    <p>Publicar notícia</p>

                </a>

            </li>

            <li>

                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="pe-7s-id"></i>
                    <p>Editar página cursos</p>
                </a>
                <ul class="collapse list-unstyled text-center" id="homeSubmenu">
                    <li>
                        <a class="dropdown-item" href="../editor/editarCursos.php?edit=1">Informática</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../editor/editarCursos.php?edit=2">Contabilidade</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../editor/editarCursos.php?edit=3">Secretariado</a>
                    </li>
                </ul>

            </li>

            <li>

                <a href="uploadgal.php">

                    <i class="pe-7s-cloud-upload"></i>
                    <p>Upload de Imagens</p>

                </a>

            </li>

            <li class="active">

                <a href="usuario.php">

                    <i class="pe-7s-user"></i>
                    <p>Criar Usuário</p>

                </a>

            </li>

            <li>

                <a href="../index.php">

                    <i class="pe-7s-home"></i>
                    <p>Pagina Inicial</p>

                </a>

            </li>

        </ul>

    </div>

</div>


            <div class="main-panel">

                <nav class="navbar navbar-default navbar-fixed">

                    <div class="container-fluid">

                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegação">

                                <span class="sr-only">Mostrar navegação</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>

                            </button>

                            <a class="navbar-brand" href="#">Criar Usuário</a>

                        </div>

                        <div class="collapse navbar-collapse">

                        </div>

                    </div>

                </nav>


                <div class="content">

                    <div class="container-fluid">

                        <?php

                        if (isset($_POST['criar'])){
                            echo "
        <div class='alert alert-success alert-dismissable'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Usuário</strong> criado com sucesso!
            </div>
            ";
                        }

                        ?>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="header">

                                        <h4 class="title text">Criar Usuário</h4>

                                    </div>

                                    <div class="content">

                                        <form accept-charset="utf-8" action="" method="post">

                                            <p><input type="text" name="login" id="login" placeholder="Usuário" class="form-control" required></p>
                                            <p><input type="password" name="senha" id="senha" placeholder="Senha" class="form-control" required></p>
                                            <p><input type="email" name="email" id="email" placeholder="Email" class="form-control" required></p>

                                            <p><input name="criar" type="submit" value="Criar Usuário" class="btn btn-outline-primary"></p>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <footer class="footer">

                        <div class="container-fluid">

                            <nav class="pull-left">

                                <ul>
                                    <li>
                                        <a href="painel.php">
                                            Painel
                                        </a>
                                    </li>

                                    <li>
                                        <a href="posts.php">
                                            Posts
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            Publicar
                                        </a>
                                    </li>

                                    <li>
                                        <a href="uploadgal.php">
                                            Upload Galeria
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            Criar usuário
                                        </a>
                                    </li>

                                </ul>

                            </nav>
                            <p class="copyright pull-right">
                                &copy; 2019 <a href="../index.php">Maria Rocha</a>
                            </p>

                        </div>

                    </footer>

                </div>

            </div>

        </div>

    </body>


    <script src="componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="componentes/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="componentes/js/painel-admin.js"></script>


</html>
