<?php

//////////////////////////////////////
////   PÁGINA DE EDIÇÃO DE POSTS  ////
//////////////////////////////////////

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

session_start();

// VERICA SE O USUÁRIO ESTA LOGADO
if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

// BUSCA A NOTICIA PARA SER EDITADA
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query(DBConecta(), "SELECT * FROM mr_posts WHERE id = '$id'");
    $row = mysqli_fetch_array($res);
}

// ATUALIZADA O BANCO DE DADOS COM A NOTIFICA EDITADA
if (isset($_POST['atualizar'])) {
    $conn = DBConecta();
    $ntitulo = $_POST['ntitulo'];
    $ndescricao = $_POST['ndescrição'];
    $id =  $_GET['edit'];
    $sql_code = "UPDATE mr_posts SET titulo = '$ntitulo', descricao = '$ndescricao' WHERE id = '$id' ";
    $results = mysqli_query($conn, $sql_code);
    if ($results) {
        header("Location: ../painel/painel.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <link rel="shortcut icon" href="../Img/favicon.ico" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script src="dist/summernote-bs4.min.js"></script>
    -->
    <link href="../portal/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../portal/froala/js/froala_editor.pkgd.min.js"></script>
    <link href="../portal/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../portal/froala/js/languages/pt_br.js"></script>

</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h3>EDITAR PUBLICAÇÃO</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="POST" enctype="multipart/form-data" id="postForm">
                    <!--TITULO DA NOTICIA-->
                    <input type="text" name="ntitulo" id="ntitulo" placeholder="Titulo" class="form-control my-2" value="<?php echo $row['titulo'] ?>">
                    <!--CORPO DA NOTICIA-->
                    <textarea class="form-control" name="ndescrição" id="editor"><?php echo $row['descricao'] ?></textarea>
                    <button type="submit" class="btn btn-primary btn-block my-2" name="atualizar" style="background-color: #354698; border:none;">Atualizar Publicação</button>
                    <button type="button" id="sair" onclick="confirmExclusao()" class="btn btn-block btn-dark my-2" style="background-color: #232323; border:none;">Voltar ao Painel de Controle</button>
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

    <!--SCRIPT DE CONFIGURAÇÃO DO EDITOR-->
    <script>
        var editor = new FroalaEditor('#editor', {
            language: 'pt_br',
            toolbarButtons: {
                'moreText': {
                    'buttons': ['bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'textColor']
                },
                'moreParagraph': {
                    'buttons': ['alignLeft', 'alignCenter', 'alignJustify', 'formatOL', 'formatUL', 'outdent',
                        'indent'
                    ]
                },
                'moreRich': {
                    'buttons': ['insertLink', 'insertTable', 'insertHR']
                }
            },

            // Para telas pequenas
            toolbarButtonsXS: [
                ['undo', 'redo'],
                ['bold', 'italic', 'underline']
            ],
            imageUpload: false,
            videoUpload: false,
            quickInsertTags: [''],
            placeholderText: "Digite aqui sua descrição...",
            enter: FroalaEditor.ENTER_BR,
        })
    </script>

    <!--SCRIPT DE CONFIGURA DO EDITOR DE TEXTO ALTERNATIVO (SUMMERNOTE)
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
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
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                lang: 'pt-BR'
            });
        });
        var postForm = function () {
            var content = $('textarea[name="descrição"]').html($('#summernote').code());
        }
    </script>
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script src="dist/summernote-bs4.js"></script>
    <script src="dist/lang/summernote-pt-BR.js"></script>
    -->

    <script src="../painel/componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../painel/componentes/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
