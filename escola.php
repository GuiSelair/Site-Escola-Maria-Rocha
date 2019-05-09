<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if(isset($_POST['entrar'])) {
    $conn = DBConecta();

    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);

    $conect = DBQuery('mr_usuarios', " WHERE login = '$login' AND senha = '$cript' ");

    if ($conect) {
        $_SESSION['Logado'] = true;
        $_SESSION["user"] = $login;
        header("location: escola.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: escola.php");
}

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Links Boostrap e CSS -->
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css"/>
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css"/>
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css"/>
        <link rel="shortcut icon" href="img/favicon.ico" />
        <style>
            .display-4{
                font-size: 40pt;
            }
            .lead{
                font-size: 12pt;
            }
        </style>

    </head>
    <body>        

        <!--NAVBAR-->

        <?php include 'menu.php'; ?>

        <!--JUMBOTRON ESCOLA-->

        <div class="jumbotron">

            <div class="container">

                <div class="row">
                    <div class="col-4">
                        <img src="./img/profMariaRocha.jpg" alt="Professora Maria Rocha" class="rounded float-left img-fluid mx-5 w-75">
                    </div>

                    <div class="col-8 text-center">
                            <h1 class="display-4 ">Professora Maria Rocha</h1>
                            <hr style="border-color: #354698; ">
                            <p class="lead">Maria Manoela Rocha nasceu em 23 de dezembro de 1904. Em 1926, concluiu os estudos na Escola Complementar em Porto Alegre, tornando-se professora. Passou a lecionar no Colégio Elementar Farroupilha, atual Instituto de Educação Olavo Bilac. Foi professora dedicada por 32 anos. Vítima de câncer, faleceu em 1º de outubro de 1958.</p>
                        </div>

                </div>
                
            </div>

        </div>

        <div class="container my-2">
            
            <div class="row">

                <div class="col-12 text-center">

                    <h1 class="display-4">Nossa História</h1>
                    <hr style="border-color: #354698; ">
                    <p class="lead mb-4">A Escola Maria Rocha nasceu dentro do atual Instituto de Educação Olavo Bilac. Em 1941, foi criado o Curso Ginasial (1º Ciclo do Curso Secundário) na Escola Normal Olavo Bilac. Este curso foi desanexado desta Escola em 08 de fevereiro de 1957. Em 1958, o Ginásio passa a denominar-se Ginásio Estadual Caetano Pagliuca. Em 1962, com a criação de 2º Ciclo do Secundário (atual Ensino Médio), a Escola passa a denominar-se Colégio Estadual Caetano Pagliuca. Em 21 de janeiro de 1963, após intensa mobilização dos professores e funcionários, finalmente, recebe a denominação de Colégio Estadual Professora Maria Rocha - atualmente Escola de Ensino Médio PROF.ª Maria Rocha.</p>

                </div>

            </div>
        
        </div>
        
        <div class="container my-2">
            
            <div class="row">

                <div class="col-12 text-center">

                    <h1 class="display-4">Direção e Coordenação</h1>
                    <hr style="border-color: #354698; ">
                    

                </div>

            </div>
        
        </div>
        
        
        
        <div class="jumbotron">

            <div class="container-fluid mx-auto">

                <div class="row">

                    <div class="col-12 text-center">
                        <h1 class="text-center display-4">CURSOS</h1>
                    </div>

                </div>

                <div class="row mt-3 mx-auto">

                    <div class="col-lg-6 col-xl-3 mb-3">

                        <div class="card-body text-center">

                            <h2 class="card-title display-4 " style="font-size: 25pt;">Informática</h2>
                            <a href="infor.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </div>

                    </div>

                    <div class="col-lg-6 col-xl-3 mb-3">

                        <div class="card-body text-center">

                            <h2 class="card-title display-4 "style="font-size: 25pt;">Contabilidade</h2>
                            <a href="cont.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </div>

                    </div>

                    <div class="col-lg-6 col-xl-3 mb-3">

                        <div class="card-body text-center">

                            <h2 class="card-title display-4 "style="font-size: 25pt;">Secretariado</h2>
                            <a href="secret.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </div>

                    </div>

                    <div class="col-lg-6 col-xl-3 mb-3 ">

                        <div class="card-body text-center">

                            <h2 class="card-title display-4 "style="font-size: 25pt;">Técnico em Informática Subsequente</h2>
                            <a href="#" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--FOOTER-->
        <?php
            include_once("footer.php");
        ?>
        
        <!--TELA DE LOGIN -->
        <?php
            include_once("loginAdmin.php");
        ?>



        <!-- Links JS, Jquery e Popper -->
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </body>
</html>