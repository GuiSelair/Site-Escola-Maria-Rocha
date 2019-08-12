<?php

//////////////////////////////////////
////            LOGIN             ////
//////////////////////////////////////

session_start();
include_once("conexao/config.php");
include_once("conexao/conexao.php");

// TESTES DE TIPOS DE USUÁRIOS
if(isset($_POST['entrar'])) {
    $conn = DBConecta();
    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);
    $sql_code = "SELECT * FROM `administrador` WHERE login = '$login' AND senha = '$cript';";
    $verifica = mysqli_query($conn, $sql_code);
    // TESTE DE ADMINISTRADOR
    if (mysqli_num_rows($verifica)){
        $dados = mysqli_fetch_assoc($verifica);
        $_SESSION["logado"] = true;
        $_SESSION["user"] = $login;
        $_SESSION["tipo"] = "Administrador";
        $_SESSION["id"] = $dados['idAdministrador'];
        $_SESSION["nome"] = $dados['nome']." ".$dados['sobrenome'];
        header("location: ./index.php");
    }
    // TESTE DE PROFESSOR
    else{
        $sql_code = "SELECT * FROM `professor` WHERE login = '$login' AND senha = '$cript' ";
        $verifica = mysqli_query($conn, $sql_code);
        if (mysqli_num_rows($verifica)){
            $dados = mysqli_fetch_assoc($verifica);
            $_SESSION["logado"] = true;
            $_SESSION["user"] = $login;
            $_SESSION["tipo"] = "Professor";
            $_SESSION["id"] = $dados['idProfessor'];
            $_SESSION["nome"] = $dados['nome']." ".$dados['sobrenome'];
            header("location: ./index.php");
        }
        // TESTE DE ALUNOS
        else{
            $sql_code = "SELECT * FROM `aluno` WHERE `login` = '$login' AND `senha` = '$cript';";
            $verifica = mysqli_query($conn, $sql_code);
            if (mysqli_num_rows($verifica)){
                $dados = mysqli_fetch_assoc($verifica);
                $_SESSION["logado"] = true;
                $_SESSION["user"] = $login;
                $_SESSION["tipo"] = "Aluno";
                $_SESSION["id"] = $dados['idAluno'];
                $_SESSION["nome"] = $dados['nome']." ".$dados['sobrenome'];
                header("location: ./index.php");
            }
            // DADOS INCORRETOS
            else{
                echo "<div class='alert alert-danger alert-dismissable status'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Usuário ou Senha inválida!</strong>
                </div>";
            }
        }
    }
}

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <title>PORTAL ACADÊMICO - &nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
        <link rel="stylesheet" href="./dist/css/Login-Recuperation.css">
        <link rel="shortcut icon" href="../img/favicon.ico" />

    </head>
    <body class="text-center">
        <form class="form-signin" action="" method="POST">
            <img class="mb-4" src="../img/Login.png" alt="" width="120" height="150">
            <h3 class="h4 mb-3 font-weight-normal">Entrar no Portal Acadêmico</h3>
            <input type="text" id="inputEmail" class="form-control mb-2 rounded" placeholder="Login" name="login" required autofocus>
            <input type="password" id="inputPassword" class="form-control rounded" placeholder="Senha" name="senha" required>
            <div class="checkbox mb-3">
                <label>
                    <a href="../recupera.php">Esqueceu sua senha?</a>
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="entrar">Entrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
        </form>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>
