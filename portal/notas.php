<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}
if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

// BUSCA DISCIPLINAS MINISTRADAS PELO PROFESSOR LOGADO
if ($_SESSION["tipo"] == "Professor"){
    $conexao = DBConecta();
    $id = $_SESSION["id"];
    $sql_code = "SELECT `idDisciplina` FROM `turma-professor` WHERE `idProfessor`= $id";
    $results = mysqli_query($conexao, $sql_code);
    if (mysqli_num_rows($results)){
        while($idDisciplinas = mysqli_fetch_assoc($results)){
            $AllDisciplinas[] = $idDisciplinas["idDisciplina"];
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
          <li><a href="index.php"><i class="fa fa-home"></i> <span>INICIO</span></a></li>

          <?php if ($_SESSION['tipo'] == "Aluno"){ ?>
          <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Quadro de notas</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Professor"){ ?>
          <li class="active"><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Lançar notas</span></a></li>
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
          LANÇAMENTO DE NOTAS
          <!--NOME DA PAGINA-->
        </h1>
      </section>

      <!-- Área com Conteudo -->
      <section class="content ">
        <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-body">
              <div class="form-group col-md-3">
                <label>Disciplina</label>
                <select class="form-control" name="disciplina" id="disciplina">
                  <option value="" id="0">Selecione abaixo</option>
                  <?php 
                            for ($i = 0; $i < count($AllDisciplinas); $i++){
                                echo "<option value=".$AllNameDisciplinas[$i]["idDisciplina"].">".$AllNameDisciplinas[$i]["nome"]."</option>";
                            }             
                        ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Turma</label>
                <select class="form-control" name="turma" id="turma">
                  <option value="">Selecione uma disciplina</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Alunos*</label>
                <select class="form-control" name="aluno" id="aluno">


                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="matriUser">Data da Avaliação</label>
                <input type="date" class="form-control" id="data" name="dataAvaliacao" placeholder="Data da Avalição"
                  required>
              </div>

              <div class="form-group col-md-3">
                <label>Conceito: </label>
                <div class="radio">
                  <label style="margin-right: 5px;">
                    <input type="radio" id="mensao" value="Apto" name="mensao">
                    APTO
                  </label>
                  <label>
                    <input type="radio" id="mensao" value="Não Apto" name="mensao">
                    NÃO APTO
                  </label>
                </div>
              </div>

              <div class="form-group col-md-2" style="margin-top: 20px;">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="final" id="final" value="1">
                    Conceito Final*
                  </label>
                </div>
              </div>
              <p class="col-md-12">*OBS: A opção "Conceito Final" só deve ser marcada quando a nota a ser lançada é a final. Desta forma é a nota que define se o aluno está apto ou não apto no semestre.</p>
              <p class="col-md-12">*OBS: Para realizar buscas de notas já lançadas, não é preciso marcar a seleção "Alunos". Pois a busca realizada é por turma e por data de avaliação.</p>
            </div>
            <div class="box-footer ">
              <button class="btn btn-primary" id="salva" style="margin-right: 5px;">Salvar</button>
              <button class="btn btn-success" id="buscar" style="margin-right: 5px;">Buscar</button>
              <a href="notas.php" class="btn btn-warning" id="cancela">Cancelar</a>
            </div>

            <script>
              $(document).ready(function () {

                $("#disciplina").on("change", function () {
                  let idDisciplina = $(this).val();
                  console.log(idDisciplina);
                  if (idDisciplina != "") {
                    $.ajax({
                      type: 'POST',
                      url: 'getDados.php',
                      data: 'idDisciplina=' + idDisciplina,
                      success: function (html) {
                        $('#turma').html(html)
                      }
                    });
                  }
                })
                $("#turma").on("change", function () {
                  let idTurma = $(this).val();
                  if (idTurma != "") {
                    $.ajax({
                      type: 'POST',
                      url: 'getDados.php',
                      data: 'idTurma=' + idTurma,
                      success: function (html) {
                        $('#aluno').html(html)
                      }
                    });
                  }
                })
                $("#salva").on("click", function () {
                  let idDisciplina = $("#disciplina").val();
                  let idTurma = $("#turma").val();
                  let idAluno = $("#aluno").val();
                  let data = $("#data").val();
                  let mensao = document.getElementsByName("mensao");
                  for (let i = 0; i < mensao.length; i++) {
                    if (mensao[i].checked) {
                      mensao = mensao[i].value
                    }
                  }
                  let final = document.getElementsByName("final");
                  for (let i = 0; i < final.length; i++) {
                    if (final[i].checked) {
                      final = final[i].value
                    }
                  }
                  if (final != '1') {
                    final = "0";
                  }

                  $.ajax({
                    type: 'POST',
                    url: 'montaTabela.php',
                    data: 'idTurma=' + idTurma + '&idDisciplina=' + idDisciplina + '&idAluno=' + idAluno +
                      '&data=' + data + '&mensao=' + mensao + '&final=' + final,
                    beforeSend: function () {
                      $("#salva").html("Enviando...")
                    },
                    success: function (html) {
                      $("#salva").html("Salvar")
                      $('#tabela').append(html);
                    }
                  });
                })

                $("#buscar").on("click", function(){
                  let idDisciplina = $("#disciplina").val();
                  let idTurma = $("#turma").val();
                  let data = $("#data").val();
                  $('#tabela').empty();
                  $.ajax({
                    type: "POST",
                    url: "buscaTabela.php",
                    data: "idTurma="+idTurma+"&idDisciplina="+idDisciplina+"&data="+data,
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
          </div>
        </div>
        <!-- TABELA COM NOTAS LANÇADAS-->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Notas Lançadas</h3>
              </div>
              <div class="box-body table-responsive ">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Aluno</th>
                      <th>Disciplina</th>
                      <th>Turma</th>
                      <th>Data da Avaliação</th>
                      <th>Mensão</th>
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