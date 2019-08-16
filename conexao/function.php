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

    function BuscaRetornaQuery($conn, $tabela, $coluna, $parametro){
        $sql_code = "SELECT * FROM $tabela WHERE $coluna = $parametro";
        $query = mysqli_query($conn, $sql_code);
        if ($query && mysqli_num_rows($query))
            return $query;
        else
            return false;
    }

    function BuscaRetornaResponse($conn, $tabela, $coluna, $parametro){
        $sql_code = "SELECT * FROM $tabela WHERE $coluna = $parametro";
        $query = mysqli_query($conn, $sql_code);
        if ($query && mysqli_num_rows($query))
            return mysqli_fetch_assoc($query);
        else
            return false;
    }

    function BuscaTodosCursos($conexao, $idAluno){
        $sql_code = "SELECT `turma`.`idCurso` FROM `turma-aluno`, `turma` WHERE `turma-aluno`.`idAluno`= $idAluno AND `turma-aluno`.`idTurma`=`turma`.`idTurma`";
        $query = mysqli_query($conexao, $sql_code);
        if ($query && mysqli_num_rows($query)){
            return mysqli_fetch_assoc($query);
        }
        return null;
    }

    function VerificaPrerequisito($conexao, $idDisciplina){
        $sql_code = "SELECT prerequisito FROM disciplina WHERE idDisciplina = ".$idDisciplina;
        $query = mysqli_query($conexao, $sql_code);
        if ($query && mysqli_num_rows($query)){
            $response = mysqli_fetch_assoc($query);
            if ($response["prerequisito"] != null)
                return $response;
            return false;
        }
        return false;
    }

    function ConfereAprovacao($conexao, $idDisciplina, $idAluno){
        $sql_code = "SELECT * FROM `aluno-disciplina` WHERE `idDisciplina` = ".$idDisciplina." AND `idAluno` = $idAluno ORDER BY `idAprovacao` DESC";
        $query = mysqli_query($conexao, $sql_code);     
      
        // BUSCA POR DISCIPLINAS JÁ CONCLUÍDAS
        if ($query && mysqli_num_rows($query)){
            
          $response = mysqli_fetch_assoc($query);
      
          // DISCIPLINAS NÃO APROVADAS OU AUSENTES
          if ($response["conceito"] != "Apto"){
            $nomeDisciplina = BuscaRetornaResponse($conexao, "disciplina", "idDisciplina", $response["idDisciplina"]);
            $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
            return array("nomeDisciplina" => $nomeDisciplina["nome"].$prerequisito, "conceitoDisciplina" => "NÃO APTO");
          }
          //  DISCIPLINAS APROVADAS
          else{
            $nomeDisciplina = BuscaRetornaResponse($conexao, "disciplina", "idDisciplina", $response["idDisciplina"]);
            $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
            return array("nomeDisciplina" => $nomeDisciplina["nome"].$prerequisito, "conceitoDisciplina" => "APTO");
          }  
        }
        //  DISCIPLINAS AINDA NÃO CURSADAS
        else{
          $nomeDisciplina = BuscaRetornaResponse($conexao, "disciplina", "idDisciplina", $idDisciplina);
          $nomeDisciplina["prerequisito"] ? $prerequisito = "*" : $prerequisito = "";
          return array("nomeDisciplina" => $nomeDisciplina["nome"].$prerequisito, "conceitoDisciplina" => "PENDENTE");
        }                                
      }

      function ConfereTipoUsuario($conexao, $login, $senha, $email = null){
        if(!empty($login) && !empty($senha)){
            $sql_code = "SELECT * FROM `administrador` WHERE `login` = '$login' AND `senha` = '$senha';";
            $query = mysqli_query($conexao, $sql_code);
            // TESTE DE ADMINISTRADOR
            if (mysqli_num_rows($query)){
                $response = mysqli_fetch_assoc($query);
                return array("tipo" => "Administrador", "id" => $response["idAdministrador"], "nome" => $response["nome"], "sobrenome" => $response["sobrenome"]);
            }
            else{
                $sql_code = "SELECT * FROM `professor` WHERE `login` = '$login' AND `senha` = '$senha' ";
                $query = mysqli_query($conexao, $sql_code);
                if (mysqli_num_rows($query)){
                    $response = mysqli_fetch_assoc($query);
                    return array("tipo" => "Professor", "id" => $response["idProfessor"], "nome" => $response["nome"], "sobrenome" => $response["sobrenome"]);
                }
                else{
                    $sql_code = "SELECT * FROM `aluno` WHERE `login` = '$login' AND `senha` = '$senha';";
                    $query = mysqli_query($conexao, $sql_code);
                    if (mysqli_num_rows($query)){
                        $response = mysqli_fetch_assoc($query);
                        return array("tipo" => "Aluno", "id" => $response["idAluno"], "nome" => $response["nome"], "sobrenome" => $response["sobrenome"]);
                    }
                }       
            } 
        }elseif(!empty($email)){
            $sql_code = "SELECT * FROM `administrador` WHERE `email` = '$email';";
            $query = mysqli_query($conexao, $sql_code);
            // TESTE DE ADMINISTRADOR
            if (mysqli_num_rows($query)){
                $response = mysqli_fetch_assoc($query);
                return "administrador";
            }
            else{
                $sql_code = "SELECT * FROM `professor` WHERE `email` = '$email' ";
                $query = mysqli_query($conexao, $sql_code);
                if (mysqli_num_rows($query)){
                    $response = mysqli_fetch_assoc($query);
                    return "professor";
                }
                else{
                    $sql_code = "SELECT * FROM `aluno` WHERE `email` = '$email';";
                    $query = mysqli_query($conexao, $sql_code);
                    if (mysqli_num_rows($query)){
                        $response = mysqli_fetch_assoc($query);
                        return "aluno";
                    }
                }       
            } 
        }
        else return array("tipo" => false);
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