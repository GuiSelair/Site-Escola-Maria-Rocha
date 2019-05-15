<?php

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");
include "../wideimage/lib/WideImage.php";

session_start();

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

if(isset($_POST['postar'])) {
    $conn = DBConecta();
    $tit = $_POST['titulo'];
    $desc = $_POST['descrição'];
    $post = $_SESSION["user"];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y H:i:s');
    $cat = $_POST['cat'];

    $post = mysqli_query($conn, "INSERT INTO mr_posts (titulo, descricao, postador, categoria, data) VALUES ('$tit', '$desc', '$post', '$cat','$data')");

    if (!$post) {
        echo "
        <div class='alert alert-danger alert-dismissable'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Erro ao publicar!</strong> 
            </div>
            ";
    } else {
        echo "
        <div class='alert alert-success alert-dismissable'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Operação efetuada com sucesso!</strong>
            </div>
            ";
        
         // Download da Imagem
        
        $foto = $_FILES['arquivo'];
        $diretorio = "../Galeria/";

        if (!is_dir($diretorio)){    // VERFICA A EXISTENCIA DA PASTA
            echo "Pasta $diretorio nao existe";
        }
        else {
            if (isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) { 
                //$dimensoes = getimagesize($foto['tmp_name']);
                $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
                $nome = $_FILES[ 'arquivo' ][ 'name' ];

                // Pega a extensão
                $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

                // Converte a extensão para minúsculo
                $extensao = strtolower ( $extensao );

                if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao)) {
                    $novoNome = uniqid ( time () ) . '.' . $extensao;

                    // Concatena a pasta com o nome
                    $destino = '../Galeria/' . $novoNome;


                    // tenta mover o arquivo para o destino
                    if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                        $select = mysqli_query($conn, "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 1");
                        $row = mysqli_fetch_assoc($select);
                        $id = $row["id"];
                        $cat1 = 3;
                        $up = mysqli_query($conn, "INSERT INTO imagens (idPosts, categoria, nome) VALUES ('$id' ,' $cat1', '$novoNome');");
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

                <h4>Criar postagem</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <form action="" method="POST" enctype="multipart/form-data" id="postForm">

                    <input type="text" name="titulo" id="titulo" placeholder="Titulo" class="form-control my-3"
                        required>

                    <textarea class="form-control" name="descrição" id="summernote" required></textarea>

                    <fieldset class="my-3">
                        <h6>Opções</h6>
                        <hr />
                        <input class="form-check ml-3" type="file" name="arquivo" multiple="multiple"
                            style="font-size: 15px;" />

                        <h6 class="my-3">Categoria da notícia:</h6>
                        <hr />

                        <div class="form-check ml-5">
                            <input class="form-check-input" type="radio" name="cat" value="1" checked> Escola
                        </div>

                        <div class="form-check ml-5">
                            <input class="form-check-input" type="radio" name="cat" value="0"> Editais
                        </div>

                    </fieldset>

                    <button type="submit" class="btn btn-primary btn-block" name="postar"
                        style="background-color: #354698; border:none;">Publicar Notícia</button>
                    <a href="../painel/painel.php" class="btn btn-block btn-dark"
                        style="background-color: #232323; border:none;">Voltar ao Painel de Controle</a>

                </form>

            </div>

        </div>

    </div>

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
                height: 250,
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

    
    <script src="../painel/componentes/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../painel/componentes/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../painel/componentes/js/painel-admin.js"></script>
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script src="dist/summernote-bs4.js"></script>
    <script src="dist/lang/summernote-pt-BR.js"></script>
    <script src="../geraHTML.php"></script>
</body>

</html>