<?php

//////////////////////////////////////
////    PAINEL ADMINISTRATIVO     ////
//////////////////////////////////////

session_start();

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

// VERIFICA SE O USUÁRIO ESTÁ LOGADO
if (!isset($_SESSION['Logado'])) {
    header("Location: ../index.php");
    session_destroy();
}

// BUSCA PELAS 5 ULTIMAS NOTICIAS
$consulta = "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 5";
$results = mysqli_query(DBConecta(),$consulta);

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
            <div class="sidebar-wrapper ">
                <div class="logo">
                    <a href="../index.php" class="simple-text">
                        Escola Maria Rocha
                    </a>
                </div>
                <!--PAINEL DE NAVEGAÇÃO LATERAL-->
                <ul class="nav">
                    <li class="active">
                        <a href="painel.php">
                            <i class="pe-7s-graph"></i>
                            <p class="text-capitalize">Painel de controle</p>
                        </a>
                    </li>
                    <li>
                        <a href="posts.php">
                            <i class="pe-7s-pin"></i>
                            <p class="text-capitalize">Todas Notícias</p>
                        </a>
                    </li>
                    <li>
                        <a href="../editor/publicar.php">
                            <i class="pe-7s-pen"></i>
                            <p class="text-capitalize">Publicar notícia</p>
                        </a>
                    </li>
                    <li>
                        <a href="../editor/editarCursos.php">
                            <i class="pe-7s-id"></i>
                            <p class="text-capitalize">Editar página cursos</p>
                        </a>
                    </li>
                    <li>
                        <a href="uploadgal.php">
                            <i class="pe-7s-cloud-upload"></i>
                            <p class="text-capitalize">Postar Imagens</p>
                        </a>
                    </li>
                    <li>
                        <a href="usuario.php">
                            <i class="pe-7s-user"></i>
                            <p class="text-capitalize">Criar Usuário</p>
                        </a>
                    </li>
                    <li>
                        <a href="../index.php">
                            <i class="pe-7s-home"></i>
                            <p class="text-capitalize">Pagina Inicial</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                <!--MENU PARA APARELHOS MÓVEIS-->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegação">
                            <span class="sr-only">Mostrar navegação</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand text-uppercase">Painel administrativo do site</a>
                    </div>
                    <div class="collapse navbar-collapse">
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text">Notícias recentes</h4>
                                </div>
                                <div class="content">
                                    <div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col-3">Título</th>
                                                    <th scope="col-3">Data</th>
                                                    <th scope="col-3">Postador</th>
                                                    <th scope="col-3">Ações</th>
                                                </tr>
                                            </thead>
                                            <?php while($row = mysqli_fetch_assoc($results)){ ?>
                                            <tr>
                                                <td><?php if (strlen($row['titulo']) > 60){
                                                    $tit = substr($row['titulo'], 0, 60).' ...';
                                                    echo $tit;
                                                    }
                                                    else{
                                                        echo $row['titulo'];
                                                    } ?>
                                                </td>
                                                <td><?php echo $row['data']; ?></td>
                                                <td><?php echo $row['postador']; ?></td>
                                                <td><?php echo "<a class='btn btn-primary btn-sm my-2' href='../editor/editar.php?edit=".$row['id']."'><i class='fa fa-edit'></i>Editar</a>" ?>
                                                    <?php echo "<a class='btn btn-danger btn-sm ' href='deletar.php?id=".$row['id']."'><i class='fa fa-trash'></i>Excluir</a>" ?>
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

                <!--IMPORTAÇÃO DO RODAPÉ-->
                <?php include_once("footer.php"); ?>

            </div>
        </div>
    </div>


<script src="componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="componentes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="componentes/js/painel-admin.js"></script>

</body>
</html>