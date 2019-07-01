<?php
session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");


if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

// FUNÇÃO BUSCA AS TURMAS QUE POSSUAM UMA DETERMINADA DISCIPLINA E PROFESSOR. RETORNE O NOME DA TURMA PARA SER EXIBIDO
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

//FUNÇÃO BUSCA ALUNOS DE UMA DETERMINADA TURMA. RETORNE O ID DO ALUNO E O NOME COMPLETO PARA SER EXIBIDO
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
          echo "<option value='".$nameAluno["idAluno"]."'>".$nameAluno["idAluno"]." - ".$nameAluno["nome"]." ".$nameAluno["sobrenome"]."</option>";
        }
      }

    }
}



?>