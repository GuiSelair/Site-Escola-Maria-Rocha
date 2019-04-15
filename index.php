<?php

// RERCUSO DO PHP PARA MANTER O USUARIO LOGADO

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
        header("location: index.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {     //Parametro isset verifica se a variavel existe, retorna true e false
    session_destroy();
    header("location: index.php");
}

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
        <meta http-equiv="refresh" content="30">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="maria rocha, escola maria rocha, escola professora maria rocha, escola profª maria rocha, santa maria, RS">
        <meta name="description" content="Escola estadual de ensino médio e tecnico maria rocha">

        <!-- Links Boostrap e CSS -->
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="img/favicon.ico" />
        <!--<link rel="stylesheet" href="main.css">-->
        <style>
            #nvcor {
                background-color: #354698;
            }
            
        </style>
    </head>
    <body>        

        <!--NAVBAR-->

       <?php include 'menu.php'; ?>

        <!-- IMAGEM DESTAQUE HEIGHT: 500px -->
        
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="overflow: hidden; height: 500px;">
            <div class="carousel-inner">
                <div class="carousel-item active" >
                    <img class="d-block w-100" src="Galeria/05.jpg" alt="First slide">
                </div>
                <div class="carousel-item" >
                    <img class="d-block w-100" src="Galeria/07.jpg" alt="First slide">
                </div>
            </div>
            <!-- SETAS PROXIMA IMAGEM -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próxima</span>
            </a>
            
        </div>

        <!-- CARDS -->
        
        <div class="container text-center">
            <div class="row ">
                <div class="col">
                    <div class="card-deck mt-3">
                        <div class="card text-center mx-0" style="width: 10rem; border: none;">
                            <img class="card-img-top w-25 mx-auto" src="img/portal-icon.png" alt="Portal Icon">
                            <div class="card-body mx-auto">
                                <h6 class="card-title mx-auto h6">PORTAL DO ALUNO</h6>
                                <a href="#" class="btn btn-primary">Acesse aqui</a>
                            </div>
                        </div>
                        <div class="card text-center mx-0" style="width: 10rem; border: none;">
                            <img class="card-img-top w-25 mx-auto" src="img/info-icon.png" alt="Portal Icon">
                            <div class="card-body mx-auto">
                                <h6 class="card-title mx-auto h6">PORTAL DO PROFESSOR</h6>
                                <a href="#" class="btn btn-primary">Acesse aqui</a>
                            </div>
                        </div>
                        <div class="card text-center mx-0" style="width: 10rem; border: none;">
                            <img class="card-img-top w-25 mx-auto" src="img/info-icon.png" alt="Portal Icon">
                            <div class="card-body mx-auto">
                                <h6 class="card-title mx-auto h6">EDITAIS</h6>
                                <a href="#" class="btn btn-primary">Acesse aqui</a>
                            </div>
                        </div>
                        <div class="card text-center mx-0" style="width: 10rem; border: none;">
                            <img class="card-img-top w-25 mx-auto " src="img/info-icon.png" alt="Portal Icon">
                            <div class="card-body">
                                <h6 class="card-title h6">CURSOS</h6>
                                <a href="#" class="btn btn-primary">Acesse aqui</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- NOTICIAS -->

        <div class="jumbotron top-space">
		<div class="container-fluid">
			
            <h3 class="text-center thin">ÚLTIMAS NOTICIAS</h3>
            <a href="#" class="btn btn-primary text-right">TODAS NOTICIAS</a>
            <!--
            <p class="text-center">
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Informática</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Contabilidade</button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Secretáriado</button>
            </p>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="row">     
                                <div class="col-12">            
                                    <?php 
                                        $sql = mysqli_query(DBConecta(),"SELECT * FROM `mr_posts` WHERE `categoria` = 0 ORDER BY `id` DESC LIMIT 3;") or die("Erro");
                                    while ($dados=mysqli_fetch_assoc($sql)) {
                                        if ($dados['categoria'] == 0){
                                            echo '<div class="titulo text-danger mt-2 text-center"><strong>'.$dados ['titulo'].'</strong></div>';
                                            //echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                                            //echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'<p>Categoria: '.$dados['categoria'].'</p></div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card card-body">
                            <div class="row">     
                                <div class="col-12">            
                                    <?php 
                                    $sql = mysqli_query(DBConecta(),"SELECT * FROM `mr_posts` WHERE `categoria` = 1 ORDER BY `id` DESC LIMIT 2;") or die("Erro");
                                    while ($dados=mysqli_fetch_assoc($sql)) {
                                        if ($dados['categoria'] == 1){
                                            echo '<div class="titulo text-danger mt-5 text-center"><strong>'.$dados ['titulo'].'</strong></div>';
                                            //echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                                            //echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'<p>Categoria: '.$dados['categoria'].'</p></div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            -->
            <?php
                $cat = 1; // Categoria a ser filtrada
                $sql = mysqli_query(DBConecta(), "SELECT * FROM `mr_posts` WHERE `categoria` = $cat ORDER BY `id` DESC LIMIT 2;") or die("Erro");
            ?>
            <div class="owl-carousel">
                <div class="row">     
                    <div class="col">            
                        <?php 
                        $i = 0;
                        while ($i != 1) {
                                $dados=mysqli_fetch_assoc($sql);
                                echo '<div class="titulo text-danger mt-5 text-center h4"><strong>'.$dados ['titulo'].'</strong></div>';
                                echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                                echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'<p>Categoria: '.$dados['categoria'].'</p></div>';
                                $i = $i + 1;
                        }
                        $i = 0;
                        ?>
                    </div>
                    <div class="col">            
                        <?php 
                        $i = 0;
                        while ($i != 1) {
                                $dados=mysqli_fetch_assoc($sql);
                                echo '<div class="titulo text-danger mt-5 text-center h4"><strong>'.$dados ['titulo'].'</strong></div>';
                                echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                                echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'<p>Categoria: '.$dados['categoria'].'</p></div>';
                                $i = $i + 1;
                        }
                        $i = 0;
                        ?>
                    </div>
                    
                </div>
		    </div>
		</div>
	</div>


        <!-- POSTAGENS 

        <div class="container">

            <div class="row">     

                <div class="col-12">            
                    <?php 

                    $sql = mysqli_query(DBConecta(),"SELECT * FROM mr_posts ORDER BY id DESC LIMIT 4") or die("Erro");
                    while ($dados=mysqli_fetch_assoc($sql)) {

                        echo '<div class="titulo text-danger mt-5 text-center"><strong>'.$dados ['titulo'].'</strong></div><p>';
                        echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                        echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'<p>Categoria: '.$dados['categoria'].'</p></div>';
                    }

                    ?>
                </div>

            </div>

            <div class="container mt-5">

                <div class="row">

                    <div class="col-12 text-right">

                        <a href="allpost.php" class="lead">Ver todas as notícias.</a>

                    </div>

                </div>

            </div>

        </div>
        -->
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