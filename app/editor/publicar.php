<?php

//////////////////////////////////////
////        PUBLICAR NOTICIA      ////
//////////////////////////////////////

session_start();

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

// VERIFICA SE O USUÁRIO ESTÁ LOGADO
if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

// VERIFICAÇÃO DE SEGURANÇA
$tokenUser = md5("seg".$_SERVER["REMOTE_ADDR"].$_SERVER["HTTP_USER_AGENT"]);
if ($_SESSION["donoDaSessao"] != $tokenUser){
  header("location:../index.php");
}

// SALVA A NOTICIA NO BANCO DE DADOS E FAZ O DOWNLOAD DA IMAGEM (SE TIVER)
if(isset($_POST['postar'])) {
    $conn = DBConecta();
    $tit = $_POST['titulo'];
    $desc = $_POST['descricao'];
    $postador = $_SESSION["user"];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y H:i:s');
    // SALVA A NOTICIA COM CATEGORIA INFORMADA. LEIA O ARQUIVO CATEGORIAS.TXT PARA SABER MAIS SOBRE.
    $cat = $_POST['cat'];
    // REALIZA O DOWNLOAD DA THUMBNAIL E ARQUIVO DA NOTICIA (SE EXISTIR)
    $novoNomeThumbnail = null;
    $novoNomeArquivo = null;
    $error = false;

    if (isset($_FILES["thumbnail"]["name"]) && !empty($_FILES["thumbnail"]["size"])){
        $response = UploadArquivos($_FILES["thumbnail"], "thumbnail", "imagem", "../Galeria/");
        if ($response === "ArquivoIncompativel"){
            echo "<div class='alert alert-danger alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro na postagem da notícia. Arquivo enviado incompativel.</strong></div>";
            $error = true;
        }
        elseif ($response === "ErroUpload"){
            echo "<div class='alert alert-danger alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro na postagem da notícia. Erro no Upload do arquivo.</strong></div>";
            $error = true;
        }else{
            $novoNomeThumbnail = $response;
            $existeThumbnail = true;
        }
    }

    if (isset($_FILES["arquivo"]) && !empty($_FILES["arquivo"]["size"])) {
        $response = UploadArquivos($_FILES["arquivo"], "arquivo", "arquivo", "../arquivo/");
        if ($response === "ArquivoIncompativel"){
            echo "<div class='alert alert-danger alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro na postagem da notícia. Arquivo enviado incompativel.</strong></div>";
            $error = true;
        }
        elseif ($response === "ErroUpload"){
            echo "<div class='alert alert-danger alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro na postagem da notícia. Erro no Upload do arquivo.</strong></div>";
            $error = true;
        }else{
            $novoNomeArquivo = $response;
            $existeThumbnail = true;
        }
    }
    
    if($novoNomeThumbnail != null && $novoNomeArquivo != null)
        $sql_code = "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data, thumbnail, arquivo) VALUES ('$tit', '$desc', '$postador', ' $cat', '$data', '$novoNomeThumbnail', '$novoNomeArquivo');";
    elseif($novoNomeThumbnail != null)
        $sql_code = "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data, thumbnail) VALUES ('$tit', '$desc', '$postador', ' $cat', '$data', '$novoNomeThumbnail');";
    elseif($novoNomeArquivo != null)
        $sql_code = "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data, arquivo) VALUES ('$tit', '$desc', '$postador', ' $cat', '$data', '$novoNomeArquivo');";
    else{
        $sql_code = "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data) VALUES ('$tit', '$desc', '$postador', ' $cat', '$data');";
    }

    if (!$error){
        $results = mysqli_query($conn, $sql_code);
        if ($results){
            echo "<div class='alert alert-success alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Notícia postada com sucesso</strong></div>";
        }
        else{
            echo "<div class='alert alert-danger alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro na postagem da notícia. Verifique sua conexão.</strong></div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- IMPORTAÇÃO BOOTSTRAP, JQUERY -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

    <!-- EDITOR SUMMERNOTE -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script src="dist/summernote-bs4.min.js"></script>

</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h4>Publicar notícias</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="POST" enctype="multipart/form-data" id="postForm">
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo" class="form-control my-3" required>
                    <textarea class="form-control" name="descricao" id="editor" required></textarea>
                    <fieldset class="my-3">
                        <h6>Foto de capa para a notícia</h6>
                        <hr color="#cfcfcf"/>
                        <input class="form-check ml-3 my-3" type="file" name="thumbnail" style="font-size: 15px;" />
                        <h6>Arquivo PDF</h6>
                        <hr color="#cfcfcf" />
                        <input class="form-check ml-3" type="file" name="arquivo" style="font-size: 15px;" />
                        <h6 class="my-3">Categoria da notícia:</h6>
                        <hr color="#cfcfcf" />
                        <div class="form-check ml-5">
                            <input class="form-check-input" type="radio" name="cat" value="1" checked> Escola
                        </div>
                        <div class="form-check ml-5">
                            <input class="form-check-input" type="radio" name="cat" value="0"> Editais
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary btn-block" name="postar" style="background-color: #354698; border:none;">Publicar Notícia</button>
                    <button type="button" id="sair" onclick="confirmExclusao()" class="btn btn-block btn-dark" style="background-color: #232323; border:none;">Voltar ao Painel de Controle</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmExclusao() {
            if (confirm("Tem certeza que deseja sair desta postagem?")) {
                location.href = "../painel/painel.php";
            }
        }
    </script>

    <!--SCRIPT DE CONFIGURA DO EDITOR DE TEXTO ALTERNATIVA (SUMMERNOTE)-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#editor').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr', 'video']],
                    ['view', ['codeview', 'help']],
                ],
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                lang: 'pt-BR',
                codeviewFilter: false,
                codeviewIframeFilter: true,
                tableClassName: function()
                {
                    $(this).addClass('table table-bordered')

                    .attr('cellpadding', 12)
                    .attr('cellspacing', 0)
                    .attr('border', 1)
                    .css('borderCollapse', 'collapse');

                    $(this).find('td')
                    .css('borderColor', 'black')
                    .css('padding', '15px');
                },
            });
        });
        var postForm = function() {
            var content = $('textarea[name="descricao"]').html($('#editor').code());
        }
    </script>

    <script src="../painel/componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../painel/componentes/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script src="dist/summernote-bs4.js"></script>
    <script src="dist/lang/summernote-pt-BR.js"></script>
</body>
</html>
