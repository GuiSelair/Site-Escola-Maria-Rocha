<?php
session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("../conexao/function.php");


if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

// FUNÇÃO BUSCA AS TURMAS QUE POSSUAM UMA DETERMINADA DISCIPLINA E PROFESSOR. RETORNE O NOME DA TURMA PARA SER EXIBIDO
if (isset($_POST["idDisciplina"]) && !isset($_POST["idTurma"])){
    $conexao = DBConecta();
    $idDisciplina = $_POST["idDisciplina"];
    $idProfessor = $_SESSION["id"];
    $AllTurmas = [];
    $sql_code = "SELECT `idTurma` FROM `turma-professor` WHERE `idDisciplina`= $idDisciplina AND `idProfessor` = $idProfessor";
    $results = mysqli_query($conexao, $sql_code);
    if (mysqli_num_rows($results)){
        while($idTurmas = mysqli_fetch_assoc($results)){
          if (!in_array($idTurmas["idTurma"], $AllTurmas)){
            $AllTurmas[] = $idTurmas["idTurma"];
          }
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
if (isset($_POST["idTurma"]) && isset($_POST["idDisciplina"])){
  $conexao = DBConecta();
  $idDisciplina = $_POST["idDisciplina"];
  $idTurma = $_POST["idTurma"];
  echo "<option value=''>Selecione abaixo</option>";

  // BUSCANDO ALUNOS DA TURMA SELECIONA
  $sql_code = "SELECT `idAluno` FROM `turma-aluno` WHERE `idTurma` = $idTurma";
  $query = mysqli_query($conexao, $sql_code);
  if (mysqli_num_rows($query)){
    $prerequisito = VerificaPrerequisito($conexao, $idDisciplina);

    //  PERCORRE TODOS OS ALUNOS DA TURMA
    while($idAluno = mysqli_fetch_assoc($query)){
      //  EXISTE PREREQUISITO PARA A DISCIPLINA
      if($prerequisito){
        $conferePrerequisito = ConfereAprovacao($conexao, $prerequisito["prerequisito"], $idAluno["idAluno"]);
        if ($conferePrerequisito && $conferePrerequisito["conceitoDisciplina"] == "APTO"){
          $confereDisciplinaAtual = ConfereAprovacao($conexao, $idDisciplina, $idAluno["idAluno"]);
          if ($confereDisciplinaAtual && $confereDisciplinaAtual["conceitoDisciplina"] != "APTO"){
            $nomeAluno = BuscaNomes($conexao, $idAluno["idAluno"], "aluno", "idAluno");
            echo "<option value='".$nomeAluno["idAluno"]."'>".$nomeAluno["idAluno"]." - ".$nomeAluno["nome"]." ".$nomeAluno["sobrenome"]."</option>";
          }
        }
      }
      // NÃO EXISTE PREREQUISITOS PARA A DISCIPLINA
      else{
        $confereDisciplinaAtual = ConfereAprovacao($conexao, $idDisciplina, $idAluno["idAluno"]);
        if ($confereDisciplinaAtual["conceitoDisciplina"] != "APTO"){
          $nomeAluno = BuscaNomes($conexao, $idAluno["idAluno"], "aluno", "idAluno");
          echo "<option value='".$nomeAluno["idAluno"]."'>".$nomeAluno["idAluno"]." - ".$nomeAluno["nome"]." ".$nomeAluno["sobrenome"]."</option>";
        }
      }
    }
  }
}



?>

