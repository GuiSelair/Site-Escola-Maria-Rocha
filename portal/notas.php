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
            <div class="box box-primary" >
              <form role="form" action="" method="POST" id="form-cadastro">
                <div class="box-body">
                    <div class="form-group col-md-2">
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
                        <label>Turmas</label>
                        <select class="form-control" name="turma" id="turma">
                          <option value="">Selecione uma disciplina</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Alunos</label>
                        <select multiple class="form-control" name="aluno" id="aluno">


                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                    <label for="matriUser">Data da Avaliação</label>
                    <input type="date" class="form-control" id="dataAvaliacao" name="dataAvaliacao" placeholder="Data da Avalição" required>
                    </div>
                </div>
                <div class="box-footer ">
                  <button type="submit" class="btn btn-primary" name="salva" id="salva" style="margin-right: 5px;">Salvar</button>
                  <button class="btn btn-success" name="salva" id="salva" style="margin-right: 5px;">Buscar</button>
                  <a href="notas.php" class="btn btn-warning" id="cancela">Cancelar</a>
                </div>
              </form>
              <script>
                $(document).ready(function(){
                  $("#disciplina").on("change", function(){
                    let idDisciplina = $(this).val();
                    console.log(idDisciplina);
                    if (idDisciplina != ""){
                      $.ajax({
                          type:'POST',
                          url:'getDados.php',
                          data:'idDisciplina='+idDisciplina,
                          success:function(html){
                            console.log(html);
                            
                            $('#turma').html(html)
                          }
                      });
                    }
                  })
                  $("#coluna").on("change", function(){
                    let idTurma = $(this).val();
                    if (idTurma != ""){
                      $.ajax({
                          type:'POST',
                          url:'getDados.php',
                          data:'idTurma='+idTurma,
                          success:function(html){
                            $('#aluno').html()
                          }
                      });
                    }
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
                <tbody><tr>
                  <th>ID</th>
                  <th>Aluno</th>
                  <th>Data da Avaliação</th>
                  <th>Mensão</th>
                  <th>Opção</th>
                </tr>
                <tr>
                  <td>..</td>
                  <td>Teste</td>
                  <td>data</td>
                  <td><span class="label label-success">APTO</span></td>
                  <td><?php echo "<a class='btn btn-danger' href='deletar.php'><i class='fa fa-trash'></i>Excluir</a>" ?></td>
                </tr>
              </tbody></table>
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
