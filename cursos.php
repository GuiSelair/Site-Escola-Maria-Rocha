<?php

//////////////////////////////////////
////        PÁGINA DE CURSOS      ////
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
            header("location: cursos.php?curso=".$_GET['curso']);
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
    header("location: cursos.php?curso=1");
}

// FILTRA ATRAVES DO GET QUAL CURSO SERÁ EXIBIDO
$curso = $_GET['curso'];
switch ($curso) {
    case '0':
        $icon = "class= 'fa fa-bus mx-2'";
        $tec = "Médio";
        $sql_code = "SELECT * FROM cursomedio;";
        break;
    case '1':
        $icon = "class= 'fa fa-laptop mx-2'";
        $tec = "Informática";
        $sql_code = "SELECT * FROM cursoinformatica;";
        break;
    case '2':
        $icon = "class= 'fa fa-calculator mx-2'";
        $tec = "Contabilidade";
        $sql_code = "SELECT * FROM cursocontabilidade;";
        break;
    case '3':
        $icon = "class= 'fa fa-book mx-2'";
        $tec = "Secretariado";
        $sql_code = "SELECT * FROM cursosecretariado;";
        break;
    case '4':
        $icon = "class= 'fa fa-laptop mx-2'";
        $tec = "Informática Integrado";
        $sql_code = "SELECT * FROM cursointegrado;";
        break;
    default:
        header("location: index.php");
        break;
}

$sql = mysqli_query(DBConecta(), $sql_code);
$results = mysqli_fetch_assoc($sql);

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="maria rocha, escola maria rocha, escola professora maria rocha, escola profª maria rocha, santa maria, RS, cursos maria rocha, cursos tecnicos maria rocha, informatica maria rocha, secretariado maria rocha, contabilidade maria rocha">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>

    <!--IMPORTAÇÃO DA BARRA DE NAVEGAÇÃO-->
    <?php include 'menu.php'; ?>

    <!--LAYOUT PÁGINA DE CURSOS-->
    <!--NOME DO CURSO-->
    <div class="container text-center">
        <?php
            if ($tec != "Médio")
                echo "<h2 class='display-4 my-5'>Curso Técnico em ".$tec."</h2>";
            else
                echo "<h2 class='display-4 my-5'>Ensino ".$tec."</h2>";
        ?>
        <hr style="border-color: #354698;">
        <?php
            if (isset($results["horario"]))
                echo "<div class='row justify-content-end'><a class='btn btn-primary col-sm col-lg-2 col-md-4 my-2' href='./arquivo/".$results["horario"]."'>Grade de horários</a></div>";
        ?>
    </div>
    <!--DESCRIÇÃO DO CURSO-->
    <div class="container">
        <?php if ($tec != "Médio" && $tec != "Informática Integrado"){ ?>
        <?php if ($results['objetivoCurso'] != "<p><br></p>"){ ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Objetivos do Curso</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['objetivoCurso'];
                ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($results['criteriosAvaliacao'] != "<p><br></p>"){ ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Critérios de Avaliação</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['criteriosAvaliacao'];
                ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($results['estagio'] != "" ){ ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Estágio</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['estagio'];
                ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($results['perfilConclusao'] != "<p><br></p>"){ ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Perfil Profissional de Conclusão</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['perfilConclusao'];
                ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($results['gradeCurricular'] != "<p><br></p>"){ ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Grade Curricular</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['gradeCurricular'];
                ?>
            </div>
        </div>
        <?php }
          }
        else{
            if ($tec == "Informática Integrado"){
                if ($results['objetivocurso'] != "<p><br></p>"){
            ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Objetivo do Curso</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php

                    echo $results['objetivocurso'];
                ?>
            </div>
        </div>
                <?php }
                if ($results['perfilconclusao'] != "<p><br></p>"){
                ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Perfil de Formação Profissional</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['perfilconclusao'];
                ?>
            </div>
        </div>
        <?php }
            }else{
                if ($results['objetivocurso'] != "<p><br></p>"){
        ?>
        <div class="row">
            <div class="col-12 text-center mb-3" style="word-wrap: break-word;">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i <?php echo $icon; ?>></i>Objetivos</h5>
                <hr class="text-left" style="border-color: #b2b2b2;">
                <?php
                    echo $results['objetivocurso'];
                ?>
            </div>
        </div>
        <?php }}} ?>
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
