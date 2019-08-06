<?php

/////////////////////////////////////////
////  LAYOUT DA PÁGINA DE NOTICIAS   ////
/////////////////////////////////////////
session_cache_expire(10);
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

    if (isset($_POST["palavra"]) && $_POST["palavra"] == $_SESSION["palavra"]){
        $conect = DBQuery('mr_usuarios', " WHERE login = '$login' AND senha = '$cript' ");
        if ($conect) {
            $_SESSION['Logado'] = true;
            $_SESSION["donoDaSessao"] = md5("seg".$_SERVER["REMOTE_ADDR"].$_SERVER["HTTP_USER_AGENT"]);
            $_SESSION["user"] = $login;
            header("location: noticias.php?id=".$_GET['id']);
        } else {
            echo "<script>alert('Usuário ou Senha inválida!')</script>";
        }
    }else{
        echo "<script>alert('Erro de validação de Captcha!')</script>";
    }
}

// DESLOGAR
if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: index.php");
}

// BUSCA NOTICIA PELO ID DA NOTICIA
$id = $_GET['id'];
$sql_code = "SELECT * FROM mr_posts WHERE ID = $id;";
$sql = mysqli_query(DBConecta(), $sql_code);
$retornoNoticia = 0;
if ($sql){
    $retornoNoticia = mysqli_num_rows($sql);
    if ($retornoNoticia > 0){
        $results = mysqli_fetch_assoc($sql);
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <!-- IMPORTAÇÃO DA BARRA DE NAVEGAÇÃO-->
    <?php include 'menu.php'; ?>

    <!--LAYOUT PARA EXIBIÇÃO DA PÁGINA DE NOTICIAS-->
    <div class="container">
        <?php if ($retornoNoticia > 0){ ?>
        <!--TITULO DA NOTICIA E POSTADOR-->
        <div class="row text-center">
            <div class="col-12 mb-1">
                <?php
                    if ($retornoNoticia > 0){
                        echo "<h5 class='display-4 my-3'>".$results['titulo']."</h5>";
                        $data = substr($results['data'], 0, 10);
                        echo "<p class='text-left font-italic text-muted'>Postado por ".$results['postador']." em ".$data."</p>";
                        if (isset($results["arquivo"]))
                            echo "<a class='btn btn-primary col-sm col-lg-2 col-md-4 pull-right my-2' href='./arquivo/".$results["arquivo"]."'>Arquivo da notícia</a>";
                    }
                ?>
                <hr style="border-color: #354698;">
            </div>
        </div>
        <!--IMAGEM PRINCIPAL DA NOTICIA, SE TIVER-->
        <?php if (isset($results["thumbnail"])){ ?>
            <div class="row justify-content-center text-center">
                <div class="col-6 mb-3">
                    <?php
                        echo "<img src='./Galeria/".$results['thumbnail']."' class='img-fluid my-2' style='max-height: 400px'>";
                    ?>
                </div>
            </div>
        <?php } ?>
        <!--DESCRIÇÃO DA NOTICIA (CORPO DA NOTICIA)-->
        <div class="row">
            <div class="col-12 mb-3 text-justify" style="word-wrap: break-word;">
                <?php
                    if ($retornoNoticia > 0){
                        echo $results['descricao'];
                    }
                ?>
            </div>
        </div>
        <?php }else{?>
        <div class='alert alert-danger alert-dismissable my-5 text-center py-5'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
            <strong class="h3">Infelizmente não encontramos a notícia solicitada... Tente busca-la por aqui: <a href="http://www.mariarocha.org.br/allpost.php?pagina=0">Clique aqui!</a></strong>
        </div>
        <?php }?>
    </div>

    <!--IMPORTAÇÃO DO RODAPÉ-->
    <?php include_once("footer.php"); ?>

    <!--TELA DE LOGIN MODAL-->
    <?php include_once("loginAdmin.php"); ?>

    <!--LINKS PADRÃO BOOTSTRAP-->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
