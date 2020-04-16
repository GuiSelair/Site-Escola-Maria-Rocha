<?php

//////////////////////////////////////////////
////    PÁGINA EDITA PÁGINA DE CURSOS    ////
/////////////////////////////////////////////

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

// BUSCA OS DADOS DA TABELA E COLUNA SELECIONADA NO ARQUIVO editarCursos.php
if(isset($_POST["tabela_ID"]) && isset($_POST["coluna_ID"])){
    $tabela = $_POST["tabela_ID"];
    $coluna = $_POST["coluna_ID"];
    $sql_code = "SELECT * FROM $tabela;";
    $sql = mysqli_query(DBConecta(), $sql_code);
    $row = mysqli_fetch_assoc($sql);
    // RETORNA O CONTEUDO DA COLUNA
    echo $row[$coluna];
}
?>
