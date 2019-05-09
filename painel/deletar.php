<?php

    include_once("../conexao/conexao.php");
    include_once("../conexao/config.php");
    include_once("../conexao/function.php");

    $id_post = $_GET['id'];
    $nome = "../noticias/".$id_post.".php";
    
    $sql = mysqli_query(DBConecta(), "SELECT * FROM imagens WHERE idPosts = '$id_post';");
    $returnLines = mysqli_num_rows($sql);
    
    if ($returnLines == 0){
        if (unlink($nome)){        
            $sql_code = "DELETE FROM mr_posts WHERE id = '$id_post'";
            $sql_query = mysqli_query(DBConecta(), $sql_code) or die("Erro");
        }

    }
    else{
        $imageName = mysqli_fetch_assoc($sql);
        $imagePath = "../Galeria/".$imageName['nome'];
        
        if (unlink($imagePath) && unlink($nome)){        
            $sql_code = "DELETE FROM mr_posts WHERE id = '$id_post'";
            $sql_query = mysqli_query(DBConecta(), $sql_code) or die("Erro");
        }
    }
    if ($sql_query) {
        header("location: painel.php");
    } else {
        echo "<script>alert('Publicação não pode ser deletado!')<script>";
    }

?>