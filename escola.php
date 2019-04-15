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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Links Boostrap e CSS -->
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="img/favicon.ico" />
        <style>

            #nvcor {
                background-color: #354698;
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

                    <div class="col-12 text-center">

                        <h1 class="display-4">Nossa Escola</h1>
                        <p></p>
                        <p class="lead">Nossa Escola possui Ensino Médio, Ensino Técnico Profissionalizante Subsequente e Ensino Técnico em Informática Concomitante ao Ensino Médio.</p>

                    </div>

                    <div class="col-12">

                        <p>Confira alguns números da nossa escola:<p>

                        <ul>
                            <li>Número de Alunos: 1110</li>
                            <li>Número de Professores: 103</li>
                            <li>Número de Funcionários: 14</li>
                        </ul>
                        <hr>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-12 text-center">

                    <h1 class="display-4">Nossa Equipe</h1>
                    <p></p>
                    <p class="lead">Atualmente a equipe diretiva da Escola Maria Rocha é composta por:</p>

                </div>

            </div>
        </div>

        <div class="container">

            <div class="row my-5">

                <div class="col-4">
                    <img src="img/Cleunice.jpg" class="img-responsive rounded-circle" width="70%">
                </div>

                <div class="col-8">
                    <h1 class="display-4">Cleunice Dornelles Fialho</h1>

                    <p class="lead my-5">Cleunice Dornelles Fialho, professora estadual desde 1983, Licenciada em História com especialização em Educação Profissional Integrada à Educação Básica na modalidade EJA e Mestrado em Educação Brasileira. Diretora.</p>
                </div>

            </div>

            <div class="row my-5">

                <div class="col-8">
                    <h1 class="display-4">Carmem Cassio Borges de Brum</h1>

                    <p class="lead my-5">Carmen Cassia Borges de Brum, professora estadual desde 2003. Licenciada em Letras Português e Literatura, com especialização em Português e Literatura. Vice-diretora do turno da Tarde.</p>        
                </div>

                <div class="col-4">
                    <img src="img/Carmen.jpg" class="img-responsive rounded-circle" width="90%">                
                </div>

            </div>

            <div class="row my-5">

                <div class="col-4">
                    <img src="img/darlene.jpg" class="img-responsive rounded-circle" width="70%">            
                </div>

                <div class="col-8">
                    <h1 class="display-4">Darlene Iolanda Santolima</h1>

                    <p class="lead my-5">Darlene Iolanda Santolima, professora estadual desde 1994. licenciada em História com especialização em Pensamento político brasileiro e em Educação Profissional Integrada à Educação Básica na modalidade EJA. Vice-diretora do turno da Noite.</p>

                </div>

            </div>

            <div class="row my-5">

                <div class="col-8">
                    <h1 class="display-4">Maria Helena Tanuri Pascotini</h1>

                    <p class="lead my-5">Maria Helena Tanuri Pascotini, professora estadual desde 1993. licenciada em Letras com especialização em Psicopedagogia. Vice-diretora do turno da Manhã.</p>

                </div>

                <div class="col-4">
                    <img src="img/mariahelena.jpg" class="img-responsive rounded-circle" width="70%">
                </div>

            </div>
        </div>

        <div class="jumbotron">

            <div class="container">

                <div class="row">

                    <div class="col-12 text-center">
                        <h1 class="text-center display-4">CURSOS</h1>
                    </div>

                </div>

                <div class="row mt-5 text-center">

                    <div class="col-xl-4 mb-3">

                        <card class="body">

                            <h4 class="card-title display-4">Informática</h4>
                            <a href="infor.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </card>

                    </div>

                    <div class="col-xl-4 mb-3">

                        <card class="body">

                            <h4 class="card-title display-4">Contabilidade</h4>
                            <a href="cont.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </card>

                    </div>

                    <div class="col-xl-4 mb-3">

                        <card class="body">

                            <h4 class="card-title display-4">Secretariado</h4>
                            <a href="secret.php" class="btn btn-outline-info mt-3">SAIBA MAIS!</a>

                        </card>

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