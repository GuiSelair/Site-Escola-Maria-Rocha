<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
  header("location: ./loginUser.php");
}


if (isset($_POST["idCadastro"]) && isset($_POST["idTabela"])){
    $idCadastro = $_POST["idCadastro"];
    echo $idCadastro;
    $idTabela = $_POST["idTabela"];
    echo $idTabela;
    $conexao = DBConecta();

    
    $sql_code = "DELETE FROM `aluno` WHERE `idAluno` = $idCadastro";
    $results = mysqli_query($conexao, $sql_code);
    if ($results){
        echo "<div class='alert alert-success alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Cadastro removido com sucesso!</strong>
        </div>";
    }
    else{
        echo "ERRO!";
    }
    

}

?>