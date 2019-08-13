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

    function BuscaNomes($conn, $parametro, $tabela){
        $sql_code = "SELECT nome FROM $tabela WHERE `idDisciplina` = $parametro";
        $query = mysqli_query($conn, $sql_code);
        if ($query && mysqli_num_rows($query))
            return mysqli_fetch_assoc($query);
    }

    function BuscaTodosCursos($conn, $idAluno){
        
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

    function UploadArquivos($arquivo, $name, $tipoArquivo, $destinoArquivo){
        switch ($tipoArquivo) {
            case "imagem":
                $arquivo_tmp = $_FILES[ $name ][ 'tmp_name' ];
                $nome = $_FILES[ $name ][ 'name' ];
                // SELECIONA SOMENTE A EXTENSÃO E VERIFICA SE ESTÁ DENTRO DAS EXTENSÕES ESPERADA
                $extensao = pathinfo ($nome, PATHINFO_EXTENSION);
                $extensao = strtolower ($extensao);
                if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao)) {
                    //CRIA UM NOVO ALEATÓRIO PARA O ARQUIVO
                    $novoNomeThumbnail = uniqid (time()) . '.' . $extensao;
                    if (VerificaDiretorio($destinoArquivo)){
                        $destino = $destinoArquivo.$novoNomeThumbnail;
                        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) 
                            return $novoNomeThumbnail;
                        return "ErroUpload";
                    }
                }
                return "ArquivoIncompativel";
                break;
                
            case "arquivo":
                $arquivo_tmp = $_FILES[ $name ][ 'tmp_name' ];
                $nome = $_FILES[ $name ][ 'name' ];
                // SELECIONA SOMENTE A EXTENSÃO E VERIFICA SE ESTÁ DENTRO DAS EXTENSÕES ESPERADA
                $extensao = pathinfo ($nome, PATHINFO_EXTENSION);
                $extensao = strtolower ($extensao);
                if (strstr ( '.pdf', $extensao)) {
                    //CRIA UM NOVO ALEATÓRIO PARA O ARQUIVO
                    $novoNomeThumbnail = uniqid (time()) . '.' . $extensao;
                    if (VerificaDiretorio($destinoArquivo)){
                        $destino = $destinoArquivo.$novoNomeThumbnail;
                        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) 
                            return $novoNomeThumbnail;
                        return "ErroUpload";
                    }
                }
                return "ArquivoIncompativel";
                break;
            default:
                return false;
        }
    }

    function VerificaDiretorio($diretorio){
        if (!is_dir($diretorio)){
            return false;
        }
        return true;
    }

    function ValidaURL( $str ){
        /**
        * Função para retornar uma string protegida contra SQL/Blind/XSS Injection
        */
        if( !is_array( $str ) ) {
            $str = preg_replace("/(from|select|insert|delete|where|drop table|show tables)/i","",$str);
            $str = preg_replace('~&amp;#x([0-9a-f]+);~i', 'chr(hexdec("\\1"))', $str);
            $str = preg_replace('~&amp;#([0-9]+);~', 'chr("\\1")', $str);
            $str = str_replace("<script","",$str);
            $str = str_replace("script>","",$str);
            $str = str_replace("<Script","",$str);
            $str = str_replace("Script>","",$str);
            $str = trim($str);
            $tbl = get_html_translation_table(HTML_ENTITIES);
            $tbl = array_flip($tbl);
            $str = addslashes($str);
            $str = strip_tags($str);
            if (filter_var($str, FILTER_VALIDATE_INT)) {
                return strtr($str, $tbl);
            } 
        }
        else return $str;
    }

    //=============================================================

?>