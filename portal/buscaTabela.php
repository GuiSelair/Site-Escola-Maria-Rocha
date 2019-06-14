<?php
session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

// FUNÇÃO BUSCA NOTA DE ALUNOS E RETORNA LINHAS PARA SEREM MOSTRADAS NA TABELA
if (isset($_POST["idDisciplina"]) && isset($_POST["idTurma"]) && isset($_POST["data"])){
    $conexao = DBConecta();
    $idDisciplina = $_POST["idDisciplina"];
    $idTurma = $_POST["idTurma"];
    $data = $_POST["data"];


    $sql_code = "SELECT nome FROM disciplina WHERE idDisciplina = $idDisciplina";
    $results = mysqli_query($conexao, $sql_code);
    $nomeDisciplina = mysqli_fetch_assoc($results);

    $sql_code = "SELECT * FROM `avalhacao` WHERE `idDisciplina`= $idDisciplina AND `idTurma`= $idTurma AND`data`= '$data'";
    $results = mysqli_query($conexao, $sql_code);
    if (mysqli_num_rows($results)){
      while ($notas = mysqli_fetch_assoc($results)){
        $idAluno = $notas["idAluno"];
        $sql_code = "SELECT nome, sobrenome FROM aluno WHERE idAluno = $idAluno";
        $results1 = mysqli_query($conexao, $sql_code);
        $nomeAluno = mysqli_fetch_assoc($results1);
        $nomeCompleto = $nomeAluno["nome"]." ".$nomeAluno["sobrenome"];
        $dataNova = date("d/m/Y", strtotime($data));

        if ($notas["conceito"] == "Apto")
          echo "<tr><td>".$nomeCompleto."</td><td>".$nomeDisciplina["nome"]."</td><td>".$idTurma."</td><td>".$dataNova."</td><td><span class='label label-success'>".$notas["conceito"]."</span></td><td><a class='btn btn-danger' href='deleteNota.php?idAvalhacao=".$notas["idAvalhacao"]."'><i class='fa fa-trash'></i>Excluir</a></td></tr>";
        else
          echo "<tr><td>".$nomeCompleto."</td><td>".$nomeDisciplina["nome"]."</td><td>".$idTurma."</td><td>".$dataNova."</td><td><span class='label label-danger'>".$notas["conceito"]."</span></td><td><a class='btn btn-danger' href='deleteNota.php?idAvalhacao=".$notas["idAvalhacao"]."'><i class='fa fa-trash'></i>Excluir</a></td></tr>";


      }
    }
}

// FUNÇÃO BUSCA MATRICULAS DE ALUNOS NAS TURMAS E RETORNA LINHAS PARA SEREM MOSTRADAS NA TABELA
if (isset($_POST["idTurma"]) && isset($_POST["semestre"])){
  $idTurma = $_POST["idTurma"];
  $semestre = $_POST["semestre"];
  $data = date("Y").".0".$semestre;
  $conexao = DBConecta();

  $sql_code = "SELECT * FROM `turma-aluno` WHERE `idTurma`= $idTurma AND `dataMatricula`= '$data' ";
  $results = mysqli_query($conexao, $sql_code);

  if (mysqli_num_rows($results)){
    while ($matricula = mysqli_fetch_assoc($results)){
      $idAluno = $matricula["idAluno"];
      $sql_code = "SELECT nome, sobrenome FROM aluno WHERE idAluno = $idAluno";
      $results1 = mysqli_query($conexao, $sql_code);
      $nomeAluno = mysqli_fetch_assoc($results1);
      $nomeCompleto = $nomeAluno["nome"]." ".$nomeAluno["sobrenome"];

      echo "<tr><td>".$nomeCompleto."</td><td>".$idTurma."</td><td>".$data."</td><td><a class='btn btn-danger' id='apaga' onclick='apaga($idTurma,$idAluno, $data)'><i class='fa fa-trash'></i>Excluir</a></td></tr>";
    }
  }
}

?>
