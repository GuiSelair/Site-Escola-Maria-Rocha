<?php

//////////////////////////////////////
////           GALERIA            ////
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
        header("location: galeria.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

// DESLOGAR
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

    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/lb/lightbox.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="shortcut icon" href="img/favicon.ico" />

</head>
<body>
    <!--IMPORTANDO BARRA DE NAVEGAÇÃO-->
    <?php include 'menu.php'; ?>

    <!--EXIBIÇÃO DAS IMAGENS EM LIGHTBOX-->
    <div class="container">
        <div class="row ">
            <?php
                $pasta = "Galeria/";
                // LEIA O ARQUIVO CATEGORIAS.TXT PARA TER MAIS INFORMAÇÕES SOBRE AS CATEGORIAS
                $sql = mysqli_query(DBConecta(),"SELECT * FROM imagens WHERE categoria = 0;"); 
                while($row = mysqli_fetch_assoc($sql)){
                    $nome = $pasta.$row['nome'];
                    echo "<div class='col-lg-4 col-md-6 order-1 my-3'>
                        <picture>
                            <a data-lightbox='roadtrip' href='".$nome."'>
                                <img src='".$nome."' class='img-thumbnail'>
                            </a>
                        </picture>
                    </div>";
                }
            ?>
        </div>
    </div>

    <!--IMPORTAÇÃO DO RODAPÉ-->
    <?php include_once("footer.php"); ?>

    <!--TELA DE LOGIN MODAL-->
    <?php include_once("loginAdmin.php");?>

    <!-- LINKS PADRÃO BOOTSTRAP -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="node_modules/lb/lightbox.js"></script>
</body>
</html>