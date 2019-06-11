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
    $linha = mysqli_num_rows($results);
    echo $linha;
    if ($linha > 0){
        while($idTurmas = mysqli_fetch_assoc($results)){
            $AllTurmas[] = $idTurmas["idTurma"];
        }
        for ($i = 0; $i < count($AllTurmas); $i++){
          $sql_code = "SELECT * FROM `turma` WHERE `idTurma`= $AllTurmas[$i]";
          $results = mysqli_query($conexao, $sql_code);
          if (mysqli_num_rows($results)){
            echo "<option value=''>Selecione abaixo</option>";
            $nameTurma = mysqli_fetch_assoc($results);
            //$AllNameTurmas[] = $nameTurma; 
            echo "<option value='".$nameTurma["idTurma"]."'>".$nameTurma["idTurma"]."</option>";
          }
        }
    }    

}

if (isset($_POST["idTurma"]) && !empty($_POST["idTurma"])){
    

}


?>