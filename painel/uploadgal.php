<?php

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

session_start();

if (!isset($_SESSION['Logado'])) {
    header("Location: ../index.php");
    session_destroy();
}

$diretorio = "../Galeria/";

if (isset($_POST['postar'])) {
    $conn = DBConecta();
    
    
    if (!is_dir($diretorio)){    // VERFICA A EXISTENCIA DA PASTA
        echo "Pasta $diretorio nao existe";
    }
    else {
        if (isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) { 
            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
            $nome = $_FILES[ 'arquivo' ][ 'name' ];

            // Pega a extensão
            $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

            // Converte a extensão para minúsculo
            $extensao = strtolower ( $extensao );
            
            if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao)) {
                $novoNome = uniqid ( time () ) . '.' . $extensao;
                // Concatena a pasta com o nome
                $destino = '../Galeria/' . $novoNome;

                // tenta mover o arquivo para o destino
                if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                    echo "<div class='alert alert-success alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Upload efetuado com sucesso!</strong>
                    </div>
                    ";
                }
                else
                    echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Erro ao fazer Upload!</strong> 
                    </div>
                    ";
            }
            else
                echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Você só pode fazer upload de imagens</strong> 
                    </div>
                    ";
        }
        else
            echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Você não selecionou nenhuma imagem</strong> 
                    </div>
                    ";

    }

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

        <div class="wrapper">

            <div class="sidebar" data-color="dark" data-image="fundo.jpg">

                <div class="sidebar-wrapper">

                    <div class="logo">

                        <a href="../index.php" class="simple-text">
                            Maria Rocha
                        </a>

                    </div>

                    <ul class="nav">

                        <li>

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

                        <li class="active">

                            <a href="#">

                                <i class="pe-7s-cloud-upload"></i>
                                <p>Upload Galeria</p>

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

                                        <h4 class="title text">Upload para Galeria</h4>

                                    </div>

                                    <div class="content">

                                        <div>

                                            <form action="" method="POST" enctype="multipart/form-data" id="postForm">

                                                <input type="file" name="arquivo" multiple="multiple" /><br><br>
                                                <p></p>
                                                <button type="submit" class="btn btn-success btn-block" name="postar">Enviar Foto</button>
                                                <a href="../painel/painel.php" class="btn btn-block btn-warning">Voltar ao Painel de Controle</a>

                                            </form>

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
                                        <a href="publicar.php">
                                            Publicar
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
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
                                &copy; 2018 <a href="../index.php">Maria Rocha</a>
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
