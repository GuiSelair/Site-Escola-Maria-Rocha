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
    $post = mysqli_query($conn, "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data) VALUES ('$tit', '$desc', '$postador', '$cat','$data')");

    if (!$post) {
        echo "<div class='alert alert-danger alert-dismissable my-0'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao publicar! Verifique sua conexão ou tente mais tarde.</strong>
            </div>
            ";
    }else {
        echo "
        <div class='alert alert-success alert-dismissable my-0'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Publicação efetuada com sucesso!</strong>
            </div>
            ";

         // REALIZA O DOWNLOAD DA IMAGEM DE CAPA DA NOTICIA (SE EXISTIR)
        $foto = $_FILES['arquivo'];
        $diretorio = "../Galeria/";
        if (!is_dir($diretorio)){
            echo "<div class='alert alert-warning alert-dismissable my-0'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro no Upload da imagem. Verifique a existencia da pasta 'Galeria'.</strong>
            </div>
            ";
        }
        else {
            if (isset($_FILES[ 'arquivo' ][ 'name' ]) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
                $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
                $nome = $_FILES[ 'arquivo' ][ 'name' ];
                // SELECIONA SOMENTE A EXTENSÃO E VERIFICA SE ESTÁ DENTRO DAS EXTENSÕES ESPERADA
                $extensao = pathinfo ($nome, PATHINFO_EXTENSION);
                $extensao = strtolower ($extensao);
                if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao)) {
                    //CRIA UM NOVO ALEATÓRIO PARA O ARQUIVO
                    $novoNome = uniqid ( time () ) . '.' . $extensao;
                    $destino = '../Galeria/'.$novoNome;
                    if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                        // ADICIONA A IMAGEM AO BANCO DE DADOS
                        $select = mysqli_query($conn, "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 1");
                        $row = mysqli_fetch_assoc($select);
                        $id = $row["id"];
                        $cat1 = 3;
                        $up = mysqli_query($conn, "INSERT INTO imagens (idPosts, categoria, nome) VALUES ('$id' ,' $cat1', '$novoNome');");
                    }
                    else{
                        echo "<div class='alert alert-warning alert-dismissable my-0'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Erro no Upload da imagem.</strong>
                        </div>
                        ";
                    }

                }
            }
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <!--LINKS PARA EDITOR ALTERNATIVO
    <link href="../portal/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../portal/froala/js/froala_editor.pkgd.min.js"></script>
    <link href="../portal/froala/css/froala_style.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../portal/froala/js/languages/pt_br.js"></script>
    -->
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
                        <hr />
                        <input class="form-check ml-3" type="file" name="arquivo" style="font-size: 15px;" />
                        <h6 class="my-3">Categoria da notícia:</h6>
                        <hr />
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

    <!--SCRIPT DE CONFIGURAÇÃO DO EDITOR
    <script>
        var editor = new FroalaEditor('#editor', {
            language: 'pt_br',
            toolbarButtons: {
                'moreText': {
                    'buttons': ['bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'textColor']
                },
                'moreParagraph': {
                    'buttons': ['alignLeft', 'alignCenter', 'alignJustify','formatOL', 'formatUL', 'outdent', 'indent']
                },
                'moreRich': {
                    'buttons': ['insertLink', 'insertImage', 'insertTable', 'insertHR']
                }
            },

            // Para telas pequenas
            toolbarButtonsXS: [
                ['undo', 'redo'],
                ['bold', 'italic', 'underline']
            ],
            quickInsertTags: [''],
            placeholderText: "Digite aqui sua descrição...",
            enter: FroalaEditor.ENTER_BR,
            imageUploadParam: 'file_name',
        })
    </script>
    -->

    <!--SCRIPT DE CONFIGURA DO EDITOR DE TEXTO ALTERNATIVA (SUMMERNOTE)-->
    <script type="text/javascript">
            $(document).ready(function() {
                $('#editor').summernote({
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                    ],
                    height: 200,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    lang: 'pt-BR'
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
