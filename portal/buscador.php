<?php
//Include database configuration file
include_once("conexao/conexao.php");
include_once("conexao/config.php");


// METODO DE BUSCA: NOME COMPLETO
if(isset($_POST["tabela_ID"]) && isset($_POST["nome"]) && !empty($_POST["nome"]) ){
    $id = $_POST["tabela_ID"];
    switch ($id) {
        case '0':
            $tabela = "aluno";
            break;
        case '1':
            $tabela = "professor";
            break;
        case '2':
            $tabela = "turma";
            break;
        case '3':
            $tabela = "disciplina";
            break;
    }
    $buscaNome = $_POST["nome"];
    if (isset($_POST["sobrenome"]))
        $buscaSobre = $_POST["sobrenome"];
    if ($id < '2'){
        $sql_code = "SELECT * FROM $tabela WHERE nome='$buscaNome' AND sobrenome='$buscaSobre';";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $row = mysqli_fetch_assoc($sql);
        $cadastro = json_encode($row);
        echo $cadastro;
    }
    elseif($id == '2'){
        
        $sql_code = "SELECT * FROM $tabela WHERE idTurma=$buscaNome;";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $row = mysqli_fetch_assoc($sql);
        $cadastro = json_encode($row);
        echo $cadastro;
    }else{
        $sql_code = "SELECT * FROM $tabela WHERE nome='$buscaNome';";
        $sql = mysqli_query(DBConecta(), $sql_code);
        $row = mysqli_fetch_assoc($sql);
        $cadastro = json_encode($row);
        echo $cadastro;
    }
}

/*
// METODO DE BUSCA: ID
if(isset($_POST["tabela_ID"]) && isset($_POST["nome"]) && !empty($_POST["nome"]) ){
    $idUser = $_POST["nome"];
    $id = $_POST["tabela_ID"];
    switch ($id) {
        case '0':
            $tabela = "aluno";
            $idTabela = "idAluno";
            break;
        case '1':
            $tabela = "professor";
            $idTabela = "idProfessor";
            break;
        case '2':
            $tabela = "turma";
            $idTabela = "idTurma";
            break;
        case '3':
            $tabela = "disciplina";
            $idTabela = "idDisciplina";
            break;
    }
    $sql_code = "SELECT * FROM $tabela WHERE $idTabela = $idUser;";
    $sql = mysqli_query(DBConecta(), $sql_code);
    $row = mysqli_fetch_assoc($sql);
    $cadastro = json_encode($row);
    echo $cadastro;
}
*/
?>
