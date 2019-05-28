<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if(isset($_POST['entrar'])) {
    $conn = DBConecta();
    // Faz login caso seja selecionado
    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);

    // Faz UPDATE no banco de dados
    $conect = DBQuery('mr_usuarios', " WHERE login = '$login' AND senha = '$cript' ");
    if ($conect) {
        $_SESSION['Logado'] = true;
        $_SESSION["user"] = $login;
        header("location: cont.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: cont.php");
}

$id = $_GET['id'];
//BUSCA NOTICIA
$sql_code = "SELECT * FROM mr_posts WHERE ID = $id;";
$sql = mysqli_query(DBConecta(), $sql_code);
$results = mysqli_fetch_assoc($sql);

//BUSCA IMAGEM
$sql_code = "SELECT * FROM imagens WHERE idPosts = $id;";
$sql = mysqli_query(DBConecta(), $sql_code);
$linhas = mysqli_num_rows($sql);
if ($linhas > 0){
  $imagem = mysqli_fetch_assoc($sql);
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
</head>

<body>

    <!--NAVBAR-->

    <?php include 'menu.php'; ?>


    <div class="container text-center">

        <div class="row">
            <div class="col-12 mb-1">
                <?php
                    echo "<h5 class='display-4 my-3'>".$results['titulo']."</h5>";
                    $data = substr($results['data'], 0, 10);
                    echo "<p class='text-left font-italic text-muted'>Postado por ".$results['postador']." em ".$data;
                ?>
                <hr style="border-color: #354698;">
            </div>
        </div>
        <?php if ($linhas > 0){ ?>
        <div class="row justify-content-center">
            <div class="col-6 mb-3">
                <?php
                    echo "<img src='./Galeria/".$imagem['nome']."' class='img-fluid my-2' style='max-height: 400px'>";
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-12 mb-3">
                <?php
                    echo "<p class='text-justify'>".$results['descricao']."</p>";
                ?>
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
