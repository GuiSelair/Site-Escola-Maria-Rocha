<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}
if (!isset($_SESSION["tipo"]) == "Aluno"){
    header("location: ./loginUser.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portal Acadêmico</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <span class="logo-mini"><img src="../img/Logo.png" alt="logo" width="30" height="30"></span>
        <span class="logo-lg">Portal Acadêmico</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Notificações e Usuario -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- Notificações -->
            <?php include_once("notificacoes.php") ?>

            <!-- Conta do usuario -->
            <li class="dropdown user user-menu ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user mx-5"></i>
                <span class="hidden-xs"><?php echo $_SESSION['nome']; ?></span>
                <!--NOME COMPLETO DO USUARIO-->
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <div class="pull-left mx-5">
                    <a href="redefine.php" class="btn btn-default btn-flat">Senha</a>
                  </div>
                  <div class="pull-right mx-5">
                    <a href="?deslogar" class="btn btn-default btn-flat">Sair</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Botão Toggle de ADM
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>-->
          </ul>
        </div>
      </nav>
    </header>

    <!-- Barra Lateral Links -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left">
            <i class="fa fa-user fa-3x" style="color: white;"></i>
          </div>
          <div class="pull-left info ">
            <p><?php echo substr($_SESSION['nome'],0,20)."..."; ?></p>
            <!--NOME COMPLETO-->
            <a href="index.php">
              <i class="fa fa-circle text-success"> <?php echo $_SESSION['tipo']; ?></i>
            </a>
          </div>

        </div>

        <!-- Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

          <?php if ($_SESSION['tipo'] == "Aluno"){ ?>
          <li class="active"><a href="quadroNotas.php"><i class="fa fa-clipboard"></i> <span>Quadro de notas</span></a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Professor"){ ?>
          <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Lançar notas</span></a></li>
          <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Administrador"){ ?>
          <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-plus-square"></i> <span>Cadastros</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu text-center">
              <li><a href="cadastro.php?id=0">Aluno</a></li>
              <li><a href="cadastro.php?id=1">Professor</a></li>
              <li><a href="cadastro.php?id=2">Turma</a></li>
              <li><a href="cadastro.php?id=3">Disciplinas</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-id-badge"></i><span>Matricula</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu text-center">
              <li><a href="cadastro.php?id=0">Aluno na turma</a></li>
              <li><a href="cadastro.php?id=1">Professor para disciplina</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </section>
    </aside>

    <!-- Titulo da Área com conteudo -->
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Quadro de Notas
          <!--NOME DA PAGINA-->
        </h1>
      </section>

      <!-- Área com Conteudo -->
      <section class="content ">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Notas Lançadas</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Matriz Curricular</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <!-- TABELA DE NOTAS -->
                  <div class="box-body table-responsive ">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Disciplina</th>
                          <th>Turma</th>
                          <th>Data da Avaliação</th>
                          <th>Conceito</th>
                        </tr>
                      </thead>
                      <tbody id="tabela">
                        <?php 
                            $conexao = DBConecta();
                            $idAluno = $_SESSION["id"];

                            $sql_code = "SELECT * FROM `avalhacao` WHERE `idAluno` = $idAluno";
                            $results = mysqli_query($conexao, $sql_code);

                            if ($results && mysqli_num_rows($results)){
                                while ($avaliacoes = mysqli_fetch_assoc($results)){
                                    $sql_code0 = "SELECT * FROM `aluno-disciplina` WHERE `idAluno` = $idAluno AND `idDisciplina` =".$avaliacoes['idDisciplina'];
                                    $results0 = mysqli_query($conexao, $sql_code0);
                                    if ($results0 && mysqli_num_rows($results0) != 1){
                                        $DiscNaoAprovadas[] = $avaliacoes;
                                    }
                                }
                                if (!empty($DiscNaoAprovadas)){
                                    for ($i = 0; $i < count($DiscNaoAprovadas); $i++){
                                        // BUSCA NOME DA DISCIPLINA
                                        $sql_code = "SELECT `nome` FROM `disciplina` WHERE `idDisciplina` = ".$DiscNaoAprovadas[$i]["idDisciplina"];
                                        $results0 = mysqli_query($conexao, $sql_code);
                                        $nomeDisciplina = mysqli_fetch_assoc($results0);
                    
                                        // IMPRIME LINHA DA TABELA
                                        if ($DiscNaoAprovadas[$i]["conceito"] == "Apto")
                                          echo "<tr><th>".$nomeDisciplina["nome"]."</th><th>".$DiscNaoAprovadas[$i]["idTurma"]."</th><th>".date("d/m/Y", strtotime($DiscNaoAprovadas[$i]["data"]))."</th><th><span class='label label-success'>".$DiscNaoAprovadas[$i]["conceito"]."</span></th></tr>";
                                        else  
                                          echo "<tr><th>".$nomeDisciplina["nome"]."</th><th>".$DiscNaoAprovadas[$i]["idTurma"]."</th><th>".date("d/m/Y", strtotime($DiscNaoAprovadas[$i]["data"]))."</th><th><span class='label label-danger'>".$DiscNaoAprovadas[$i]["conceito"]."</span></th></tr>";
                                      }
                                }
                                else{
                                    echo "<p>Nenhuma nota disponivel...</p>";
                                }
                            }
                            else{
                                echo "<p>Nenhuma nota disponivel...</p>";
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                
                <div class="tab-pane" id="tab_2">
                <div class="box-body table-responsive ">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Disciplina</th>
                          <th>Conceito</th>
                        </tr>
                      </thead>
                      <tbody id="tabela">
                        <?php 
                            $conexao = DBConecta();
                            $AllTurmas = [];
                            $idAluno = $_SESSION["id"];
                            // BUSCANDO TURMAS QUE O USUARIO ESTA MATRICULADO
                            $sql_code = "SELECT `idTurma` FROM `turma-aluno` WHERE `idAluno` = '$idAluno'";
                            $results = mysqli_query($conexao, $sql_code);
                            if ($results && mysqli_num_rows($results)){
                              while($idTurmas = mysqli_fetch_assoc($results)){
                                if (!in_array($idTurmas["idTurma"], $AllTurmas)){
                                  $AllTurmas[] = $idTurmas["idTurma"];
                                }
                              }
                              for ($i = 0; $i < count($AllTurmas); $i++){
                                $AllDisciplina = [];
                                // BUSCANDO DISCIPLINAS DAS TURMAS QUE O USUARIO ESTA MATRICULADO
                                $sql_code = "SELECT `idDisciplina` FROM `turma-professor` WHERE `idTurma`=".$AllTurmas[$i];
                                $results0 = mysqli_query($conexao, $sql_code);
                                if ($results0 && mysqli_num_rows($results0)){
                                  while($idDisciplinas = mysqli_fetch_assoc($results0)){
                                    if (!in_array($idDisciplinas["idDisciplina"], $AllDisciplina)){
                                      $AllDisciplina[] = $idDisciplinas["idDisciplina"];
                                    }
                                  }
                                }
                              }

                              // BUSCANDO NOMES DAS DISCIPLINAS
                              if (!empty($AllDisciplina)){
                                for ($i = 0; $i < count($AllDisciplina); $i++){
                                  $sql_code = "SELECT `nome` FROM `disciplina` WHERE `idDisciplina` = ".$AllDisciplina[$i];
                                  $results0 = mysqli_query($conexao, $sql_code);
                                  $nomeDisciplina = mysqli_fetch_assoc($results0);

                                  // VERIFICANDO SE O ALUNO ESTA APROVADO NA DISCIPLINA
                                  $sql_code = "SELECT `conceito` FROM `aluno-disciplina` WHERE `idDisciplina`=".$AllDisciplina[$i]." AND `idAluno` = '$idAluno'";
                                  $results0 = mysqli_query($conexao, $sql_code);
                                  if (mysqli_num_rows($results0)){
                                    $conceito = mysqli_fetch_assoc($results0);
                                    if ($conceito["conceito"] == "Apto")
                                      echo "<tr><td>".$nomeDisciplina["nome"]."</td><td><span class='label label-success'>".$conceito["conceito"]."</span></td></tr>";
                                    else
                                      echo "<tr><td>".$nomeDisciplina["nome"]."</td><td><span class='label label-danger'>".$conceito["conceito"]."</span></td></tr>";
                                  }
                                  else{
                                    echo "<tr><td>".$nomeDisciplina["nome"]."</td><td><span class='label label-warning'>Pendente</span></td></tr>";
                                  }
                                }
                              }
                            }

                          
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>


    <!-- Rodapé -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <i>Todos os direitos reservados</i>
      </div>
      <strong>Copyright &copy; 2019 Guilherme Selair</strong>
    </footer>
  </div>

  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="bower_components/moment/moment.js"></script>
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>