<?php

session_start();

if (!isset($_SESSION['Logado'])) {
    header("Location: ../index.php");
    session_destroy();
}

/*LER REGISTROS*/ 

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");
$consulta = "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 5";
$con = mysqli_query(DBConecta(),$consulta);

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="componentes/css/bootstrap.min.css" rel="stylesheet" />

    <link href="componentes/css/animate.min.css" rel="stylesheet" />

    <link href="componentes/css/painel.css" rel="stylesheet" />

    <link rel="stylesheet" href="../node_modules/bootstrap/compiler/style.css">

    <link rel="shortcut icon" href="../img/favicon.ico" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="componentes/css/icons.css" rel="stylesheet" />

</head>

<body>

    <div class="wrapper">

        <div class="sidebar" data-color="dark" data-image="../Galeria/04.png">

            <div class="sidebar-wrapper">

                <div class="logo">

                    <a href="../index.php" class="simple-text">
                        Maria Rocha
                    </a>

                </div>

                <ul class="nav">

                    <li class="active">

                        <a href="painel.php">

                            <i class="pe-7s-graph"></i>
                            <p>Painel de controle</p>

                        </a>

                    </li>

                    <li>

                        <a href="posts.php">

                            <i class="pe-7s-pin"></i>
                            <p>Posts</p>

                        </a>

                    </li>

                    <li>

                        <a href="../editor/publicar.php">

                            <i class="pe-7s-pen"></i>
                            <p>Publicar</p>

                        </a>

                    </li>

                    <li>

                        <a href="uploadgal.php">

                            <i class="pe-7s-cloud-upload"></i>
                            <p>Upload de Imagens</p>

                        </a>

                    </li>

                    <li>

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

                        <a class="navbar-brand" href="#">Painel de Controle</a>

                    </div>

                    <div class="collapse navbar-collapse">

                    </div>

                </div>

            </nav>


            <div class="content">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="card">

                                <div class="header">

                                    <h4 class="title text">Posts recentes</h4>

                                </div>

                                <div class="content">

                                    <div>

                                        <table class="table">

                                            <thead>
                                                <tr>

                                                    <th scope="col">Título</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Postador</th>
                                                    <th scope="col">Ações</th>

                                                </tr>
                                            </thead>
                                            <?php while($row = $con -> fetch_array()){ ?>
                                            <tr>
                                                <td><?php 
                                            if (strlen($row['titulo']) > 60){
                                                $tit = substr($row['titulo'], 0, 60).' ...';
                                                echo $tit;
                                            }
                                            else{
                                                echo $row['titulo'];
                                            }
                                             ?></td>
                                                <td><?php echo $row['data']; ?></td>
                                                <td><?php echo $row['postador']; ?></td>
                                                <td><?php echo "<a class='btn btn-warning' href='../editor/editar.php?edit=".$row['id']."'>Editar</a>" ?>
                                                    <?php echo "<a class='btn btn-danger' href='deletar.php?id=".$row['id']."'>Excluir</a>" ?>
                                                <td>

                                            </tr>
                                            <?php } ?>

                                        </table>

                                    </div>

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
                                    <a href="#">
                                        Painel
                                    </a>
                                </li>

                                <li>
                                    <a href="posts.php">
                                        Posts
                                    </a>
                                </li>

                                <li>
                                    <a href="publicar.php">
                                        Publicar
                                    </a>
                                </li>

                                <li>
                                    <a href="uploadgal.php">
                                        Upload Galeria
                                    </a>
                                </li>

                                <li>
                                    <a href="usuario.php">
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