<?php 

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if (!isset($_SESSION["id"])){
    header("location: ./loginUser.php");
}

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


?>