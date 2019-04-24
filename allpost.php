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
            $_SESSION['UsuarioLog'] = true;
            header("location: painel/painel.php");
        } else {
            echo "<script>alert('Usuário ou Senha inválida!')</script>";
        }
    }

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="maria rocha, escola maria rocha, escola professora maria rocha, escola profª maria rocha, santa maria, RS">
    <meta name="description" content="Escola estadual de ensino médio e tecnico maria rocha">

    <!-- Links Boostrap e CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="shortcut icon" href="img/favicon.ico" />
    <style>
     
    #nvcor {
        background-color: #354698;
    }
    </style>
  </head>
  <body>        
    
    <!--NAVBAR-->
    
    <?php include 'menu.php'; ?>
           
   <!-- POSTAGENS -->
   
    <div class="container">
     
        <div class="row">     
            
            <div class="col md-auto">            
                  <?php 
                    
                    $sql = mysqli_query(DBConecta(),"SELECT * FROM mr_posts ORDER BY id DESC") or die("Erro");
                    while ($dados=mysqli_fetch_assoc($sql)) {
                        //$rest = substr($dados['descricao'], 0, 155);
                        //echo $rest;
                        echo '<div class="titulo text-danger text-center mt-5"><strong>'.$dados ['titulo'].'</strong></div><p>';
                        echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                        echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'];
                    }

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