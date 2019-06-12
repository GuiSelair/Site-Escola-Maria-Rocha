<?php
session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}


if (isset($_POST["idDisciplina"])){
    $conexao = DBConecta();
    $idDisciplina = $_POST["idDisciplina"];
    $idProfessor = $_SESSION["id"];
    $sql_code = "SELECT `idTurma` FROM `turma-professor` WHERE `idDisciplina`= $idDisciplina AND `idProfessor` = $idProfessor";
    $results = mysqli_query($conexao, $sql_code);
    if (mysqli_num_rows($results)){
        while($idTurmas = mysqli_fetch_assoc($results)){
            $AllTurmas[] = $idTurmas["idTurma"];
        }
        echo "<option value=''>Selecione abaixo</option>";
        for ($i = 0; $i < count($AllTurmas); $i++){
          $sql_code = "SELECT * FROM `turma` WHERE `idTurma`= $AllTurmas[$i]";
          $results = mysqli_query($conexao, $sql_code);
          if (mysqli_num_rows($results)){
            $nameTurma = mysqli_fetch_assoc($results);
            //$AllNameTurmas[] = $nameTurma; 
            echo "<option value='".$nameTurma["idTurma"]."'>".$nameTurma["idTurma"]."</option>";
          }
        }
    }    

}

if (isset($_POST["idTurma"])){
    $conexao = DBConecta();
    $idTurma = $_POST["idTurma"];
    $sql_code = "SELECT `idAluno` FROM `turma-aluno` WHERE `idTurma` = $idTurma";
    $results = mysqli_query($conexao, $sql_code);
    if (mysqli_num_rows($results)){
      while($idAlunos = mysqli_fetch_assoc($results)){
        $AllAlunos[] = $idAlunos["idAluno"];
      }
      echo "<option value=''>Selecione abaixo</option>";
      for ($i = 0; $i < count($AllAlunos); $i++){
        $sql_code = "SELECT * FROM `aluno` WHERE `idAluno`= $AllAlunos[$i]";
        $results = mysqli_query($conexao, $sql_code);
        if (mysqli_num_rows($results)){
          $nameAluno = mysqli_fetch_assoc($results);
          //$AllNameTurmas[] = $nameTurma; 
          echo "<option value='".$nameAluno["idAluno"]."'>".$nameAluno["nome"]." ".$nameAluno["sobrenome"]."</option>";
        }
      }

    }
}

if (isset($_POST["mensao"]) && isset($_POST["idAluno"])){
  $conexao = DBConecta();
  $idTurma = $_POST["idTurma"];
  $idDisciplina = $_POST["idDisciplina"];
  $idAluno = $_POST["idAluno"];
  $mensao = $_POST["mensao"];
  $final = $_POST["final"];
  $data = $_POST["data"];


  $sql_code = "INSERT INTO `avalhacao`(`idDisciplina`, `idTurma`, `idAluno`, `conceito`, `final`, `data`) VALUES ($idDisciplina,$idTurma,$idAluno,'$mensao',$final, '$data')";
  $results = mysqli_query($conexao, $sql_code);
  
  //if ($results){
  
    $sql_code = "SELECT nome FROM aluno WHERE idAluno = $idAluno";
    $results1 = mysqli_query($conexao, $sql_code);
    $nomeAluno = mysqli_fetch_assoc($results1);
    $sql_code = "SELECT nome FROM disciplina WHERE idDisciplina = $idDisciplina";
    $results1 = mysqli_query($conexao, $sql_code);
    $nomeDisciplina = mysqli_fetch_assoc($results1);
    echo "<tr><th>Aluno</th><th>Disciplina</th><th>Turma</th><th>Data da Avaliação</th><th>Mensão</th></tr><tr><td>".$nomeAluno["nome"]."</td><td>".$nomeDisciplina["nome"]."</td><td>".$idTurma."</td><td>".$data."</td><td><span class='label label-success'>".$mensao."</span></td></tr>";    

  //}
  //else{
  //  echo "<p>NÂO DEU</p>";
  //}*/
}


?>