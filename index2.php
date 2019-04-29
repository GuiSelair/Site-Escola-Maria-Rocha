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
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="shortcut icon" href="img/favicon.ico" />
    </head>
    <body>

        <!--NAVBAR-->

       <?php include 'menu.php'; ?>
        
        <!-- PORTAL -->
        
        <div class="container-fluid text-center" style="height: 40px; background-color: #354698;">
            <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-primary"><i class="fa fa-mortar-board ml-2"></i> PORTAL DO ALUNO</button>
              <button type="button" class="btn btn-primary"><i class="fa fa-book ml-2"></i> EDITAIS</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-desktop ml-2"></i> CURSOS</button>
            </div>
        </div>
      
        <!-- IMAGEM DESTAQUE HEIGHT: 400px -->
        
        
        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="Galeria/05.jpg" alt="Primeiro slide"/>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>

        </div>
        
        <!--
        <div class="container-fluid text-center  mb-2" style="height: 50px; background-color: #354698; ">
            
            <button type="button" class="btn btn-primary mx-2 my-2" ><i class="fa fa-mortar-board fa-1x mr-2"></i> PORTAL DO ALUNO</button>
            <button type="button" class="btn btn-primary mx-2 my-auto"><i class="fa fa-book fa-1x mr-2"></i> EDITAIS</button>
            <button type="button" class="btn btn-primary mx-2 my-auto"><i class="fa fa-desktop fa-1x mr-2"></i> CURSOS</button>

            
        </div>
        -->
        <!-- NOTICIAS -->

        <div class="jumbotron top-space mt-1 mb-3 pt-5" style="background-color: #f2f2f2;">
            <div class="container-fluid">
                <h4 class="text-center mt-0">ÚLTIMAS NOTICIAS</h4>
                <a href="allpost.php" class="btn btn-primary text-right">TODAS NOTICIAS <i class="fa fa-search ml-2"></i></a>
                <hr style="border-color: #354698; ">
                
                <!-- Cabeçalho Noticia -->
                
				<?php
                    $cat = 1; // Categoria a ser filtrada
                    $sql = mysqli_query(DBConecta(), "SELECT * FROM `mr_posts` WHERE `categoria` = $cat ORDER BY `id` DESC LIMIT 6;") or die("Erro");
                ?>
                
                
                <div id="multi-item-example" class="carousel slide carousel-multi-item text-center" data-ride="carousel">
                    <!-- Setas -->
                    <div class="controls-top">
                      <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                      <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                    <!-- Indicadores -->
                    <ol class="carousel-indicators" >
                      <li data-target="#multi-item-example" data-slide-to="0" class="active" ></li>
                      <li data-target="#multi-item-example" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">

                      <div class="carousel-item active">

                        <div class="row text-center text-md-left mt-3 mb-3">
                            <!-- Linha 1 -->
                                                        
                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3" >

                                <div class="card mb-2 text-center">

                                    <img class="card-img-top"
                                    src="Galeria/04.png"
                                    alt="Card image cap">
                                    <div class="card-body">
                                      <?php
                                        $i = 0;
                                        while ($i != 1) {
                                                $dados=mysqli_fetch_assoc($sql);
                                                echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                                echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                                $nome = 'noticias/'.$dados['id'].'.php';
                                                echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                                $i = $i + 1;
                                        }
                                        $i = 0;
                                      ?>
                                    </div>
                                </div>

                            </div>

                            <hr class="w-100 clearfix d-md-none">

                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3">

                              <div class="card mb-2 text-center">

                                  <img class="card-img-top"
                                  src="Galeria/04.png"
                                  alt="Card image cap">
                                  <div class="card-body">
                                    <?php
                                      $i = 0;
                                      while ($i != 1) {
                                              $dados=mysqli_fetch_assoc($sql);
                                              echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                              echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                              $nome = 'noticias/'.$dados['id'].'.php';
                                              echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                              $i = $i + 1;
                                      }
                                      $i = 0;
                                    ?>
                                  </div>
                              </div>

                            </div>
                            <hr class="w-100 clearfix d-md-none">

                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3">

                              <div class="card mb-2 text-center">

                                  <img class="card-img-top"
                                  src="Galeria/04.png"
                                  alt="Card image cap">
                                  <div class="card-body">
                                    <?php
                                      $i = 0;
                                      while ($i != 1) {
                                              $dados=mysqli_fetch_assoc($sql);
                                              echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                              echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                              $nome = 'noticias/'.$dados['id'].'.php';
                                              echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                              $i = $i + 1;
                                      }
                                      $i = 0;
                                    ?>
                                  </div>

                              </div>

                            </div>

                        </div>

                      </div>

                      <div class="carousel-item">
                          
                        <div class="row text-center text-md-left mt-3 mb-3">
                            <!-- Linha 2 -->
                            
                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3" >

                              <div class="card mb-2 text-center">

                                  <img class="card-img-top"
                                  src="Galeria/04.png"
                                  alt="Card image cap">
                                  <div class="card-body">
                                    <?php
                                      $i = 0;
                                      while ($i != 1) {
                                              $dados=mysqli_fetch_assoc($sql);
                                              echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                              echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                              $nome = 'noticias/'.$dados['id'].'.php';
                                              echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                              $i = $i + 1;
                                      }
                                      $i = 0;
                                    ?>
                                  </div>
                              </div>

                            </div>

                            <hr class="w-100 clearfix d-md-none">

                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3">

                              <div class="card mb-2 text-center">

                                  <img class="card-img-top"
                                  src="Galeria/04.png"
                                  alt="Card image cap">
                                  <div class="card-body">
                                    <?php
                                      $i = 0;
                                      while ($i != 1) {
                                              $dados=mysqli_fetch_assoc($sql);
                                              echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                              echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                              $nome = 'noticias/'.$dados['id'].'.php';
                                              echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                              $i = $i + 1;
                                      }
                                      $i = 0;
                                    ?>
                                  </div>
                              </div>

                              </div>


                            <hr class="w-100 clearfix d-md-none">

                            <div class="col-md-3 col-lg-3 col-xl-4 mx-auto mt-3">

                              <div class="card mb-2 text-center">

                                  <img class="card-img-top"
                                  src="Galeria/04.png"
                                  alt="Card image cap">
                                  <div class="card-body">
                                    <?php
                                      $i = 0;
                                      while ($i != 1) {
                                              $dados=mysqli_fetch_assoc($sql);
                                              echo '<h5 class="card-title">'.$dados['titulo'].'</h5>';
                                              echo '<p class="card-footer">Postado por: '.$dados['postador'].' em '.$dados['data'].'</p>';
                                              $nome = 'noticias/'.$dados['id'].'.php';
                                              echo '<a href="'.$nome.'" class="btn btn-primary mt-2">Leia mais</a>';
                                              $i = $i + 1;
                                      }
                                      $i = 0;
                                    ?>
                                  </div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                </div>

            </div>

        <!-- BOTÕES -->
        <div class="container text-center  mb-2">

            <div class="row text-center mt-3 mb-3">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

                    <div class="btn-group-vertical btn-block btn-block-lg">
                        <a href="http://www.educacao.rs.gov.br/inicial" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Secretaria da Educação</h6></a>
                        <a href="https://secweb.procergs.com.br/rheportal/logon.xhtml" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Portal do Servidor</h6></a>
                    </div>
                </div>

                    <hr class="w-100 clearfix d-md-none">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

                        <div class="btn-group-vertical btn-block btn-block-lg">

                            <a href="http://portaldoprofessor.mec.gov.br/index.html" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Portal do Professor</h6></a>
                            <a href="http://www.ufsm.br/" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">UFSM</h6></a>

                        </div>
                </div>

                    <hr class="w-100 clearfix d-md-none">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 mb-3">
                    <div class="btn-group-vertical btn-block btn-block-lg">
                        <a href="http://portal.mec.gov.br/" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">MEC</h6></a>
                        <a href="http://prouniportal.mec.gov.br/" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Prouni</h6></a>
                    </div>
                </div>

                    <hr class="w-100 clearfix d-md-none">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

                        <div class="btn-group-vertical btn-block btn-block-lg">

                            <a href="https://enem.inep.gov.br/#/antes?_k=4k5apg" target="_blank" class="btn btn-primary mb-3 p-2" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Enem</h6></a>
                            <a href="http://www.dominiopublico.gov.br/pesquisa/PesquisaObraForm.jsp" target="_blank" class="btn btn-primary mb-3" style="height: 5rem; width: 15rem; display: flex; justify-content: center;align-items: center;"><h6 class="text-uppercase">Domínio Público</h6></a>

                        </div>
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
