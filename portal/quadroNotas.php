<?php

//////////////////////////////////////
////        QUADRO DE NOTAS      ////
//////////////////////////////////////

session_start();
include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("../conexao/function.php");

// VERIFICA SE O USUÁRIO ESTÁ LOGADO
if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}

// VERIFICA SE O USUÁRIO É ALUNO
if (!isset($_SESSION["tipo"]) == "Aluno"){
    header("location: ./loginUser.php");
}

//  VERIFICA SE A DISCIPLINA PASSADA JÁ FOI CURSADA OU NÃO E
function ConfereAprovacao ($conexao, $idDisciplina, $idAluno){
  $sql_code = "SELECT * FROM `aluno-disciplina` WHERE `idDisciplina` = ".$idDisciplina." AND `idAluno` = ".$idAluno;
  $query = mysqli_query($conexao, $sql_code);     

  // BUSCA POR DISCIPLINAS JÁ CONCLUÍDAS
  if ($query && mysqli_num_rows($query)){
    $response = mysqli_fetch_assoc($query);

    // DISCIPLINAS NÃO APROVADAS OU AUSENTES
    if ($response["conceito"] != "Apto"){
      $nomeDisciplina = BuscaNomes($conexao, $response["idDisciplina"], "disciplina");
      $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
      echo "<tr><td>".$nomeDisciplina["nome"]."</td><td><span class='label label-danger'>".$response["conceito"]."</span></td></tr>";
    }
    //  DISCIPLINAS APROVADAS
    else{
      $nomeDisciplina = BuscaNomes($conexao, $response["idDisciplina"], "disciplina");
      $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
      echo "<tr><td>".$nomeDisciplina["nome"]."</td><td><span class='label label-success'>".$response["conceito"]."</span></td></tr>";
    }  
  }
  //  DISCIPLINAS AINDA NÃO CURSADAS
  else{
    $nomeDisciplina = BuscaNomes($conexao, $idDisciplina, "disciplina");
    $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
    echo "<tr><td>".$nomeDisciplina["nome"].$prerequisito."</td><td><span class='label label-warning'>Pendente</span></td></tr>";
  }                                
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PORTAL ACADÊMICO - &nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="../img/favicon.ico" />

  <!-- IMPORTAÇÃO ADMINLTE -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!--CABEÇALHO-->
    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><img src="../img/Logo.png" alt="logo" width="30" height="30"></span>
        <span class="logo-lg"><img src="../img/Logo.png" alt="logo" width="25" height="25"> Portal Acadêmico</span>
      </a>

      <!--MENU DISPOSITIVOS MÓVEIS-->
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!--NOTIFICAÇÕES E USUÁRIOS-->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!--IMPORTANDO O ARQUIVO DE NOTIFICAÇÕES-->
            <?php include_once("notificacoes.php") ?>

            <li class="dropdown user user-menu ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user mx-5"></i>
                <span class="hidden-xs"><?php echo $_SESSION['nome']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <div class="pull-left mx-5">
                    <a href="./redefine.php" class="btn btn-default btn-flat">Alterar senha</a>
                  </div>
                  <div class="pull-right mx-5">
                    <a href="?deslogar" class="btn btn-default btn-flat">Sair</a>
                  </div>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </nav>
    </header>

    <!--MENU LATERAL-->
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left">
            <i class="fa fa-user fa-3x" style="color: white;"></i>
          </div>
          <div class="pull-left info ">
            <p><?php echo substr($_SESSION['nome'],0,20)."..."; ?></p>
            <a><i class="fa fa-circle text-success"> <?php echo $_SESSION['tipo']; ?></i></a>
          </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li><a href="index.php"><i class="fa fa-home"></i> <span class="text-uppercase">Inicio</span></a></li>

          <!--OPÇÕES DE MENU PARA CADA TIPO DE USUÁRIO-->
          <?php if ($_SESSION['tipo'] == "Aluno"){ ?>
            <li class="active"><a href="quadroNotas.php"><i class="fa fa-clipboard"></i> <span class="text-uppercase">Quadro de notas</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Professor"){ ?>
            <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span class="text-uppercase">Lançar notas</span></a></li>
            <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span class="text-uppercase">Adicionar Calendario</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Administrador"){ ?>
            <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span class="text-uppercase">Adicionar Calendario</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-plus-square"></i> <span class="text-uppercase">Cadastros</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu text-center">
                <li><a href="cadastro.php?id=0" class="text-uppercase">Aluno</a></li>
                <li><a href="cadastro.php?id=1" class="text-uppercase">Professor</a></li>
                <li><a href="cadastro.php?id=2" class="text-uppercase">Turma</a></li>
                <li><a href="cadastro.php?id=3" class="text-uppercase">Disciplinas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-id-badge"></i><span class="text-uppercase">Matricula</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu text-center">
                <li><a href="matricula.php?id=0" class="text-uppercase">Aluno na turma</a></li>
                <li><a href="matricula.php?id=1" class="text-uppercase">Professor para disciplina</a></li>
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
          QUADRO DE NOTAS
        </h1>
      </section>

      <!--ÁREA DE CONTEÚDO-->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">

            <!--ABAS DE OPÇÕES-->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">NOTAS LANÇADAS</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">MATRIZ CURRICULAR</a></li>
              </ul>
              <div class="tab-content">

                <!-- TABELA DE NOTAS -->
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body table-responsive ">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nome da Avaliação</th>
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
                            // BUSCA AVALIAÇÕES REFERENCIANDO O ALUNO
                            $sql_code = "SELECT * FROM `avalhacao` WHERE `idAluno` = $idAluno";
                            $results = mysqli_query($conexao, $sql_code);
                            if ($results && mysqli_num_rows($results)){
                                while ($avaliacoes = mysqli_fetch_assoc($results)){
                                  // VERIFICA SE O ALUNO JA ESTÁ APROVADO NA DISCIPLINA DA AVALIAÇÃO E MOSTRA CASO NÃO ESTIVER
                                  $sql_code = "SELECT * FROM `aluno-disciplina` WHERE `idAluno` = $idAluno AND `idDisciplina` = ".$avaliacoes["idDisciplina"];
                                  $buscaAprovacao = mysqli_query($conexao, $sql_code);
                                  if ($buscaAprovacao && mysqli_num_rows($buscaAprovacao)){
                                      $verificaAprovacao = mysqli_fetch_assoc($buscaAprovacao);
                                      // CASO O ALUNO NÃO ESTEJA APTO NA DISCIPLINA
                                      if ($verificaAprovacao["conceito"] != "Apto")
                                        $DiscNaoAprovadas[] = $avaliacoes;
                                  }elseif (!mysqli_num_rows($buscaAprovacao)){
                                    // CASO O ALUNO NÃO TENHA CONCLUIDO PELO MENOS UMAS VEZ A DISCIPLINA
                                    $DiscNaoAprovadas[] = $avaliacoes;
                                  }
                                }
                                if (!empty($DiscNaoAprovadas)){
                                    for ($i = 0; $i < count($DiscNaoAprovadas); $i++){
                                        $nomeDisciplina = BuscaNomes($conexao, $DiscNaoAprovadas[$i]["idDisciplina"], "disciplina");
                                        // IMPRIME LINHA DA TABELA
                                        if ($DiscNaoAprovadas[$i]["conceito"] == "Apto")
                                          echo "<tr><th></th><th>".$nomeDisciplina["nome"]."</th><th>".$DiscNaoAprovadas[$i]["idTurma"]."</th><th>".date("d/m/Y", strtotime($DiscNaoAprovadas[$i]["data"]))."</th><th><span class='label label-success'>".$DiscNaoAprovadas[$i]["conceito"]."</span></th></tr>";
                                        else  
                                          echo "<tr><th></th><th>".$nomeDisciplina["nome"]."</th><th>".$DiscNaoAprovadas[$i]["idTurma"]."</th><th>".date("d/m/Y", strtotime($DiscNaoAprovadas[$i]["data"]))."</th><th><span class='label label-danger'>".$DiscNaoAprovadas[$i]["conceito"]."</span></th></tr>";
                                      }
                                }
                                else{
                                  echo "<p class='text-muted'>Nenhuma nota disponível...</p>";
                                }
                            }
                            else{
                              echo "<p class='text-muted'>Nenhuma nota disponível...</p>";
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!--MATRIZ CURRICULAR-->
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
                            $sql_code = "SELECT * FROM `disciplina` WHERE `idCurso` = 1";
                            $query = mysqli_query($conexao, $sql_code);
                            if ($query && mysqli_num_rows($query)){
                              while ($response = mysqli_fetch_assoc($query)){
                                ConfereAprovacao($conexao, $response["idDisciplina"], $_SESSION["id"]);  
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