<?php

//////////////////////////////////////
////       PÁGINA HISTÓRIA        ////
//////////////////////////////////////

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
            header("location: escola.php");
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
    header("location: escola.php");
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css" />
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css" />
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
    <style>
        .display-4 {
            font-size: 40pt;
        }

        .lead {
            font-size: 12pt;
        }
    </style>
</head>

<body>

    <!-- IMPORTAÇÃO DA BARRA DE NAVEGAÇÃO-->
    <?php include 'menu.php'; ?>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-12 text-center">
                <h1 class="display-4">Em breve histórico atualizado...</h1>
                <hr style="border-color: #354698; ">
            </div>
        </div>
    </div>
    <!--LINKS PARA PÁGINAS DOS CURSOS-->
    <div class="jumbotron">
        <div class="container-fluid mx-auto">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center display-4">CURSOS</h1>
                </div>
            </div>
            <div class="row mt-3 mx-auto">
                <div class="col-lg-6 col-xl-6 mb-3">
                    <div class="card-body text-center">
                        <h2 class="card-title display-4 " style="font-size: 30pt;">Informática</h2>
                        <a href="cursos.php?curso=1" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mb-3">
                    <div class="card-body text-center">
                        <h2 class="card-title display-4 " style="font-size: 30pt;">Contabilidade</h2>
                        <a href="cursos.php?curso=2" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mb-3">
                    <div class="card-body text-center">
                        <h2 class="card-title display-4 " style="font-size: 30pt;">Secretariado</h2>
                        <a href="cursos.php?curso=3" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mb-3 ">
                    <div class="card-body text-center">
                        <h2 class="card-title display-4 " style="font-size: 30pt;">Informática Integrado</h2>
                        <a href="cursos.php?curso=4" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mb-3">
                    <div class="card-body text-center">
                        <h2 class="card-title display-4 " style="font-size: 30pt;">Ensino Médio</h2>
                        <a href="cursos.php?curso=0" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>
                    </div>
                </div>
            </div>
        </div>
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
