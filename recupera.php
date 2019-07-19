<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <title>Recupera senha</title>
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
        <form class="form-signin" action="enviaEmail.php" method="POST">
            <img class="mb-4" src="./img/Login.png" alt="" width="120" height="150">
            <h3 class="h4 mb-3 font-weight-normal">Recuperação de Senha</h3>
            <input type="email" id="email" class="form-control rounded" placeholder="Email" name="email" required>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="envia" onclick="envia()"  id="envia">Enviar</button>
            <a href="./index.php" class="btn btn-lg btn-primary btn-block rounded" >Voltar</a>
        </form>
        <script type="text/javascript">
          function envia(){
            let email = document.querySelector("email").value;
            $.ajax({
              type: "POST",
              url: "enviaEmail.php",
              data: "email=".email,
              beforeSend: function(){
                $("#envia").html("Enviando...");
              }
              success: function (return){
                $("#status").html(return);
              }
            });

            }
          }
        </script>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js" crossorigin="anonymous"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js" crossorigin="anonymous"></script>
    </body>
</html>
