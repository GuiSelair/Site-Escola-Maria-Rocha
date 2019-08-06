<?php

///////////////////////////////////////////////
////  DELETE NOTICIA E IMAGEM DE NOTICIA   ////
///////////////////////////////////////////////

session_start();

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

if (isset($_GET["id"])){
    $error = false;
    $id_post = $_GET['id'];
    $conexao = DBConecta();
    $sql = mysqli_query($conexao, "SELECT * FROM mr_posts WHERE id = '$id_post'");
    $results = mysqli_fetch_assoc($sql);
    // CASO A NOTICIA NÃO TENHA IMAGEM DE CAPA
    if (!mysqli_num_rows($sql) || !isset($results["thumbnail"]) || !isset($results["arquivo"])){
        $sql_code = "DELETE FROM mr_posts WHERE id = '$id_post'";
        $sql_query = mysqli_query($conexao, $sql_code) or die("Erro");
    }
    else{
        if (isset($results["thumbnail"])){
            $imagePath = "../Galeria/".$results['thumbnail'];
            if (!unlink($imagePath))
                $error = true;
        }
        if (isset($results["arquivo"]) && !$error){
            $arquivoPath = "../arquivo/".$results['arquivo'];
            if (!unlink($arquivoPath))
                $error = true;
        }        
        if (!$error){        
            $sql_code = "DELETE FROM mr_posts WHERE id = '$id_post'";
            $sql_query = mysqli_query($conexao, $sql_code) or die("Erro");
        }
    }
    if ($sql_query) {
        header("location: painel.php");
    } else {
        echo "<script>alert('Publicação não pode ser deletado!')<script>";
    }
}


?>