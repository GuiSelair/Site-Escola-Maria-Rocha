<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");


if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}

if (!isset($_SESSION["tipo"]) == "Administrador"){
  header("location: ./loginUser.php");
}

if (isset($_GET["id"])){
  $id = $_GET["id"];
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
            <p><?php echo $_SESSION['nome']; ?></p>
            <!--NOME COMPLETO-->
            <a href="#">
              <i class="fa fa-circle text-success"> <?php echo $_SESSION['tipo']; ?></i>
            </a>
          </div>

        </div>

        <!-- Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>INICIO</span></a></li>

          <?php if ($_SESSION['tipo'] == "Aluno"){ ?>
          <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Quadro de notas</span></a></li>
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
              <li><a href="matricula.php?id=0">Aluno na turma</a></li>
              <li><a href="matricula.php?id=1">Professor para disciplina</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </section>
    </aside>
    <?php if ($id == "0"){ ?>
      <!-- Titulo da Área com conteudo -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Matricula de Aluno
            <!--NOME DA PAGINA-->
          </h1>
        </section>

        <!-- Área com Conteudo -->
        <section class="content">
          <div class="col-md-12">
              <div class="box box-primary" >
                  <div class="box-body">
                    <div class="form-group col-md-6">
                      <label>Turmas</label>
                      <select class="form-control" id="turma" name="turma">
                        <option value="" id="0">Selecione uma turma</option>
                        <?php
                          $sql_code = "SELECT `idTurma` FROM `turma`";
                          $results = mysqli_query(DBConecta(),$sql_code);
                          if (mysqli_num_rows($results)){
                            while($turmas = mysqli_fetch_assoc($results)){
                              echo "<option value=".$turmas["idTurma"].">".$turmas["idTurma"]."</option>";
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Alunos</label>
                      <select class="form-control" id="aluno" name="aluno">
                        <option value="" id="0">Selecione um nome</option>
                        <?php
                          $sql_code = "SELECT `idAluno`, `nome`, `sobrenome` FROM `aluno`";
                          $results = mysqli_query(DBConecta(),$sql_code);
                          if (mysqli_num_rows($results)){
                            while($alunos = mysqli_fetch_assoc($results)){
                              $nomeCompleto = $alunos["nome"]." ".$alunos["sobrenome"];
                              echo "<option value=".$alunos["idAluno"].">".$nomeCompleto."</option>";
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3" >
                      <label>Semestre: </label>
                      <div class="radio"  >
                        <label style="margin-right: 5px;">
                          <input type="radio" id="1" value="1" name="semestre" >
                          1º Semestre
                        </label>
                        <label>
                          <input type="radio" id="2" value="2" name="semestre">
                          2º Semestre
                        </label>
                      </div>
                    </div>
                    <p class="text-muted col-md-12">OBS: Para buscar não precisa selecionar Alunos. A busca ocorre só com os valores Turma e Semestre</p>
                  </div>
                  <div class="box-footer ">
                    <button class="btn btn-primary" id="salva" style="margin-right: 5px;">Salvar</button>
                    <button class="btn btn-success" id="buscar" style="margin-right: 5px;">Buscar</button>
                    <a href="matricula.php?id=0" class="btn btn-warning" id="cancela">Cancelar</a>
                  </div>
            </div>
          </div>

          <script>
                // APAGANDO
                function apaga(turma, aluno, semestre){
                  $.ajax({
                    type: 'POST',
                    url: 'deleteMatriculaNota.php',
                    data: 'idTurma='+turma+'&idAluno='+aluno+'&semestre='+semestre,
                    beforeSend: function () {
                      $("#apaga").html("Apagando...")
                    },
                    success: function (html) {
                      $("#buscar").html("Atualizar");
                      $('#status').html(html);
                    }
                  })
                }
                $(document).ready(function () {
                  // SALVANDO
                  $("#salva").on("click", function () {
                    let idTurma = $("#turma").val();
                    let idAluno = $("#aluno").val();
                    let semestre = document.getElementsByName("semestre");
                    for (let i = 0; i < semestre.length; i++) {
                      if (semestre[i].checked) {
                        semestre = semestre[i].value
                      }
                    }

                    $.ajax({
                      type: 'POST',
                      url: 'salvaEMontaTabela.php',
                      data: 'idTurma='+idTurma+'&idAluno='+idAluno+'&semestre='+semestre,
                      beforeSend: function () {
                        $("#salva").html("Enviando...")
                      },
                      success: function (html) {
                        $("#salva").html("Salvar")
                        $('#tabela').append(html);
                      }
                    });
                  })
                  // BUSCANDO
                  $("#buscar").on("click", function(){
                    let idTurma = $("#turma").val();
                    let semestre = document.getElementsByName("semestre");
                    for (let i = 0; i < semestre.length; i++) {
                      if (semestre[i].checked) {
                        semestre = semestre[i].value
                      }
                    }
                    $('#tabela').empty();
                    $.ajax({
                      type: "POST",
                      url: "buscaTabela.php",
                      data: "idTurma="+idTurma+"&semestre="+semestre,
                      beforeSend: function(){
                        $("#buscar").html("Buscando...")
                      },
                      success: function(html){
                        console.log(html);
                        $("#buscar").html("Buscar")
                        $('#tabela').append(html);
                      }
                    })

                  })
                })
              </script>
          <div class="row">
            <div class="col-md-12">
              <div id="status"></div>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Notas Lançadas</h3>
                </div>
                <div class="box-body table-responsive ">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Aluno</th>
                        <th>Turma</th>
                        <th>Semestre</th>
                        <th>Opção</th>
                      </tr>
                    </thead>
                    <tbody id="tabela">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    <?php }elseif($id == "1"){ ?>
      <!-- Titulo da Área com conteudo -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Cadastro de Professor a Turma e Disciplina
            <!--NOME DA PAGINA-->
          </h1>
        </section>

        <!-- Área com Conteudo -->
        <section class="content">
          <div class="col-md-12">
              <div class="box box-primary" >
                  <div class="box-body">
                    <div class="form-group col-md-6">
                      <label>Professor</label>
                      <select class="form-control" id="professor" name="professor" required>
                        <option value="" id="0">Selecione um Professor</option>
                        <?php
                          $sql_code = "SELECT `idProfessor`, `nome`, `sobrenome` FROM `professor`";
                          $results = mysqli_query(DBConecta(),$sql_code);
                          if (mysqli_num_rows($results)){
                            while($professores = mysqli_fetch_assoc($results)){
                              $nomeCompleto = $professores["nome"]." ".$professores["sobrenome"];
                              echo "<option value=".$professores["idProfessor"].">".$nomeCompleto."</option>";
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Turmas</label>
                      <select class="form-control" id="turma" name="turma" required>
                        <option value="" id="0">Selecione uma turma</option>
                        <?php
                          $sql_code = "SELECT `idTurma` FROM `turma`";
                          $results = mysqli_query(DBConecta(),$sql_code);
                          if (mysqli_num_rows($results)){
                            while($turmas = mysqli_fetch_assoc($results)){
                              echo "<option value=".$turmas["idTurma"].">".$turmas["idTurma"]."</option>";
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Disciplina</label>
                      <select class="form-control" id="disciplina" name="disciplina" required>
                        <option value="" id="0">Selecione uma disciplina</option>
                        <?php
                          $sql_code = "SELECT * FROM `disciplina` ORDER BY nome asc";
                          $results = mysqli_query(DBConecta(),$sql_code);
                          if (mysqli_num_rows($results)){
                            while($disciplinas = mysqli_fetch_assoc($results)){
                              echo "<option value=".$disciplinas["idDisciplina"].">".$disciplinas["nome"]."</option>";
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3" >
                      <label>Semestre: </label>
                      <div class="radio"  >
                        <label style="margin-right: 5px;">
                          <input type="radio" id="1" value="1" name="semestre" >
                          1º Semestre
                        </label>
                        <label>
                          <input type="radio" id="2" value="2" name="semestre">
                          2º Semestre
                        </label>
                      </div>
                    </div>
                    <p class="text-muted col-md-12">OBS: Para buscar não precisa selecionar Professor. A busca ocorre só com os valores Turma, Disciplina e Semestre</p>
                  </div>
                  <div class="box-footer ">
                    <button class="btn btn-primary" id="salva" style="margin-right: 5px;">Salvar</button>
                    <button class="btn btn-success" id="buscar" style="margin-right: 5px;">Buscar</button>
                    <a href="matricula.php?id=1" class="btn btn-warning" id="cancela">Cancelar</a>
                  </div>
            </div>
          </div>

          <script>
                // APAGANDO
                function apaga(turma, professor, semestre, disciplina){
                  $.ajax({
                    type: 'POST',
                    url: 'deleteMatriculaNota.php',
                    data: 'idTurma='+turma+'&idProfessor='+professor+'&semestre='+semestre+'&idDisciplina='+disciplina,
                    beforeSend: function () {
                      $("#apaga").html("Apagando...")
                    },
                    success: function (html) {
                      $("#buscar").html("Atualizar");
                      $('#status').html(html);
                    }
                  })
                }
                $(document).ready(function () {

                  // SALVANDO
                  $("#salva").on("click", function () {
                    let idTurma = $("#turma").val();
                    let idProfessor = $("#professor").val();
                    let idDisciplina = $("#disciplina").val();
                    let semestre = document.getElementsByName("semestre");
                    for (let i = 0; i < semestre.length; i++) {
                      if (semestre[i].checked) {
                        semestre = semestre[i].value
                      }
                    }
                    $.ajax({
                      type: 'POST',
                      url: 'salvaEMontaTabela.php',
                      data: 'idTurma='+idTurma+'&idProfessor='+idProfessor+'&semestre='+semestre+'&idDisciplina='+idDisciplina,
                      beforeSend: function () {
                        $("#salva").html("Enviando...")
                      },
                      success: function (html) {
                        $("#salva").html("Salvar")
                        $('#tabela').append(html);
                      }
                    });
                  })

                  // BUSCANDO
                  $("#buscar").on("click", function(){
                    let idTurma = $("#turma").val();
                    let idDisciplina = $("#disciplina").val();
                    let semestre = document.getElementsByName("semestre");
                    for (let i = 0; i < semestre.length; i++) {
                      if (semestre[i].checked) {
                        semestre = semestre[i].value
                      }
                    }
                    $('#tabela').empty();
                    $.ajax({
                      type: "POST",
                      url: "buscaTabela.php",
                      data: "idTurma="+idTurma+"&semestre="+semestre+'&idDisciplina='+idDisciplina,
                      beforeSend: function(){
                        $("#buscar").html("Buscando...")
                      },
                      success: function(html){
                        console.log(html);
                        $("#buscar").html("Buscar");
                        $('#tabela').append(html);
                      }
                    })
                  })
                })
              </script>
          <div class="row">
            <div class="col-md-12">
              <div id="status"></div>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Notas Lançadas</h3>
                </div>
                <div class="box-body table-responsive ">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Professor</th>
                        <th>Turma</th>
                        <th>Disciplina</th>
                        <th>Semestre</th>
                        <th>Opção</th>
                      </tr>
                    </thead>
                    <tbody id="tabela">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    <?php } ?>
    
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
