<?php

    session_start();

    include_once("conexao/config.php");
    include_once("conexao/conexao.php");
    include_once("conexao/function.php");

    $noticesbyPages = 6;
    $pagina = intval($_GET['pagina']);
    $beginningPage = $pagina;
    
    if ($pagina != 0)
        $beginningPage = $pagina * $noticesbyPages;

    $sql = mysqli_query(DBConecta(),"SELECT * FROM mr_posts WHERE categoria = 0 ORDER BY id DESC  LIMIT $beginningPage, $noticesbyPages");
    $num = mysqli_num_rows($sql);
    
    $sql1 = mysqli_query(DBConecta(), "SELECT * FROM mr_posts WHERE categoria = 0");
    $num_total = mysqli_num_rows($sql1);

    $num_pages = ceil($num_total/$noticesbyPages);
    
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
  </head>
  <body>        
    
    <!--NAVBAR-->
    
    <?php include 'menu.php'; ?>
           
   <!-- POSTAGENS -->
   
    <div class="container">
     
        <div class="row">     
            
            <div class="col md-auto">            
                  <?php 
    
                    while ($dados=mysqli_fetch_assoc($sql)) {
                        echo '<div class="titulo text-danger text-center mt-5"><strong>'.$dados ['titulo'].'</strong></div><p>';
                        echo '<div class="descricao text-center">'.$dados['descricao'].'</div></p>';
                        echo '<div><b><span class="fa fa-user"></span> Postado por</b> <i>'.$dados ['postador'].'</i><i> em</i> '.$dados['data'].'</div>';
                    }

                  ?>
            </div>

            <!-- Paginação -->

            <div class="container my-4 mx-4">
                <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation example" >
                                <ul class="pagination pagination-sm justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="editais.php?pagina=0" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php 
                                    for($i = 0; $i < $num_pages; $i++){
                                        $estilo = "class='page-item'";
                                        if($pagina == $i)
                                            $estilo = "class='page-item active'";
                                    ?>
                                    <li <?php echo $estilo; ?> ><a class="page-link" href="editais.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                                    <?php } ?>
                                    <li class="page-item">
                                        <a class="page-link" href="editais.php?pagina=<?php echo $num_pages-1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
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