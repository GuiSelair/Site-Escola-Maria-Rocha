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
        header("location: contato.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: contato.php");
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

        <div class="container my-5">

            <div class="row my-5">

                <div class="col-lg-6 my-5">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4121.790614439209!2d-53.81458902211607!3d-29.690810057559283!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6596cdcc1dbcb9c9!2sEscola+Estadual+de+Ensino+M%C3%A9dio+Professora+Maria+Rocha!5e0!3m2!1spt-BR!2sbr!4v1511223701151" width="100%" height="350" frameborder="0" style="border:0"></iframe>

                </div>  

                <div class="col-lg-6 mt-lg-5 text-center">

                    <h2 class="mt-sm-5">Maria Rocha</h2>
                    <address>

                        <strong class="fa fa-car"> R. Conde de Porto Alegre, 795 Santa Maria - RS</strong><p></p>
                        <p class="lead fa fa-phone"> (55)3222-8171</p><br>
                        <a class="fa fa-desktop" href="index.php"> Maria Rocha</a>

                    </address>


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