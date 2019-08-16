<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");

if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}


// PESQUISA DE TURMAS

if ($_SESSION["tipo"] == "Professor"){
  $id = $_SESSION["id"];
  $sql_code = "SELECT `idTurma` FROM `turma-professor` WHERE `idProfessor`=$id";
  $results = mysqli_query(DBConecta(),$sql_code);
}

if (isset($_POST["salva"])){
  $turma = $_POST["turma"];
  $cor = $_POST["cor"];
  $titulo = $_POST["titulo"];
  $editor = $_POST["editor"];
  $start = $_POST["start"];
  $end = $_POST["end"];
  $idDisciplina = $_POST["disciplina"];
  $postador = $_SESSION["nome"];
  if ($_SESSION["tipo"] == "Administrador")
    $sql_code = "INSERT INTO calendario (title,description,color,start,end,geral,postador) VALUES ('$titulo','$editor','$cor','$start','$end','$turma','$postador')";
  else
    $sql_code = "INSERT INTO calendario (title,description,color,start,end,idTurma,idDisciplina,postador) VALUES ('$titulo','$editor','$cor','$start','$end','$turma','$idDisciplina','$postador')";
  $gera = mysqli_query(DBConecta(), $sql_code);
  if ($gera){
    echo "<div class='alert alert-success alert-dismissable status'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Evento adicionado com sucesso!</strong>
          </div>
          ";
  }
  else{
    echo "<div class='alert alert-danger alert-dismissable status'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Erro no cadastro do evento. Tente mais tarde e verifique sua conexão!</strong>
          </div>";
  }
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <link href="froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="froala/js/froala_editor.pkgd.min.js"></script>
  <link  href = "froala/css/froala_style.min.css" rel ="stylesheet" type = "text/css"/>
  <script type="text/javascript" src="froala/js/languages/pt_br.js"></script>
  <script src="bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <link rel="stylesheet" href="bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">
  <script src="bower_components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Barra cabeçalho -->
    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- Logo abreviada -->
        <span class="logo-mini"><img src="../img/Logo.png" alt="logo" width="30" height="30"></span>
        <span class="logo-lg">Portal Acadêmico</span>
      </a>
      <!-- Toggle Hamburguer -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
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
                    <a href="#" class="btn btn-default btn-flat">Senha</a>
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
            <a href="./index.php">
              <i class="fa fa-circle text-success"> <?php echo $_SESSION['tipo']; ?></i>
            </a>
          </div>

        </div>

        <!-- Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

          <?php if ($_SESSION['tipo'] == "Aluno"){ ?>
          <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Quadro de notas</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Professor"){ ?>
          <li><a href="lancamentoDeNotas.php"><i class="fa fa-clipboard"></i> <span>Lançar notas</span></a></li>
          <li class="active"><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Administrador"){ ?>
          <li class="active"><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
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
              <li><a href="matricula.php?id=0">Aluno na turma</a></li>
              <li><a href="matricula.php?id=1">Professor para disciplina</a></li>
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
          ADICIONAR EVENTO AO CALENDÁRIO
          <!--NOME DA PAGINA-->
        </h1>
      </section>
      <section class="content">
        <div class="col-md-12">
            <div class="box box-primary" >
              <form role="form" action="" method="POST" id="form-cadastro">
                <div class="box-body">
                  <div class="form-group col-md-6">
                    <label>Turmas</label>
                    <select class="form-control" name="turma">
                      <option value="" id="0">Selecione uma turma</option>
                      <?php if ($_SESSION["tipo"] == "Administrador"){ ?>
                      <option value="-1" id="todos">TODOS os professores</option>
                      <!--<option value="-2" id="todos">TODOS os alunos</option>-->
                      <?php } ?>
                      <?php
                        $AllTurmas = [];
                        if (mysqli_num_rows($results)){
                          while($turmas = mysqli_fetch_assoc($results)){
                            if (!in_array($turmas["idTurma"], $AllTurmas)){
                            echo "<option value=".$turmas["idTurma"].">".$turmas["idTurma"]."</option>";
                            $AllTurmas[] = $turmas["idTurma"];
                            }
                          }
                        }
                       ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Cores</label>
                    <select class="form-control" name="cor">
                      <option value="" id="0">Selecione uma cor</option>
                      <option value="#ed5959" id="1">Vermelho</option>
                      <option value="#f4cc00" id="2">Amarelo</option>
                      <option value="#576ee5" id="3">Azul</option>
                      <option value="black" id="4">Preto</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="emailUser">Titulo</label>
                    <input type="text" class="form-control" id="tituloEvent" name="titulo" placeholder="Titulo" required>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="editor">Descrição</label>
                    <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
                  </div>
                  <div class="form-group col-md-3">
                      <label for="matriUser">Data e hora inicial: *</label>
                      <input size="16" type="text"  class="form-control form_datetime" id="start" name="start" placeholder="AAA-MM-DD HH:mm:ss" required>
                      <span class="add-on"><i class="icon-th"></i></span>
                  </div>
                  <div class="form-group col-md-3">
                      <label for="matriUser">Data e hora final: *</label>
                      <input size="16" type="text"  class="form-control form_datetime" id="end" name="end" placeholder="AAA-MM-DD HH:mm:ss" required>
                      <span class="add-on"><i class="icon-remove"></i></span>
                      <span class="add-on"><i class="icon-th"></i></span>
                  </div>
                  <?php if ($_SESSION["tipo"] == "Professor"){ ?>
                    <div class="form-group col-md-3">
                      <label>Disciplina</label>
                      <select class="form-control" name="disciplina">
                        <option value="" id="0">Selecione sua disciplina</option>
                        <?php 
                          $conexao = DBConecta();
                          $AllDisciplinas = [];
                          $id = $_SESSION["id"];
                          $sql_code = "SELECT `idDisciplina` FROM `turma-professor` WHERE `idProfessor`= $id";
                          $results = mysqli_query($conexao, $sql_code);
                          if (mysqli_num_rows($results)){
                            while($idDisciplinas = mysqli_fetch_assoc($results)){
                              if (!in_array($idDisciplinas["idDisciplina"], $AllDisciplinas)){
                                $AllDisciplinas[] = $idDisciplinas["idDisciplina"];
                              }
                            }
                            for ($i = 0; $i < count($AllDisciplinas); $i++){
                              $sql_code = "SELECT * FROM `disciplina` WHERE `idDisciplina`= $AllDisciplinas[$i]";
                              $results = mysqli_query($conexao, $sql_code);
                              if (mysqli_num_rows($results)){
                                $nameDisciplina = mysqli_fetch_assoc($results);
                                $AllNameDisciplinas[] = $nameDisciplina; 
                              }
                            }
                          }
                          for ($i = 0; $i < count($AllDisciplinas); $i++){
                            echo "<option value=".$AllNameDisciplinas[$i]["idDisciplina"].">".$AllNameDisciplinas[$i]["nome"]."</option>";
                          }     
                        ?>
                      </select>
                    </div>
                  <?php } ?>
                  <p class="col-md-12">*OBS: Não esquecer de marcar o horário destido a este evento.</p>
                </div>
                <div class="box-footer ">
                  <button type="submit" class="btn btn-primary" name="salva" id="salva" style="margin-right: 5px;">Salvar</button>
                  <a href="addcalendario.php" class="btn btn-warning" id="cancela">Cancelar</a>
                </div>
              </form>
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

  <script>
    $(".form_datetime").datetimepicker({
        language:  'pt-BR',
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: 'top-left',
    });

    var editor = new FroalaEditor ( '#editor' , {
      language: 'pt_br',
      toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'textColor']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'alignJustify']
      },
      'moreRich': {
        'buttons': ['insertLink'] //'emoticons','html']
      }
    },

    // Para telas pequenas
    toolbarButtonsXS: [['undo', 'redo'], ['bold', 'italic', 'underline']],
    quickInsertTags: [''],
    placeholderText: "Digite aqui sua descrição...",
    })


  </script>

  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="bower_components/moment/moment.js"></script>
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>
