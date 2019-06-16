<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

// FUNÇÃO EXCLUIR NOTA DE ALUNO
if (isset($_GET["idAvalhacao"])){
    $conexao = DBConecta();
    $idAvalhacao = $_GET["idAvalhacao"];

    $sql_code = "DELETE FROM `avalhacao` WHERE `idAvalhacao`= $idAvalhacao";
    $results = mysqli_query($conexao, $sql_code);
    if ($results){
        header("location: ./notas.php");
    }
    else{
        echo "<script><alert>ERRO AO APAGAR NOTA! VERIFIQUE SUA CONEXÃO OU TENTE MAIS TARDE!</alert></script>";
    }
}


// FUNÇÃO EXCLUI MATRICULA DE ALUNO
if (isset($_POST["idTurma"]) && isset($_POST["idAluno"]) && isset($_POST["semestre"])){
    $conexao = DBConecta();
    $idTurma = $_POST["idTurma"];
    $idAluno = $_POST["idAluno"];
    $data = $_POST["semestre"];

    $sql_code = "DELETE FROM `turma-aluno` WHERE `idTurma` = $idTurma AND `idAluno`= $idAluno AND `dataMatricula` = '$data'";
    $results = mysqli_query($conexao, $sql_code);
    if ($results){
      echo "<div class='alert alert-success alert-dismissable'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Matricula removida com sucesso! Click no botão ATUALIZAR!</strong>
      </div>";
    }else{
      echo "<div class='alert alert-danger alert-dismissable'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Erro ao remover o matricula! Verifique sua conexão ou tente mais tarde!</strong>
      </div>";
    }
}

// FUNÇÃO EXCLUI MATRICULA DE PROFESSOR AS TURMAS E DISCIPLINAS
if (isset($_POST["idTurma"]) && isset($_POST["idProfessor"]) && isset($_POST["semestre"]) && isset($_POST["idDisciplina"])){
    if (!empty($_POST["idTurma"]) && !empty($_POST["idProfessor"]) && !empty($_POST["semestre"]) && !empty($_POST["idDisciplina"])){
        $conexao = DBConecta();
        $idTurma = $_POST["idTurma"];
        $idProfessor = $_POST["idProfessor"];
        $data = $_POST["semestre"];
        $idDisciplina = $_POST["idDisciplina"];

        $sql_code = "DELETE FROM `turma-professor` WHERE `idTurma` = $idTurma AND `idProfessor`= $idProfessor AND `dataMatricula` = '$data' AND `idDisciplina` = $idDisciplina";
        $results = mysqli_query($conexao, $sql_code);

        if ($results){
            echo "<div class='alert alert-success alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Matricula removida com sucesso! Click no botão ATUALIZAR!</strong>
            </div>";
        }
        else{
            echo "<div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao remover o matricula! Verifique sua conexão ou tente mais tarde!</strong>
            </div>";
        }
    }
}

?>
