<?php

    // =========== CONEXÃO BANCO DE DADOS ===========

    function DBQuery($tabela, $parametro = null, $colunas = "*") {
        $parametro = ($parametro) ? "{$parametro}" : null;
        $colunas = ($colunas) ? " {$colunas}" : "*";
        $sql = "SELECT {$colunas} FROM {$tabela}{$parametro}";
        
        $resultado = DBExecute($sql);
        
        if (!mysqli_num_rows($resultado)) {
            return false;
        } else {
            while ($res = mysqli_fetch_assoc($resultado)) {
                $dados[] = $res;
            }
            
            return $dados;
        }
    }

    function DBExecute($sql) {
        $conn = DBConecta();
        
        $resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        DBClose($conn);
        
        return $resultado;
    }

    function BuscaTodosIDs($conn){
        $sql_code = "SELECT id FROM mr_posts ORDER BY id DESC";
        return mysqli_query($conn, $sql_code);
        
        
    }
    // ============================================================

    // =========== HASH (RECUPERAÇÃO DE SENHA) ===========

    function AddHash($conexao, $hash, $email){
        $sql_code = "INSERT INTO recuperaSegurança (hash, email) VALUES ('$hash', '$email');";
        $results = mysqli_query($conexao, $sql_code);
        if ($results) 
            return true;
        else  
            return false;

    }

    function RemoveHashEEmail($conexao, $email){
        $sql_code = "DELETE FROM recuperaSegurança WHERE email = '$email'";
        $results = mysqli_query($conexao, $sql_code);
        if ($results)
            return true;
        else   
            return false;

    }

    function VerificaHash($conexao, $hash){
        $sql_code = "SELECT * FROM recuperaSegurança WHERE hash = '$hash'";
        $results = mysqli_query($conexao, $sql_code);
        if ($results)
            return true;
        else  
            return false;
    }

    // ============================================================

    // =========== ATUALIZAÇÕES NO BANCO DE DADOS ===========

    function InsereNovaSenha($conexao, $cript, $nomeTabela, $email){
        $sql_code = "UPDATE $nomeTabela SET senha = '$cript' WHERE email = '$email'";
        $results = mysqli_query($conexao, $sql_code);
        if ($results)
            return true;
        else  
            return false;
    }

    //=============================================================

    // =========== REDIRECIONAMENTO ===========

    function Redireciona($dir){
        echo "<meta http-equiv='refresh' content='5; url={$dir}'>";
    }

    //=============================================================

    // =========== VALIDAÇÕES ===============

    function validaID($conn, $id){
        if(!empty($id)){
            $result = BuscaTodosIDs($conn);
            while ($ids = mysqli_fetch_assoc($result)){
                if ($id == $ids["id"]){
                    return true;
                }
            }
            return false;
        }
    }

    //=============================================================

?>