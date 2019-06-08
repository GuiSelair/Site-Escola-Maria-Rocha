<?php
    session_start();

    include_once("conexao/config.php");
    include_once("conexao/conexao.php");
    include_once("conexao/function.php");

    if(isset($_POST['envia'])) {

        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql_code = "SELECT * FROM `administrador` WHERE `login` = '$login' AND `email` = '$email';";
        $verifica = mysqli_query(DBConecta(), $sql_code);

        if (mysqli_num_rows($verifica)){
            $dados = mysqli_fetch_assoc($verifica);
            $novaSenha = substr($dados["login"],0,2).substr($dados["email"],0,5);
            $cript = md5($novaSenha);
            $id = $dados['idAdministrador'];
            $sql_code = "UPDATE administrador SET senha='$cript' WHERE idAdministrador='$id';";
            $atualiza = mysqli_query(DBConecta(), $sql_code);
                if($atualiza)
                    echo "<div class='alert alert-success alert-dismissable'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Senha temporaria ativada</strong>
                    </div>
                    ";
                else{
                    echo "<script>alert('Erro ao ativar senha temporaria')</script>";
                }
            
        }
        else{/*
            $sql_code = "SELECT * FROM `professor` WHERE `login` = '$login' AND `email` = '$email';";
            $verifica = mysqli_query(DBConecta(), $sql_code);
            if (mysqli_num_rows($verifica)){
                $dados = mysqli_fetch_assoc($verifica);
                $novaSenha = substr($dados["login"],0,2).substr($dados["email"],0,5);
                $cript = md5($novaSenha);
                $id = $dados['idProfessor'];
                $sql_code = "UPDATE professor SET senha='$cript' WHERE idProfessor='$id';";
                $atualiza = mysqli_query(DBConecta(), $sql_code);
                    if($atualiza)
                        echo "<div class='alert alert-success alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Senha temporaria ativada</strong>
                        </div>
                        ";
                    else{
                        echo "<script>alert('Erro ao ativar senha temporaria')</script>";
                    }
                
            }
            else{*/
                $sql_code = "SELECT * FROM `aluno` WHERE `login` = '$login' AND `email` = '$email';";
                $verifica = mysqli_query(DBConecta(), $sql_code);
                if (mysqli_num_rows($verifica)){
                    $dados = mysqli_fetch_assoc($verifica);
                    $novaSenha = substr($dados["login"],0,2).substr($dados["dataNascimento"],0,4);
                    $cript = md5($novaSenha);
                    $id = $dados['idAluno'];
                    $sql_code = "UPDATE aluno SET senha='$cript' WHERE idAluno='$id';";
                    $atualiza = mysqli_query(DBConecta(), $sql_code);
                    if($atualiza)
                        echo "<div class='alert alert-success alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Senha temporaria ativada</strong>
                        </div>
                        ";
                    else{
                        echo "<script>alert('Erro ao ativar senha temporaria')</script>";
                    }
                    
                }
                else{
                    echo "<script>alert('Usuário não cadastrado!')</script>";
                }
            //}
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

            .form-signin .checkbox {
                font-weight: 400;
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
        </style>

    </head>
    <body class="text-center">
        <form class="form-signin" action="" method="POST">
            <img class="mb-4" src="../img/Login.png" alt="" width="120" height="150">
            <h3 class="h4 mb-3 font-weight-normal">Recuperação de Senha</h3>
            <input type="text" id="inputLogin" class="form-control mb-2 rounded" placeholder="Login" name="login" required autofocus>
            <input type="email" id="inputEmail" class="form-control rounded" placeholder="Email" name="email" required>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="envia">Enviar</button>
            <a href="./loginUser.php" class="btn btn-lg btn-primary btn-block rounded" >Voltar</a>
            <p class="mt-4 mb-2"><strong>SENHA TEMPORARIA:</strong> Quando ativa sua senha passa a ser os 2 primeiras letras de seu LOGIN e o ano que você nasceu (AAAA). </p>
            <p class="mt-1 mb-3 text-danger"><strong>Utilize sua senha temporaria somente em casos de perda de senhas. Altere para uma senha de confiança assim que possivel.</strong> 
        </form>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>
