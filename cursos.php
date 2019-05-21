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
        header("location: cont.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: cont.php");
}

$curso = $_GET['curso'];

switch ($curso) {
    case '1':
        $icon = "class= 'fa fa-laptop mx-2'";
        $tec = "Informática";
        $sql_code = "SELECT * FROM cursoinformatica;";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $results = mysqli_fetch_assoc($sql);
        break;
    case '2':
        $icon = "class= 'fa fa-calculator mx-2'";
        $tec = "Contabilidade";
        $sql_code = "SELECT * FROM cursocontabilidade;";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $results = mysqli_fetch_assoc($sql);
        break;
    case '3':
        $icon = "class= 'fa fa-book mx-2'";
        $tec = "Secretariado";
        $sql_code = "SELECT * FROM cursosecretariado;";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $results = mysqli_fetch_assoc($sql);
        break;    
    default:
        break;
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
        <?php
            echo "<h2 class='display-4 my-5'>Curso Técnico em ".$tec."</h2>";
        ?>
        <hr style="border-color: #354698;">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Objetivos do Curso</h5>
                <hr class="text-left">
                <?php 
                    echo "<p>".$results['objetivoCurso']."</p>"
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Critérios de Avaliação</h5>
                <hr class="text-left">
                <?php 
                    echo "<p>".$results['criteriosAvaliacao']."</p>"
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Estágio</h5>
                <hr class="text-left">
                <?php 
                    echo "<p>".$results['estagio']."</p>"
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Perfil Profissional de Conclusão</h5>
                <hr class="text-left">
                <?php 
                    echo "<p>".$results['perfilConclusao']."</p>"
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Grade Curricular</h5>
                <hr class="text-left">
                <?php 
                    echo "<p>".$results['gradeCurricular']."</p>"
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
