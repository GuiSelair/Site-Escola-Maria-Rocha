<?php

////////////////////////////////
////    REMOVE CADASTROS    ////
///////////////////////////////

session_start();

include_once("../conexao/config.php");
include_once("../conexao/conexao.php");
include_once("../../conexao/function.php");

if (!isset($_SESSION["id"])){
  header("location: ../loginUser.php");
}

// FUNÇÃO DELETA O CADASTRO DE ALUNO, PROFESSOR, TURMA OU DISCIPLINA
if (isset($_POST["idCadastro"]) && isset($_POST["idTabela"])){
    $conexao = DBConecta();
    $idCadastro = $_POST["idCadastro"];
    $idTabela = $_POST["idTabela"];

    switch ($idTabela) {
        case "0":
            $sql_code = "DELETE FROM `aluno` WHERE `idAluno` = '$idCadastro'";
            $results = mysqli_query($conexao, $sql_code);
            if ($results){
                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Cadastro removido com sucesso!</strong>
                </div>";
            }
            else{
                echo "<div class='alert alert-danger alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao remover o cadastro! Verifique sua conexão ou tente mais tarde!</strong>
                </div>";
            }
            break;
        case "1":
            $sql_code = "DELETE FROM `professor` WHERE `idProfessor` = $idCadastro";
            $results = mysqli_query($conexao, $sql_code);
            if ($results){
                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Cadastro removido com sucesso!</strong>
                </div>";
            }
            else{
                echo "<div class='alert alert-danger alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao remover o cadastro! Verifique sua conexão ou tente mais tarde!</strong>
                </div>";
            }
            break;
        case "2":
            $sql_code = "DELETE FROM `turma` WHERE `idTurma` = $idCadastro";
            $results = mysqli_query($conexao, $sql_code);
            if ($results){
                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Cadastro removido com sucesso!</strong>
                </div>";
            }
            else{
                echo "<div class='alert alert-danger alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao remover o cadastro! Verifique sua conexão ou tente mais tarde!</strong>
                </div>";
            }
            break;
        case "3":
            $sql_code = "DELETE FROM `disciplina` WHERE `idDisciplina` = $idCadastro";
            $results = mysqli_query($conexao, $sql_code);
            if ($results){
                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Cadastro removido com sucesso!</strong>
                </div>";
            }
            else{
                echo "<div class='alert alert-danger alert-dismissable' style='margin-bottom: 0px;'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Erro ao remover o cadastro! Verifique sua conexão ou tente mais tarde!</strong>
                </div>";
            }
            break;
        default:
            header("location: ./loginUser.php");
            break;
    }
}

?>
