<?php
//////////////////////////////////////
////        REDEFINE SENHA        ////
//////////////////////////////////////

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

$conexao = DBConecta();

// VERIFICA SE A HASH ESTÁ NO BD
if (!isset($_GET["hash"]) || !VerificaHash($conexao, $_GET["hash"])){
    header("location: ./galeria.php");
}

$hash = $_GET["hash"];
$email = $_GET["email"];
if (isset($_POST["redefine"]) && $_POST["senha"] != " "){
    $senha = mysqli_escape_string($conexao, $_POST['senha']);
    $senhaConfirma = mysqli_escape_string($conexao, $_POST['senhaConfirma']);
    if ($senha === $senhaConfirma){
        $cript = md5($senha);
        if(InsereNovaSenha($conexao, $cript, "mr_usuarios", $email)){
            echo "<div class='alert alert-success alert-dismissable status'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Senha alterada com sucesso!</strong>
            </div>";
            RemoveHashEEmail($conexao, $email);
            Redireciona("index.php");
        }else{
            echo "<div class='alert alert-warning alert-dismissable status'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao salvar senha. Tente mair tarde</strong>
            </div>";
            Redireciona("index.php");
        }
    }
}
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/favicon.ico" />
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <title>Redefine senha</title>
        <script src="./node_modules/jquery/dist/jquery.min.js"></script>

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
            .status {
                position: absolute;
                width: 100%;
                top:0px;
            }
        </style>

    </head>
    <body class="text-center">
        <div class="status"></div>
        <form class="form-signin" method="POST" action="">
            <img class="mb-4" src="./img/Login.png" alt="" width="120" height="150">
            <h3 class="h4 mb-3 font-weight-normal">Redefinição de Senha</h3>
            <input type="password" id="senha" class="form-control rounded" placeholder="Sua nova senha" name="senha" required id="senha">
            <input type="password" id="senhaConfirma" class="form-control rounded" placeholder="Repita sua senha" name="senhaConfirma" required id="senhaConfirma">
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="redefine" id="redefine">Redefinir</button>
            <a href="./index.php" class="btn btn-lg btn-primary btn-block rounded" >Voltar</a>
        </form>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#senhaConfirma").on("change", function(){
                    if ($("#senha").val() != "" && $("#senhaConfirma").val() != ""){
                        if($("#senha").val() != $("#senhaConfirma").val()){
                            $("#senha").css("border-color", "red");
                            $("#senhaConfirma").css("border-color", "red");
                        }else{
                            $("#senha").css("border-color", "green");
                            $("#senhaConfirma").css("border-color", "green");
                        }
                    }
                })
            })
        </script>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>
