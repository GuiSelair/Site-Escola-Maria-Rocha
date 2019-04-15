<?php

require_once("conexao/conexao.php");
require_once("conexao/config.php");
require_once("conexao/function.php");

session_start();

if (isset($_SESSION{'Logado'})) {
    header("location: index.php");
}

if (isset($_POST['entrar'])) {
    $conn = DBConecta();

    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);

    $conect = DBQuery('sp_registrar', " WHERE login = '$login' AND senha = '$cript' ");

    if ($conect) {
        $_SESSION['Logado'] = true;
        $_SESSION["user"] = $_POST["login"];
        header("location: index.php");
    } else {
        echo "
        <div class='alert alert-danger alert-dismissable'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro!</strong> Usuário ou senha incorretos!
            </div>
            ";
    }

}

?>


<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="favicon.ico" rel="icon" type="image/x-icon" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <title>SOS My Pets</title>

        <style>

            .toplog {
                background-color: #f6f6f6;
                border-top: 1px solid gray;
            }


        </style>

    </head>
    <body>



        <div class="col-12">

            <h1 class="text-center display-3" id="topo"><b><i>Maria Rocha</i></b></h1>

        </div>


        <div class="container-fluid toplog">

            <div class="row text-center mx-auto">

                <div class="col-lg-3"></div>

                <div class="col-lg-6">


                    <h3 class="text-center mt-5">Área do Cliente</h3>

                    <div class="container mx-auto">

                        <form accept-charset="utf-8" action="" method="POST">

                            <div class="form-group">

                                <input type="text" class="form-control" name="login" id="login" placeholder="Login">

                            </div>
                            <div class="form-group">

                                <input type="password" class="form-control" name="senha" id="senha" placeholder="*******">

                            </div>

                            <button type="submit" name="entrar" id="entrar" class="btn btn-success btn-block btn-lg">Entrar</button>
                            
                            <a href="index.php" class="btn btn-warning btn-block btn-lg">Voltar ao Início</a>

                        </form>

                    </div>

                    <div class="col-lg-3"></div>

                </div>


            </div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-4"></div>
        </div>

        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>