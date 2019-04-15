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
        header("location: galeria.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: galeria.php");
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
        <link rel="stylesheet" href="node_modules/lb/lightbox.css">
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

        <div class="container">

            <div class="row">

                <?php

                $pasta = "Galeria/"; 

                $arquivos = glob("$pasta{*.jpg,*.JPG,*.png, *.jpeg}", GLOB_BRACE);
                
                foreach($arquivos as $id => $img)
				{
                    echo "<div class='col-lg-3 order-1 mt-3'>

                        <picture>

                            <a data-lightbox='roadtrip' href='".$img."'>

                                <img src='".$img."' class='img-thumbnail'>

                            </a>

                        </picture>

                    </div>
                    ";
                }
                ?>
            </div>

            <div class="col order-2"></div>

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
    <script src="node_modules/lb/lightbox.js"></script>
</html>