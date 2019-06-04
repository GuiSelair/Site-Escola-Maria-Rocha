<?php
//Include database configuration file
include_once("conexao/conexao.php");
include_once("conexao/config.php");
include_once("conexao/function.php");


if(isset($_POST["tabela_ID"]) && isset($_POST["nome"]) && isset($_POST["sobrenome"])){
    $id = $_POST["tabela_ID"];
    switch ($id) {
        case '0':
            $tabela = "aluno";
            break;
        case '1':
            $tabela = "professor";
            break;
    }
    $buscaNome = $_POST["nome"];
    $buscaSobre = $_POST["sobrenome"];
    $sql_code = "SELECT * FROM $tabela WHERE nome='$buscaNome' AND sobrenome='$buscaSobre';";
    $sql = mysqli_query(DBConecta(), $sql_code);
    $row = mysqli_fetch_assoc($sql);
    $cadastro = json_encode($row);
    echo $cadastro;
}
?>
