<?php

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
?>