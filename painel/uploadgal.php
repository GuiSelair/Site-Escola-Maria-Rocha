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
                    $conn = DBConecta();
                    $cat = $_POST["cat"];
                    $up = mysqli_query($conn, "INSERT INTO imagens (categoria, nome) VALUES ('$cat', '$novoNome');");

                    echo "<div class='alert alert-success alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                    <strong>Upload efetuado com sucesso!</strong>
                    </div>
                    ";                   
                }
                else
                    echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                    <strong>Erro ao fazer Upload!</strong> 
                    </div>
                    ";
            }
            else
                echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                    <strong>Você só pode fazer upload de imagens</strong> 
                    </div>
                    ";
        }
        else
            echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
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
    <link rel="shortcut icon" href="../Img/favicon.ico" />

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="componentes/css/bootstrap.min.css" rel="stylesheet" />

    <link href="componentes/css/animate.min.css" rel="stylesheet" />

    <link href="componentes/css/painel.css" rel="stylesheet" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="componentes/css/icons.css" rel="stylesheet" />

</head>

<body>

    <?php include "menuLateral.php"; ?>

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

                                        <input class="form-check-input" type="file" name="arquivo" multiple="multiple"
                                            style="font-size: 15px;" />
                                        <br><br>
                                        <fieldset>
                                            <legend>Opções</legend>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cat" value="0" checked> Imagem Normal
                                            </div>
                                           
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cat" value="1"> Imagem Principal
                                            </div>
                                            <br>
                                            <br>
                                        </fieldset>
                                        <h6 class="my-5">OBS: A opção "Imagem Principal" só deve ser marcada para
                                            imagens que devam aparecer na tela principal. Não será exibida na aba
                                            Galeria
                                        </h6>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-block mt-5"
                                            name="postar" href="../painel/painel.php">Enviar
                                            Foto</button>
                                        <a href="../painel/painel.php" class="btn btn-block btn-dark">Voltar ao
                                            Painel de Controle</a>

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