<?php

//////////////////////////////////////
////      UPLOAD DE IMAGENS       ////
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

$diretorio = "../Galeria/";

// FAZ O UPLOAD DA IMAGEM 
if (isset($_POST['postar'])) {
    $foto = $_FILES['arquivo'];
    $dimensoes = getimagesize($foto['tmp_name']);
    // ALTURA MÁXIMA PERMITIDA PARA POSTAR IMAGENS NA PÁGINA PRINCIPAL
    $altura = 500;

    if (!is_dir($diretorio)){    
        echo "<div class='alert alert-danger alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                <strong>NÃO ENCONTRAMOS A PASTA GALERIA. POR FAVOR, CRIE.</strong>
            </div>";
    }
    else {
        if (isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
            $nome = $_FILES[ 'arquivo' ][ 'name' ];
            // PEGA A EXTEÇÃO DO ARQUIVO E VERIFICA A EXTENÇÃO É VALIDA
            $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
            $extensao = strtolower ( $extensao );
            if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao)) {
                $novoNome = uniqid ( time () ) . '.' . $extensao;
                $destino = '../Galeria/' . $novoNome;
                // VERIFIQUE O ARQUIVO CATEGORIAS.TXT PARA SABER MAIS
                $cat = $_POST["cat"];

                // VERIFICA SE A IMAGEM TEM MAIS QUE O TAMANHO MÁXIMO
                if ($cat == 1 && $dimensoes[1] > $altura){
                    echo "<div class='alert alert-danger alert-dismissable'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                            <strong>Imagem deve ter no máximo 500px de altura</strong>
                        </div>";
                }
                else{
                    if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                        $conn = DBConecta();
                        $up = mysqli_query($conn, "INSERT INTO imagens (categoria, nome) VALUES ('$cat', '$novoNome');");
                        echo "<div class='alert alert-success alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                                <strong>Upload efetuado com sucesso!</strong>
                            </div>";
                    }
                    else
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                                <strong>Erro ao fazer Upload! Verifique sua conexão ou tente mais tarde.</strong>
                            </div>";
                }
            }
            else
                echo "<div class='alert alert-danger alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                        <strong>Você só pode fazer upload de imagens</strong>
                    </div>";
        }
        else
            echo "<div class='alert alert-danger alert-dismissable'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                    <strong>Você não selecionou nenhuma imagem</strong>
                </div>";

    }
}

// BUSCA TODAS IMAGENS COM CATEGORIA 1
$sql = mysqli_query(DBConecta(),"SELECT * FROM imagens WHERE categoria = 1;");
$linha = mysqli_num_rows($sql);

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
    <div class="wrapper">
        <div class="sidebar" data-color="dark" data-image="../Galeria/04.png">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="../index.php" class="simple-text">
                        Maria Rocha
                    </a>
                </div>
                <!--PAINEL DE NAVEGAÇÃO LATERAL-->
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
                            <p>Todas Notícias</p>
                        </a>
                    </li>
                    <li>
                        <a href="../editor/publicar.php">
                            <i class="pe-7s-pen"></i>
                            <p>Publicar notícia</p>
                        </a>
                    </li>
                    <li>
                        <a href="../editor/editarCursos.php">
                            <i class="pe-7s-id"></i>
                            <p>Editar página cursos</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="uploadgal.php">
                            <i class="pe-7s-cloud-upload"></i>
                            <p>Postar Imagens</p>
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
        <!--MENU PARA APARELHOS MÓVEIS-->
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
                    <div class="collapse navbar-collapse"></div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text">Upload de Imagens</h4>
                                </div>
                                <div class="content">
                                    <div>
                                        <form action="" method="POST" enctype="multipart/form-data" id="postForm">
                                            <input class="form-check-input" type="file" name="arquivo"
                                                multiple="multiple" style="font-size: 15px;"/>
                                            <br><br>
                                            <fieldset>
                                                <legend>Opções</legend>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cat" value="0"
                                                        checked> Imagem Normal (Aparecerá na Galeria)
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cat" value="1">
                                                    Imagem Principal (Aparecerá na tela principal)
                                                </div>
                                                <br>
                                                <br>
                                            </fieldset>
                                            <h6 class="my-5">OBS: A opção "Imagem Principal" só deve ser marcada para
                                                imagens que devam aparecer na tela principal. Não será exibida na aba
                                                Galeria
                                            </h6>
                                            <br>
                                            <h6 class="my-5">OBS: A altura desta imagem deve ser no máximo 500px
                                            </h6>
                                            <br>
                                            <!--EXIBIÇÃO DE IMAGENS PRINCIPAIS POSTADAS-->
                                            <?php if ($linha != 0){ ?>
                                            <fieldset>
                                                <legend>Imagens Principais Ativas</legend>
                                                <div class="container">
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($sql)){
                                                        echo "
                                                            <div class='text-center my-5'>
                                                                <img src='".$diretorio.$row['nome']."' width='700'>
                                                                <div class='row my-3'>
                                                                    <br>
                                                                    <a class='btn btn-danger' href='deleteImagePrincipal.php?id=".$row['id']."'><i class='fa fa-angle-double-up'></i>Excluir</a>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        ";
                                                    }
                                                }
                                                ?>
                                                </div>
                                                <br>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary  mt-5" name="postar" href="../painel/painel.php">Enviar Imagem</button>
                                            <a href="../painel/painel.php" class="btn btn-dark">Voltar ao Painel de Controle</a>
                                        </form>
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