<?php
    session_start();

    include_once("conexao/config.php");
    include_once("conexao/conexao.php");
    
    if(isset($_POST['entrar'])) {
        $conn = DBConecta();

        $login = mysqli_escape_string($conn, $_POST['login']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);
        $cript = md5($senha);


        $sql_code = "SELECT * FROM `administrador` WHERE login = '$login' AND senha = '$cript';";
        $verifica = mysqli_query($conn, $sql_code);

        if (mysqli_num_rows($verifica)){
            $dados = mysqli_fetch_assoc($verifica);
            $_SESSION["logado"] = true;
            $_SESSION["user"] = $login;
            $_SESSION["tipo"] = "Administrador";
            $_SESSION["id"] = $dados['idAdministrador'];
            $_SESSION["nome"] = $dados['nome']." ".$dados['sobrenome'];
            header("location: ./index.php");
        }
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
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <title>Portal Acadêmico</title>
        <style>
            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: -webkit-box;
                display: flex;
                -ms-flex-align: center;
                -ms-flex-pack: center;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }

            .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
            }

            .form-signin .form-control:focus {
                z-index: 2;
            }

            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }

            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
            .status {
                position: absolute;
                width: 100%;
                top:0px;
            }
        </style>

    </head>
    <body class="text-center">
        <form class="form-signin" action="" method="POST">
            
            <img class="mb-4" src="../img/Login.png" alt="" width="120" height="150">
            <h3 class="h4 mb-3 font-weight-normal">Entrar no Portal Acadêmico</h3>
            <input type="text" id="inputEmail" class="form-control mb-2 rounded" placeholder="Login" name="login" required autofocus>
            <input type="password" id="inputPassword" class="form-control rounded" placeholder="Senha" name="senha" required>
            <div class="checkbox mb-3">
                <label>
                    <a href="./recupera.php">Esqueceu sua senha?</a>
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
