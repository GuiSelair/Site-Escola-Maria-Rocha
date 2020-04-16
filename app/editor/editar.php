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

// VERIFICAÇÃO DE SEGURANÇA
$tokenUser = md5("seg".$_SERVER["REMOTE_ADDR"].$_SERVER["HTTP_USER_AGENT"]);
if ($_SESSION["donoDaSessao"] != $tokenUser){
  header("location:../index.php");
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
    $ndescricao = $_POST['descricao'];
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
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
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
                <h3>EDITAR PUBLICAÇÃO</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-muted">*Não adicionar nenhuma imagem nesta ferramenta, a não ser se a imagem estiver hospedado em outro servidor</p>
                <form action="" method="POST" enctype="multipart/form-data" id="postForm">
                    <!--TITULO DA NOTICIA-->
                    <input type="text" name="ntitulo" id="ntitulo" placeholder="Titulo" class="form-control my-2" value="<?php echo $row['titulo'] ?>">
                    <!--CORPO DA NOTICIA-->
                    <textarea class="form-control" name="descricao" id="editor" cols="30"><?php echo $row['descricao'] ?></textarea>
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

    <!--SCRIPT DE CONFIGURA DO EDITOR DE TEXTO ALTERNATIVO (SUMMERNOTE)-->
        <script type="text/javascript">
            $(document).ready(function () {
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
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    lang: 'pt-BR',
                    codeviewFilter: false,
                    codeviewIframeFilter: true

                });
            });
            var postForm = function () {
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
