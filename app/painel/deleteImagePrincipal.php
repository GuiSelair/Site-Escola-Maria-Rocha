<?php

//////////////////////////////////////
//// DELETE DE IMAGENS PRINCIPAIS ////
//////////////////////////////////////

session_start();

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

if (isset($_GET["id"])){
    $id_post = $_GET['id'];
    $sql = mysqli_query(DBConecta(), "SELECT nome FROM imagens WHERE id = '$id_post'");
    $row = mysqli_fetch_assoc($sql);
    $nome = "../Galeria/".$row['nome'];
    // APAGA O RESPECTIVO ARQUIVO DA IMAGEM DA PASTA GALERIA
    if (unlink($nome)){
        $sql_code = "DELETE FROM imagens WHERE id = '$id_post'";
        $sql_query = mysqli_query(DBConecta(), $sql_code);

        if ($sql_query) {
            header("location: uploadgal.php");
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                <strong>Erro ao deletar a imagem</strong> 
                </div>";
        }
    }  
    else{
        echo "<div class='alert alert-danger alert-dismissable'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
                <strong>Erro ao deletar a imagem</strong> 
                </div>";
    }
}

?>