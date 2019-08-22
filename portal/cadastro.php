<?php

////////////////////////////////////////////////////
////   CADASTRO DE USUÁRIOS/TURMAS/DISCIPLINAS  ////
////////////////////////////////////////////////////

session_cache_expire(10);
session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("../conexao/function.php");


if (isset($_GET['deslogar'])) {
  session_destroy();
  header("location: ./loginUser.php");
}

if (!isset($_SESSION["id"])){
  header("location: ./loginUser.php");
}

$conexao = DBConecta();

if (isset($_POST['edita'])){
  $id = $_GET['id'];

  switch ($id) {
    case '0':
      $idUser = $_POST["idUser"];
      $nome = $_POST['nomeUser'];
      $sobrenome = $_POST['sobrenomeUser'];
      $email = $_POST['emailUser'];
      $login = $_POST['loginUser'];
      $dataNascimento = $_POST['dataNascimento'];
      $sexo = $_POST['sexo'];
      $telefone = $_POST["foneUser"];

      $sql_code = "UPDATE aluno SET nome = '$nome', sobrenome = '$sobrenome', dataNascimento = '$dataNascimento', email = '$email', sexo = '$sexo', login = '$login', telefone = $telefone WHERE idAluno = '$idUser'";
      $execute_sql = mysqli_query(DBConecta(), $sql_code);


      if (!$execute_sql) {
        echo "<div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao Salvar!</strong>
            </div>
            ";
      } else {
        echo "<div class='alert alert-success alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Operação efetuada com sucesso!</strong>
            </div>
            ";
      }
      break;
    case '1':
      $idUser = $_POST["idUser"];
      $nome = $_POST['nomeUser'];
      $sobrenome = $_POST['sobrenomeUser'];
      $email = $_POST['emailUser'];
      $login = $_POST['loginUser'];
      $sexo = $_POST['sexo'];
      $telefone = $_POST["foneUser"];
      $senha = mysqli_real_escape_string(DBConecta(), $_POST['senhaprof']);
      //$senha = $_POST["senhaprof"];
      $cript = md5($senha);

      $sql_code = "UPDATE professor SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', sexo = '$sexo', login = '$login',telefone = '$telefone', senha = '$cript' WHERE idProfessor = $idUser";
      $execute_sql = mysqli_query(DBConecta(), $sql_code);


      if (!$execute_sql) {
        echo "<div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao Salvar!</strong>
            </div>
            ";
      } else {
        echo "<div class='alert alert-success alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Operação efetuada com sucesso!</strong>
            </div>
            ";
      }
      break;
    case '2':
      $nomeTurma = $_POST['nomeTurma'];
      $cursoTurma = $_POST['cursoTurma'];
      // ALTERAR COLOCAR CAMPO NOME
      $sql_code = "UPDATE turma SET idCurso = '$cursoTurma' WHERE idTurma = '$nomeTurma'";
      $execute_sql = mysqli_query(DBConecta(), $sql_code);
      if (!$execute_sql) {
        echo "<div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao Salvar!</strong>
            </div>
            ";
      } else {
        echo "<div class='alert alert-success alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Operação efetuada com sucesso!</strong>
            </div>
            ";
      }
      break;
    case '3':
      $nomeDisc = $_POST['nomeDisc'];
      $idDisc = $_POST["idDisciplina"];
      $DiscPre = $_POST["DiscPre"];
      if ($DiscPre != ""){
        $sql_code = "UPDATE disciplina SET nome = '$nomeDisc', prerequisito = $DiscPre WHERE idDisciplina = $idDisc;";
      }else{
        $sql_code = "UPDATE disciplina SET nome = '$nomeDisc' WHERE idDisciplina = $idDisc;";
      }
      $execute_sql = mysqli_query(DBConecta(), $sql_code);
      if (!$execute_sql) {
        echo "<div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao Salvar!</strong>
            </div>
            ";
      } else {
        echo "<div class='alert alert-success alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Operação efetuada com sucesso!</strong>
            </div>
            ";
      }
      break;

  }

}

if (isset($_POST['salva'])){
  $id = $_GET['id'];

  switch ($id) {
    case '0':
      $nome = $_POST['nomeUser'];
      $sobrenome = $_POST['sobrenomeUser'];
      $email = $_POST['emailUser'];
      $login = $_POST['loginUser'];
      $dataNascimento = $_POST['dataNascimento'];
      $sexo = $_POST['sexo'];
      $telefone = $_POST["foneUser"];
      $idAluno = $_POST["idUser"];
      $senha = substr($login,0,2).substr($dataNascimento,0,4);
      $cript = md5($senha);

      $sql_code = "SELECT idAluno FROM aluno WHERE nome = '$nome' AND sobrenome = '$sobrenome' AND dataNascimento = '$dataNascimento' AND email = '$email' AND login = '$login'";
      $results = mysqli_query(DBConecta(), $sql_code);
      if ($results && !mysqli_num_rows($results)){
        $sql_code = "INSERT INTO aluno (idAluno,nome, sobrenome, dataNascimento, email, sexo, login, telefone, senha) VALUES ('$idAluno','$nome','$sobrenome','$dataNascimento','$email','$sexo','$login', $telefone, '$cript')";

        $execute_sql = mysqli_query(DBConecta(), $sql_code);

        if (!$execute_sql) {
          echo "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Erro ao Salvar!</strong>
              </div>
              ";
        } else {
          echo "<div class='alert alert-success alert-dismissable my-0'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Operação efetuada com sucesso!</strong>
              </div>
              ";
        }
      }
      else{
        echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Cadastro já existente!</strong>
        </div>
        ";
      }
      break;
    case '1':
      $nome = $_POST['nomeUser'];
      $sobrenome = $_POST['sobrenomeUser'];
      $email = $_POST['emailUser'];
      $login = $_POST['loginUser'];
      $sexo = $_POST['sexo'];
      $telefone = $_POST["foneUser"];
      $senha = substr($login,0,2).substr($email,0,4);
      $cript = md5($senha);

      $sql_code = "SELECT idProfessor FROM professor WHERE nome = '$nome' AND sobrenome = '$sobrenome' AND email = '$email' AND login = '$login'";
      $results = mysqli_query(DBConecta(), $sql_code);
      if ($results && !mysqli_num_rows($results)){
        $sql_code = "INSERT INTO professor (nome, sobrenome, email, sexo, telefone, login, senha) VALUES ('$nome','$sobrenome','$email','$sexo','$telefone','$login', '$cript')";
        $execute_sql = mysqli_query(DBConecta(), $sql_code);

        if (!$execute_sql) {
          echo "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Erro ao Salvar!</strong>
              </div>
              ";
        } else {
          echo "<div class='alert alert-success alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Operação efetuada com sucesso!</strong>
              </div>
              ";
        }
      }
      else{
        echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Cadastro já existente!</strong>
        </div>
        ";
      }
      break;
    case '2':
      $nomeTurma = $_POST['nomeTurma'];
      $cursoTurma = $_POST['cursoTurma'];

      $sql_code = "SELECT idTurma FROM turma WHERE idTurma = '$nomeTurma' AND idCurso = '$cursoTurma'";
      $results = mysqli_query(DBConecta(), $sql_code);
      if ($results && !mysqli_num_rows($results)){
        if ($nomeTurma != " "){
          $sql_code = "INSERT INTO turma (idTurma, idCurso) VALUES ('$nomeTurma','$cursoTurma')";
          $execute_sql = mysqli_query(DBConecta(), $sql_code);
          if (!$execute_sql) {
            echo "<div class='alert alert-danger alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao Salvar!</strong>
                </div>
                ";
          } else {
            echo "<div class='alert alert-success alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Operação efetuada com sucesso!</strong>
                </div>
                ";
          }
        }else{
          echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Não é permitida a inserção de campos em branco. Preencha corretamente!</strong>
          </div>
          ";
        }
      }
      else{
        echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Cadastro já existente!</strong>
        </div>
        ";
      }
      break;
    case '3':
      $nomeDisc = $_POST['nomeDisc'];
      if (!isset($_POST["DiscPre"])){
        $DiscPre = "";
      }
      else{
        $DiscPre = $_POST["DiscPre"];
      }

      $sql_code = "SELECT idDisciplina FROM disciplina WHERE nome = '$nomeDisc'";
      $results = mysqli_query(DBConecta(), $sql_code);
      if ($results && !mysqli_num_rows($results)){
        if ($nomeDisc != " "){
          if ($DiscPre != ""){
            $sql_code = "INSERT INTO disciplina (nome, prerequisito) VALUES ('$nomeDisc', $DiscPre)";
          }else{
            $sql_code = "INSERT INTO disciplina (nome) VALUES ('$nomeDisc')";
          }
          $execute_sql = mysqli_query(DBConecta(), $sql_code);
          if (!$execute_sql) {
            echo "<div class='alert alert-danger alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao Salvar!</strong>
                </div>
                ";
          } else {
            echo "<div class='alert alert-success alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Operação efetuada com sucesso!</strong>
                </div>
                ";
          }
        }else{
          echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Não é permitida a inserção de campos em branco. Preencha corretamente!</strong>
          </div>
          ";
        }
      }
      else{
        echo "<div class='alert alert-warning alert-dismissable my-0 py-0'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Cadastro já existente!</strong>
        </div>
        ";
      }
      break;

  }

}

//  DEFINIÇÃO QUAL PÁGINA DE CADASTRO MOSTRAR
if (isset($_GET['id'])){
    $id = $_GET['id'];

    switch ($id) {
        case '0':
            $tit = "ALUNO";
            break;
        case '1':
            $tit = "PROFESSOR";
            break;
        case '2':
            $tit = "TURMA";
            break;
        case '3':
            $tit = "DISCIPLINA";
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
  <title>PORTAL ACADÊMICO - &nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="../img/favicon.ico" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- IMPORTAÇÃO ADMINLTE -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- CABEÇALHO -->
    <header class="main-header">
      <a href="index.php" class="logo">
      <span class="logo-mini"><img src="../img/Logo.png" alt="logo" width="30" height="30"></span>
        <span class="logo-lg"><img src="../img/Logo.png" alt="logo" width="25" height="25"> Portal Acadêmico</span>
      </a>

      <!-- MENU DISPOSITIVOS MÓVEIS -->
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- NOTIFICAÇÕES E USUÁRIOS -->
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
                    <a href="./redefineSenhaPortal.php" class="btn btn-default btn-flat">Alterar senha</a>
                  </div>
                  <div class="pull-right mx-5">
                    <a href="?deslogar" class="btn btn-default btn-flat">Sair</a>
                  </div>
                </li>
              </ul>
            </li>

            <!-- CADASTRO ADMINISTRADORES-->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- MENU LATERAL -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left">
            <i class="fa fa-user fa-3x" style="color: white;"></i>
          </div>
          <div class="pull-left info ">
            <p><?php echo $_SESSION['nome']; ?></p>
            <a href="#">
              <i class="fa fa-circle text-success"> <?php echo $_SESSION['tipo']; ?></i>
            </a>
          </div>

        </div>

        <!-- OPÇÕES DE MENU PARA CADA TIPO DE USUÁRIO -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li><a href="index.php"><i class="fa fa-home"></i> <span class="text-uppercase">Inicio</span></a></li>

          <!-- OPÇÕES APENAS DE ADMINISTRADORES -->
          <?php if ($_SESSION['tipo'] == "Administrador"){ ?>
            <li><a href="addcalendario.php"><i class="fa fa-calendar"></i> <span class="text-uppercase">Adicionar Calendario</span></a></li>
            <li class="treeview active">
              <a href="#"><i class="fa fa-plus-square"></i> <span class="text-uppercase">Cadastros</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu text-center">
                <li <?php if ($id == "0") echo "class='active'" ?>><a href="cadastro.php?id=0" class="text-uppercase">Aluno</a></li>
                <li <?php if ($id == "1") echo "class='active'" ?>><a href="cadastro.php?id=1" class="text-uppercase">Professor</a></li>
                <li <?php if ($id == "2") echo "class='active'" ?>><a href="cadastro.php?id=2" class="text-uppercase">Turma</a></li>
                <li <?php if ($id == "3") echo "class='active'" ?>><a href="cadastro.php?id=3"class="text-uppercase">Disciplina</a></li>
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

    <!--ÁREA DE CONTEÚDO-->
    <div class="content-wrapper">
      <div id="status"></div>
      <section class="content-header">
        <h1>
          CADASTRO DE <?php echo $tit; ?>
        </h1>
      </section>
      <section class="content">

        <!-- PESQUISA DE CADASTROS -->
        <div class="col-md-12">
          <div class="box box-danger container mb-3 " style="margin-bottom: 30px;">
              <div class="row">   
                <div class="col-md-3" style="margin: 15px 5px 10px;">
                  <input type="text" class="form-control" placeholder="Nome" id="buscaNome" />
                </div>
               
                <!-- CADASTROS DE PROFESSORES OU ALUNOS -->
                <?php if($id < "2"){ ?>
                  <div class="col-md-3" style="margin: 15px 5px 10px;">
                    <input type="text" class="form-control" placeholder="Sobrenome" id="buscaSobre"/>
                  </div>
                  <div class="col-md-3" style="margin: 15px 5px 10px;">
                    <input type="text" class="form-control" placeholder= "ID/Matricula" id = "buscaID"/>
                  </div>
                <?php } ?>
                
                <div class="col-md-6">
                  <div class="box-footer ">
                    <button type="button" class="btn btn-primary" id="btn-busca" onclick="RealizaPesquisa()" style="margin: 2px 5px;">Buscar <?php echo $tit; ?></button>
                    <button type="button" class="btn btn-warning" id="btn-edit"  onclick="LiberaEdicao()" style="margin: 2px 5px;">Editar Cadastro</button>
                    <button type="button" class="btn btn-danger" id="btn-remove" onclick="remove()" style="margin: 2px 5px;">Excluir Cadastro</button>
                  </div>  
                </div>
              </div>
          </div>
        </div>

        <!-- FORMULARIO DE CADASTRO/EDIÇÃO/EXIBIÇÃO -->
        <div class="col-md-12">
            <div class="box box-primary">
              <form role="form" action="" method="POST" id="form-cadastro">
                <div class="box-body">

                  <!-- CADASTRO DE ALUNO OU PROFESSOR -->
                  <?php if ($id < "2"){ ?>
                    <div class="form-group col-md-6">
                      <label for="nomeUser">Nome</label>
                      <input type="text" class="form-control" id="nomeUser" name="nomeUser" placeholder="Nome" required/>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="sobrenomeUser">Sobrenome</label>
                      <input type="text" class="form-control" id="sobrenomeUser" name="sobrenomeUser" placeholder="Sobrenome" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="emailUser">Email</label>
                      <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Email" required>
                    </div>

                    <!-- CADASTRO ESPECIFICO DE ALUNO -->
                    <?php if ($id == '0'){ ?>
                      <div class="form-group col-md-3">
                        <label for="matriUser">Data de Nascimento</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" required>
                      </div>
                    <?php } ?>

                    <div class="form-group col-md-6">
                      <label for="foneUser">Telefone</label>
                      <input type="text" class="form-control" id="foneUser" name = "foneUser" placeholder="Telefone" required>
                    </div>
                    <div class="form-group col-md-3" >
                      <label>Sexo: </label>
                      <div class="radio">
                        <label style="margin-right: 5px;">
                          <input type="radio" id="masculino" value="Masculino" name="sexo" >
                          Masculino
                        </label>
                        <label>
                          <input type="radio" id="feminino" value="Feminino" name="sexo">
                          Feminino
                        </label>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="loginUser">Login</label>
                      <input type="text" class="form-control" id="loginUser" name="loginUser" placeholder="Login" required>
                    </div>
                    <div class="form-group col-md-4" id ="idMatricula">
                      <label for="loginUser">ID/Matricula*</label>
                      <input type="text" class="form-control" id="idUser" name="idUser" placeholder="ID" <?php if($id == "0") echo "required";?>>
                    </div>
                    </div>
                  <?php }

                  // CADASTRO DE TURMAS
                  elseif($id == "2"){ ?>
                    <div class="form-group col-md-12">
                      <label for="nomeTurma">Nome da Turma</label>
                      <input type="text" class="form-control" id="nomeTurma" name="nomeTurma" placeholder="Turma" required />
                    </div>
                    <div class="form-group col-md-12">
                      <label>Curso</label>
                      <select class="form-control" name="cursoTurma">
                        <option value="" id="0">Selecione um curso</option>
                        <option value="1" id="1">Técnico em Informática</option>
                        <option value="2" id="2">Técnico em Secretariado</option>
                        <option value="3" id="3">Técnico em Contabilidade</option>
                      </select>
                    </div>

                  <?php }
                  
                  // CADASTRO DE DISCIPLINAS
                  elseif($id == "3"){ ?>
                    <div class="form-group col-md-6">
                      <label for="nomeDisc">Nome da Disciplina</label>
                      <input type="text" class="form-control" id="nomeDisc" name="nomeDisc" placeholder="Disciplina" required/>
                    </div>
                    <div class="checkbox col-md-2 form-group" style="margin-top: 30px;">
                      <label>
                        <input type="checkbox" name="prerequisito" id="prerequisito" onclick="habilitaSelect()"> *Pré-requisito
                      </label>
                    </div>
                    <div class="form-group col-md-4">
                      <label>*Disciplina que tranca</label>
                      <select class="form-control" name="DiscPre" id="DiscPre">
                          <option value=""></option>
                        <?php
                          $query = BuscaRetornaQuery($conexao, "disciplina");
                          if ($query){
                            while ($disciplinas = mysqli_fetch_assoc($query)){
                              echo "<option value=".$disciplinas["idDisciplina"].">".$disciplinas["nome"]."</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-12" id="divId">
                      <label for="idDisciplina">ID/Matricula</label>
                      <input type="text" class="form-control" id="idDisciplina" name="idDisciplina" placeholder="ID">
                    </div>
                <?php } ?>

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="salva" id="btn-salva" style="margin-right: 5px;">Salvar</button>
                  <button type="submit" class="btn btn-primary" name="edita" id="btn-edita" style="margin-right: 5px;">Salvar Edição</button>
                  <a href="cadastro.php?id=<?php echo $id; ?>" class="btn btn-light" id="btn-cancela">Cancelar</a>
                </div>
              </form>
            </div>
        </div>
      </section>
    
      <!-- TABELA DE EXIBIÇÃO COM TODAS AS DISCIPLINAS E TURMAS -->
      <?php if($id > "1"){ ?>
        <section class="content">
          <div class="row">

            <!-- DISCIPLINAS -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title text-uppercase">Disciplinas Cadastradas</h3>
                </div>
                <div class="box-body table-responsive ">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Disciplina</th>
                        <th>Pré-Requisito(ID)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query = BuscaRetornaQuery($conexao, "disciplina");
                        if ($query){
                          while ($disciplinas = mysqli_fetch_assoc($query)){
                            if ($disciplinas["prerequisito"]){
                              $nomeDisciplinaPreRequisito = BuscaRetornaResponse($conexao, "disciplina", "idDisciplina", $disciplinas["prerequisito"]);
                              echo "<tr><td>".$disciplinas["idDisciplina"]."</td><td>".$disciplinas["nome"]."</td><td>".$nomeDisciplinaPreRequisito["nome"]."</td></tr>";
                            }
                            else 
                              echo "<tr><td>".$disciplinas["idDisciplina"]."</td><td>".$disciplinas["nome"]."</td><td>-</td></tr>";
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- TURMAS -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title text-uppercase">Turmas Cadastradas</h3>
                </div>
                <div class="box-body table-responsive ">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Turma</th>
                        <th>Curso</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query = BuscaRetornaQuery($conexao, "turma");
                        if ($query){
                          while ($turma = mysqli_fetch_assoc($query)){
                            $nomeCurso = BuscaRetornaResponse($conexao, "curso", "idCurso", $turma["idCurso"]);
                            echo "<tr><td>".$turma["idTurma"]."</td><td>".$nomeCurso["nome"]."</td></tr>";
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </section>
      <?php }?>
    </div>

  <!-- RODAPÉ -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <i>Todos os direitos reservados</i>
    </div>
    <strong>Copyright &copy; 2019 Guilherme Selair</strong>
  </footer>

  <!-- SCRIPTS DE AUTOMATIZAÇÃO DA PÁGINA -->
  <script type="text/javascript">

    $(document).ready(function(){
      //  OCULTA BOTÕES
      $('#btn-edita').hide();
      $('#btn-edit').hide();
      $('#btn-remove').hide();
      <?php if($id == "1"){ ?>
        $("#idMatricula").hide();
      <?php }if($id == "3"){ ?>
        $("#divId").hide();
        document.querySelector("#DiscPre").disabled = true;
      <?php } ?>
      
      //  HABILITA O BOTÃO SALVA
      $('#salva').show();
    })

    //  REALIZA BUSCA E EXIBE NOS INPUTS
    function RealizaPesquisa(){
      
      const buscaNome = document.querySelector("#buscaNome").value;
      <?php if ($id < '2'){ ?>
        const buscaSobre = document.getElementById("buscaSobre").value;
        const buscaID = document.querySelector("#buscaID").value;
      <?php } ?>

      if (buscaNome){
        DesabilitaHabilitaCampos(true, 0)

        //  REQUISIÇÃO AJAX
        $.ajax({
          type: "POST",
          dataType:"json",
          url: "buscador.php",
          data: 'tabela_ID='+<?php echo $id; ?>+'&nome='+buscaNome<?php if ($id < '2') echo "+'&sobrenome='+buscaSobre,"; else echo",";?>
          success: function(results){
            if (results){
              //  HABILITA BOTÕES DE EDIÇÃO
              $('#btn-edit').show();
              $('#btn-remove').show();

              //  INSERE INFORMAÇÕES NOS CAMPOS ALUNOS E PROFESSORES
              <?php if($id < '2'){ ?>
                document.getElementById("nomeUser").value = results["nome"]
                document.getElementById("sobrenomeUser").value = results["sobrenome"]
                if (results["email"] != "NULL")
                  document.getElementById("emailUser").value = results["email"]
                if (results["dataEntrada"] != "NULL" && <?php echo $id; ?> != '1')
                  document.getElementById("dataNascimento").value = results["dataNascimento"]
                document.getElementById("foneUser").value = results["telefone"]
                document.getElementById("loginUser").value = results["login"]
                <?php if ($id == "0"){ ?>
                  document.getElementById("idUser").value = results["idAluno"]
                <?php }else{ ?>
                  document.getElementById("idUser").value = results["idProfessor"]
                <?php } ?>
                if (results["sexo"] == "Masculino") document.getElementById("masculino").checked = true;
                else document.getElementById("feminino").checked = true;
              <?php }

              //  INSERE INFORMAÇÕES NOS CAMPOS DE TURMA
              elseif($id == "2"){ ?>
                document.getElementById("nomeTurma").value = results["idTurma"];
                document.getElementById(results["idCurso"]).selected = true;
              <?php }
              
              //  INSERE INFORMAÇÕES NOS CAMPOS DE DISCIPLINAS
              else{ ?>
                document.getElementById("idDisciplina").value = results["idDisciplina"];
                document.getElementById("nomeDisc").value = results["nome"];
                if (results["prerequisito"] == null){
                  document.getElementById("DiscPre").value = "";
                  document.getElementById("DiscPre").disabled = true;
                }
                else{
                  document.getElementById("DiscPre").value = results["prerequisito"];
                  document.getElementById("prerequisito").checked = true;
                }
              <?php } ?>
            }
          }
        })
        buscaNome.value = "";
        <?php if ($id < '2'){ ?>
          buscaSobre.value = "";
        <?php } ?>
      }
      
    }

    //  DESABILITA CAMPOS DE ACORDO COM PARAMETROS
    function DesabilitaHabilitaCampos(opcao, tipo){
      const btnSalva = document.getElementById("btn-salva")
      const btnCancela = document.getElementById("btn-cancela")
      const btnEdita = document.getElementById("btn-edita")
      const formID = document.querySelectorAll("#form-cadastro [id]")

      formID.forEach(function(elemento, index){
        elemento.disabled = opcao
      });
      if (tipo == 0){
        btnSalva.disabled = opcao
        btnCancela.disabled = opcao
      }
      if (tipo == "editar"){
        btnEdita.disabled = opcao
        btnCancela.disabled = opcao
      }
      if (tipo == "limpa"){
        $("#form-cadastro").each(function(){
          this.reset();
        })
      }
    }

    //  LIBERA BOTÕES PARA EDIÇÃO
    function LiberaEdicao(){
      DesabilitaHabilitaCampos(false, "editar")
      $('#btn-edita').show();
      $("#btn-salva").hide();
      $("#idMatricula").hide();
      document.querySelector("#DiscPre").disabled = true;
    }

    function habilitaSelect(){
      const disciplinaPreRequisito = document.querySelector("#DiscPre")
      if (disciplinaPreRequisito.disabled == false){
        disciplinaPreRequisito.disabled = true;
      }
      else{
        disciplinaPreRequisito.disabled = false;
      }
    }

    function remove(){
      <?php if ($id < 2){ ?>
        let idCadastro = $("#idUser").val();
      <?php }elseif($id == 2){ ?>
        let idCadastro = $("#nomeTurma").val();
      <?php  }else{ ?>
        let idCadastro = $("#idDisciplina").val();
      <?php } ?>
      console.log(idCadastro);
      $.ajax({
        type: "POST",
        url: "deleteCadastro.php",
        data: "idCadastro="+idCadastro+"&idTabela=<?php echo $id; ?>",
        beforeSend: function(){
          $("#remove").html("Apagando...");
        },
        success: function(html){
          $("#status").html(html);
          $("#remove").html("Excluir Cadastro");
          desabilita(false,"limpa");
        }
      })

    }

  </script>


  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>
