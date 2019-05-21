<?php

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

session_start();

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}


if (isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $res = mysqli_query(DBConecta(), "SELECT * FROM mr_posts WHERE id = '$id' ");
    $row = mysqli_fetch_array($res);

}

if (isset($_POST['atualizar'])) {
    $conn = DBConecta();

    $ntitulo = $_POST['ntitulo'];
    $ndescricao = $_POST['ndescrição'];
    $id =  $_GET['edit'];

    $up = mysqli_query($conn, "UPDATE mr_posts SET titulo = '$ntitulo', descricao = '$ndescricao' WHERE id = '$id' ") or die(mysqli_error($conn));

    if ($up) {
        echo "<script>alert('Publicação atualizada com Sucesso!')</script>";
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
        <link rel="shortcut icon" href="../Img/favicon.ico"/>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
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

                    <form action="" method="POST" enctype="multipart/form-data" id="postForm">

                        <p><input type="text" name="ntitulo" id="ntitulo" placeholder="Titulo" class="form-control" value="<?php echo $row['titulo'] ?>"></p>
                        <p><textarea class="form-control" name="ndescrição" id="summernote"><?php echo $row['descricao'] ?></textarea>
                        <p></p>
                        <button type="submit" class="btn btn-primary btn-block" name="atualizar">Atualizar Publicação</button>
                        <a href="../painel/painel.php" class="btn btn-block btn-dark">Voltar ao Painel de Controle</a>

                    </form>

                </div>

            </div>

        </div>

        <script type="text/javascript">
            $(document).ready(function() {
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
            var postForm = function() {
                var content = $('textarea[name="descrição"]').html($('#summernote').code());
            }
        </script>
        <script src="../painel/componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="../painel/componentes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../painel/componentes/js/painel-admin.js"></script>
        <link rel="stylesheet" href="dist/summernote-bs4.css">
        <script src="dist/summernote-bs4.js"></script>
        <script src="dist/lang/summernote-pt-BR.js"></script>
    </body>
</html>