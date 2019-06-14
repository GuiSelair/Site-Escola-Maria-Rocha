<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

if (isset($_POST["mensao"]) && isset($_POST["idAluno"]) && isset($_POST["idDisciplina"]) && isset($_POST["final"]) && isset($_POST["idTurma"])){
    $conexao = DBConecta();
    $idTurma = $_POST["idTurma"];
    $idDisciplina = $_POST["idDisciplina"];
    $idAluno = $_POST["idAluno"];
    $mensao = $_POST["mensao"];
    $final = $_POST["final"];
    $data = $_POST["data"];

    $sql_code = "INSERT INTO `avalhacao`(`idDisciplina`, `idTurma`, `idAluno`, `conceito`, `final`, `data`) VALUES ($idDisciplina,$idTurma,$idAluno,'$mensao',$final, '$data')";
    $results = mysqli_query($conexao, $sql_code);
    
    if ($results){
        if ($final != "0"){
            $sql_code = "INSERT INTO `aluno-disciplina`(`idAluno`, `idDisciplina`, `conceito`) VALUES ($idAluno,$idDisciplina,'$mensao')";
            $results = mysqli_query($conexao, $sql_code);
        }
    
        $sql_code = "SELECT nome, sobrenome FROM aluno WHERE idAluno = $idAluno";
        $results = mysqli_query($conexao, $sql_code);
        $nomeAluno = mysqli_fetch_assoc($results);

        $sql_code = "SELECT nome FROM disciplina WHERE idDisciplina = $idDisciplina";
        $results = mysqli_query($conexao, $sql_code);
        $nomeDisciplina = mysqli_fetch_assoc($results);

        $dataNova = date("d/m/Y", strtotime($data));
        $nomeCompleto = $nomeAluno["nome"]." ".$nomeAluno["sobrenome"];

        $sql_code = "SELECT `idAvalhacao` FROM `avalhacao` WHERE `idDisciplina` = $idDisciplina AND `idAluno` = $idAluno AND `data` = '$data'";
        $results = mysqli_query($conexao, $sql_code);
        $idAvalhacao = mysqli_fetch_assoc($results);

        if ($mensao == "Apto")
            echo "<tr><td>".$nomeCompleto."</td><td>".$nomeDisciplina["nome"]."</td><td>".$idTurma."</td><td>".$dataNova."</td><td><span class='label label-success'>".$mensao."</span></td><td><a class='btn btn-danger' href='deleteNota.php?idAvalhacao=".$idAvalhacao["idAvalhacao"]."'><i class='fa fa-trash'></i>Excluir</a></td></tr>";    
        else
            echo "<tr><td>".$nomeCompleto."</td><td>".$nomeDisciplina["nome"]."</td><td>".$idTurma."</td><td>".$dataNova."</td><td><span class='label label-danger'>".$mensao."</span></td><td><a class='btn btn-danger' href='deleteNota.php?idAvalhacao=".$idAvalhacao["idAvalhacao"]."'><i class='fa fa-trash'></i>Excluir</a></td></tr>";    



    }
}

if (isset($_POST["idTurma"]) && isset($_POST["idAluno"])){
    $conexao = DBConecta();
    $idTurma = $_POST["idTurma"];
    $idAluno = $_POST["idAluno"];

    $sql_code = "INSERT INTO `turma-aluno`(`idTurma` `idAluno`) VALUES ($idTurma,$idAluno)";
    $results = mysqli_query($conexao, $sql_code);
    
    if ($results){
    
        $sql_code = "SELECT nome, sobrenome FROM aluno WHERE idAluno = $idAluno";
        $results = mysqli_query($conexao, $sql_code);
        $nomeAluno = mysqli_fetch_assoc($results);

        $nomeCompleto = $nomeAluno["nome"]." ".$nomeAluno["sobrenome"];

        echo "<tr><td>".$nomeCompleto."</td><td>".$idTurma."</td><td><a class='btn btn-danger' href='deleteNota.php?idTurma=".$idTurma."&idAluno=".$idAluno."'><i class='fa fa-trash'></i>Excluir</a></td></tr>";    
    }

}

?>