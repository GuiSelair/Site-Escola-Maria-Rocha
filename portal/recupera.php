<?php
//////////////////////////////////////
////        RECUPERA SENHA        ////
//////////////////////////////////////
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <title>Recupera senha</title>
        <script src="../node_modules/jquery/dist/jquery.min.js"></script>

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
        <div class="container-fluid text-center form-signin">
            <div class="col-sm-12">
                <img class="mb-4" src="../img/Login.png" alt="" width="120" height="150">
                <h3 class="h4 mb-3 font-weight-normal">Recuperação de Senha</h3>
                <input type="email" id="email" class="form-control rounded" placeholder="Email" name="email" required>
                <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="envia" id="envia">Enviar</button>
                <a href="./loginUser.php" class="btn btn-lg btn-primary btn-block rounded" >Voltar</a>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#envia").on("click", function(){
                    let email = document.querySelector("#email").value;        
                    $.ajax({
                    type: "POST",
                    url: "./enviaEmail.php",
                    data: "email="+email+"&tipo=portal",
                    beforeSend: function(){
                        $("#envia").html("Enviando...");
                    },
                    success: function(html){                
                        $(".status").html(html);
                        $("#envia").html("Enviar");
                        document.querySelector("#email").value = "";
                    }
                    });
                })
            })
        </script>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>
