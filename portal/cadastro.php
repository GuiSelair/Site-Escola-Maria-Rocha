<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (isset($_GET['deslogar'])) {   
  session_destroy();
  header("location: ./loginUser.php");
}

if (isset($_GET['id'])){
    $id = $_GET['id'];

    switch ($id) {
        case '0':
            $tit = "ALUNO";
            $sql_code = "SELECT * FROM aluno";
            break;
        case '1':
            $tit = "PROFESSOR";
            $sql_code = "SELECT * FROM professor";
            break;
        case '2':
            $tit = "TURMA";
            $sql_code = "SELECT * FROM turma";
            break;
        case '3':
            $tit = "DISCIPLINAS";
            $sql_code = "SELECT * FROM disciplina";
            break;
        default:
            header("location: ./index.php");
            break;
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
<!--
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
-->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <script src='js/jquery.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src="bower_components\fullcalendar\dist\locale\pt-br.js"></script>
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
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger">100</span>
                <!--QUANDO HÁ NOTIFICAÇÕES NÃO LIDAS-->
              </a>
              <ul class="dropdown-menu">
                <li class="header">Você tem 100 notificações</li>
                <li>
                  <ul class="menu">
                    <li>
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> Aviso de Reunião dia ...
                      </a>
                    </li>

                  </ul>
                </li>
                <li class="footer"><a href="#">Ver mais</a></li>
              </ul>
            </li>

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
          <li><a href="notas.php"><i class="fa fa-clipboard"></i> <span>Lançar notas</span></a></li>
          <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
          <?php } ?>

          <?php if ($_SESSION['tipo'] == "Administrador"){ ?>
          <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span>Adicionar Calendario</span></a></li>
          <li class="treeview active">
            <a href="#"><i class="fa fa-plus-square"></i> <span>Cadastros</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu text-center">
              <li class="active"><a href="cadastro.php?id=0">Aluno</a></li>
              <li><a href="cadastro.php?id=1">Professor</a></li>
              <li><a href="cadastro.php?id=2">Turma</a></li>
              <li><a href="cadastro.php?id=3">Disciplinas</a></li>
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
          CADASTRO DE <?php echo $tit; ?>
          <!--NOME DA PAGINA-->
        </h1>
      </section>

      <!-- Área com Conteudo -->
      <section class="content">
        <script type="text/javascript">
          function buscador(){
            let buscaNome = document.getElementById("buscaNome").value;
            let buscaSobre = document.getElementById("buscaSobre").value;
            $.ajax({
              <?php $bloqueio = 'disabled'; ?>
              type: "POST",
              dataType:"json",
              url: "buscador.php",
              data: "tabela_ID="+<?php echo $id ?>+"&nome="+buscaNome+"&sobrenome="+buscaSobre,
              success: function(results){
                console.log(results);
                
                if (<?php echo $id ?> == '0'){
                  document.getElementById("nomeUser").value = results["nome"]
                  document.getElementById("sobrenomeUser").value = results["sobrenome"]
                  if (results["email"] != "NULL")
                    document.getElementById("emailUser").value = results["email"]

                  if (results["dataEntrada"] != "NULL")
                    document.getElementById("matriUser").value = results["dataEntrada"]

                  document.getElementById("foneUser").value = results["telefone"]
                  
                }
                
              }
            })
            document.getElementById("buscaNome").value = "";
            document.getElementById("buscaSobre").value = "";
          }
        </script>
        <div class="container text-center mb-4" style="margin-bottom: 30px;">
            <div class="row">
              <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Nome" id="buscaNome" />
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Sobrenome" id="buscaSobre"/>
              </div>
              <div class="col-md-3">
                  <button type="button" class="btn btn-primary" id="busca" onclick="buscador()">Buscar Aluno</button>  
                  <button type="button" class="btn btn-primary" id="cadastra">Cadastrar Aluno</button>
              </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary" >
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="nomeUser">Nome</label>
                  <input type="text" class="form-control" id="nomeUser" placeholder="Nome" <?php echo $bloqueio; ?> />
                </div>
                <div class="form-group">
                  <label for="sobrenomeUser">Sobrenome</label>
                  <input type="text" class="form-control" id="sobrenomeUser" placeholder="Sobrenome" <?php echo $bloqueio; ?> >
                </div>
                <div class="form-group">
                  <label for="emailUser">Email</label>
                  <input type="email" class="form-control" id="emailUser" placeholder="Email" <?php echo $bloqueio; ?>>
                </div>
                <div class="form-group">
                  <label for="matriUser">Data de Matricula</label>
                  <input type="date" class="form-control" id="matriUser" placeholder="Data de Matricula" <?php echo $bloqueio; ?>>
                </div>
                <div class="form-group">
                  <label for="foneUser">Telefone</label>
                  <input type="text" class="form-control" id="foneUser" placeholder="Telefone" <?php echo $bloqueio; ?>>
                </div>
                <div class="form-group">
                  <label>Sexo: </label>
                  <div class="radio">
                    <label>
                      <input type="radio" id="masculino" value="masculino" > 
                      Masculino
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="feminino" value="feminino">
                      Feminino
                    </label>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-3">
            <div style="margin-bottom: 5px;">
                <button type="button" class="btn btn-warning">Editar Cadastro</button>    
            </div>
            <div>
                <button type="button" class="btn btn-danger">Excluir Cadastro</button>
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
  <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>