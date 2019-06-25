<?php

//////////////////////////////////////
////        PÁGINA PRINCIPAL      ////
//////////////////////////////////////

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

// LOGIN MODAL
if(isset($_POST['entrar'])) {
    $conn = DBConecta();

    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);

    $conect = DBQuery('mr_usuarios', " WHERE login = '$login' AND senha = '$cript' ");

    if ($conect) {
        $_SESSION['Logado'] = true;
        $_SESSION["user"] = $login;
        header("location: index.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

// DESLOGAR
if (isset($_GET['deslogar'])) {     
    session_destroy();
    header("location: index.php");
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta http-equiv="refresh" content="30">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="maria rocha, escola maria rocha, escola professora maria rocha, escola profª maria rocha, santa maria, RS">
    <meta name="description" content="Escola estadual de ensino médio e tecnico maria rocha">

    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>

    <!-- IMPORTAÇÃO DA BARRA DE NAVEGAÇÃO-->
    <?php include 'menu.php'; ?>

    <!--CARROSEL IMAGEM PRINCIPAL-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <?php 
                $pasta = "Galeria/";
                $sql = mysqli_query(DBConecta(),"SELECT nome FROM imagens WHERE categoria = 1;");
                $linha = mysqli_num_rows($sql);
                // EXIBIÇÃO DE IMAGEM PADRÃO CASO NÃO TENHA IMAGEM PRINCIPAL
                if ($linha == 0){
                    echo "<div class='carousel-item active'>
                        <img class='d-block w-100' src='Galeria/default.jpg' alt='Primeiro slide' />
                    </div>";
                }
                else{
                    $n = TRUE;
                    while ($row = mysqli_fetch_assoc($sql)){
                        $nome = $pasta.$row['nome'];
                        if ($n){
                            echo "
                            <div class='carousel-item active'>
                                <img class='d-block w-100' src='".$nome."'/>
                            </div>";
                            $n = FALSE;
                        }
                        else{
                            echo "
                            <div class='carousel-item'>
                            <img class='d-block w-100' src='".$nome."'/>
                            </div>";
                        }
                    }
                }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>

    <!--NOTICIAS-->
    <div class="jumbotron top-space mt-0 mb-3 pt-5" style="background-color: #f2f2f2;">
        <div class="container-fluid">
            <h4 class="text-center mt-0">ÚLTIMAS NOTICIAS</h4>
            <a href="allpost.php?pagina=0" class="btn btn-primary col-sm col-lg-2 col-md-4">TODAS NOTICIAS <i class="fa fa-search ml-2"></i></a>
            <hr style="border-color: #354698; ">

            <!--BUSCA DAS NOTICIAS-->
            <?php
                $cat = 1; //CATEGORIA A BUSCAR. LEIA O ARQUIVO CATEGORIAS.TXT PARA SABER MAIS
                $quantNotices = 8;
                $sql = mysqli_query(DBConecta(), "SELECT * FROM `mr_posts` WHERE `categoria` = $cat ORDER BY `id` DESC LIMIT $quantNotices;");
            ?>

            <div id="multi-item-example" class="carousel slide carousel-multi-item text-center" data-ride="carousel">
                <div class="controls-top">
                    <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                </div>

                <div class="carousel-inner" role="listbox">
                    <!--EXIBIÇÃO DAS NOTICIAS EM CARROSEL-->
                    <?php 
                        $quantCardPorLinha = $quantNotices/2;
                        echo "
                                <div class='carousel-item active'>
                                        <div class='row text-center mt-3 mb-3'>
                            ";
                        while ($quantNotices != $quantCardPorLinha ){
                            $i = 0;
                            while ($i != 1){
                                $dados = mysqli_fetch_assoc($sql);
                                $i = $i + 1;
                                echo "
                                            <div class='col-md-6 col-lg-3  mx-auto mt-3'>
                                                <div class='card mb-2 text-center'>
                                ";
                                $idNoticia = $dados["id"];
                                $buscaImage = mysqli_query(DBConecta(), "SELECT * FROM imagens WHERE idPosts = '$idNoticia';") or die("Erro");
                                $linha = mysqli_num_rows($buscaImage);

                                if ($linha != 0){
                                    $image = mysqli_fetch_assoc($buscaImage);
                                    if (strlen($dados['titulo']) > 25){
                                        $tit = substr($dados['titulo'], 0, 25).' ...';
                                    }
                                    else{
                                        $tit = $dados['titulo'];
                                    }
                                    echo "              <div style='max-height: 180px; overflow: hidden;'>
                                                            <img class='card-img-top img-fluid' src='Galeria/".$image['nome']."'  >
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title text-truncate' style='max-width: 300px;'>".$dados['titulo']."</h5>
                                                            <a href='noticias.php?id=".$dados['id']."' class='btn btn-primary mt-2'>Leia mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                    ";
                                }else{
                                    if (strlen($dados['titulo']) > 25){
                                        $tit = substr($dados['titulo'], 0, 25).' ...';
                                    }
                                    else{
                                        $tit = $dados['titulo'];
                                    }
                                echo "                  <div style='max-height: 180px; overflow: hidden;'>
                                                            <img class='card-img-top img-fluid' src='Galeria/08.png'>
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title text-truncate' style='max-width: 300px;'>".$dados['titulo']."</h5>
                                                            <a href='noticias.php?id=".$dados['id']."' class='btn btn-primary mt-2'>Leia mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                    ";
                                }
                            }
                            $quantNotices--;

                        }
                        echo "
                                    </div>
                                </div>
                                <div class='carousel-item'>
                                        <div class='row text-center text-md-left mt-3 mb-3'>
                            ";
                        while ($quantNotices > 0){
                            $i = 0;
                            while ($i != 1){
                                $dados = mysqli_fetch_assoc($sql);
                                $i = $i + 1;
                                echo "
                                            <div class='col-md-6 col-lg-3 mx-auto mt-3'>
                                                <div class='card mb-2 text-center'>
                                ";
                                $idNoticia = $dados["id"];
                                $buscaImage = mysqli_query(DBConecta(), "SELECT * FROM imagens WHERE idPosts = '$idNoticia';") or die("Erro");
                                $linha = mysqli_num_rows($buscaImage);

                                if ($linha != 0){
                                    $image = mysqli_fetch_assoc($buscaImage);
                                    if (strlen($dados['titulo']) > 25){
                                        $tit = substr($dados['titulo'], 0, 25).' ...';
                                    }
                                    else{
                                        $tit = $dados['titulo'];
                                    }
                                    echo "              <div style='max-height: 180px; overflow: hidden;'>
                                                            <img class='card-img-top img-fluid' src='Galeria/".$image['nome']."' >
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title text-truncate' style='max-width: 300px;'>".$dados['titulo']."</h5>
                                                            <a href='noticias.php?id=".$dados['id']."' class='btn btn-primary mt-2'>Leia mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <hr class='w-100 clearfix d-md-none'>
                                    ";
                                }else{
                                    if (strlen($dados['titulo']) > 25){
                                        $tit = substr($dados['titulo'], 0, 25).' ...';
                                    }
                                    else{
                                        $tit = $dados['titulo'];
                                    }
                                    echo "              <div style='max-height: 180px; overflow: hidden;'>
                                                            <img class='card-img-top img-fluid' src='Galeria/08.png'>
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title text-truncate' style='max-width: 300px;'>".$dados['titulo']."</h5>
                                                            <a href='noticias.php?id=".$dados['id']."' class='btn btn-primary mt-2 '>Leia mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <hr class='w-100 clearfix d-md-none'>
                                    ";
                                }
                            }
                            $quantNotices--;
                        }
                        echo "
                                </div>
                            </div>
                        </div>";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--BOTÕES-->
    <div class="container text-center mb-2">
        <div class="row text-center">
            <div class="col-sm col-md-6 col-lg-3 col-xl-3 mx-auto">
                <div class="btn-group-vertical btn-block btn-block-lg">
                    <a href="http://www.ufsm.br/" target="_blank" class="btn btn-primary  p-4 rounded" style="display: flex; justify-content: center;align-items: center;">
                        <h6 class="text-uppercase">UFSM</h6>
                    </a>
                </div>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-sm col-md-6 col-lg-3 col-xl-3 mx-auto">
                <div class="btn-group-vertical btn-block btn-block-lg">
                    <a href="https://enem.inep.gov.br/#/antes?_k=4k5apg" target="_blank" class="btn btn-primary  p-4 rounded" style="display: flex; justify-content: center;align-items: center;">
                        <h6 class="text-uppercase">ENEM</h6>
                    </a>
                </div>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-sm col-md-6 col-lg-3 col-xl-3 mx-auto">
                <div class="btn-group-vertical btn-block btn-block-lg">
                    <a href="http://www.blogdonatanael.com/" target="_blank" class="btn btn-primary p-4 rounded" style="display: flex; justify-content: center;align-items: center;">
                        <h6 class="text-uppercase">Professor do Natanael</h6>
                    </a>
                </div>
            </div>
            <hr class="w-100 clearfix d-md-none">
            <div class="col-sm col-md-6 col-lg-3 col-xl-3 mx-auto mb-3">
                <div class="btn-group-vertical btn-block btn-block-lg">
                    <a href="http://prouniportal.mec.gov.br/" target="_blank" class="btn btn-primary  p-4 rounded" style="display: flex; justify-content: center;align-items: center;">
                        <h6 class="text-uppercase">PROUNI</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--IMPORTAÇÃO DO RODAPÉ-->
    <?php include_once("footer.php"); ?>

    <!--TELA DE LOGIN MODAL-->
    <?php include_once("loginAdmin.php"); ?>

    <!-- LINKS PADRÃO BOOTSTRAP -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>