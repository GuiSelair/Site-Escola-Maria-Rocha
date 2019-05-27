<?php

include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");

session_start();

if (!isset($_SESSION{'Logado'})) {
    header("location: ../index.php");
    session_destroy();
}

if (isset($_POST['atualizar'])) {
  if (!empty($_POST['tabela']) || !empty($_POST['coluna'])){
    $tabela = $_POST['tabela'];
    $coluna = $_POST['coluna'];
    $ndescricao = $_POST['ndescrição'];
    // Verificando se há algum campo na tabela
    $verifica = mysqli_query(DBConecta(), "SELECT * FROM $tabela");
    $linhas = mysqli_num_rows($verifica);
    if ($linhas > 0){
        $sql_code = "UPDATE $tabela SET $coluna = '$ndescricao';";
    }
    else{
        $sql_code = "INSERT INTO $tabela ($coluna) VALUES ('$ndescricao');";

    }
    $up = mysqli_query(DBConecta(), $sql_code);

    if ($up) {
        header("location: editarCursos.php");
    }
    else{
      echo "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Erro ao editar!</strong>
          </div>
          ";
    }
  }
  else {
    echo "<div class='alert alert-danger alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Selecione o Curso e Tópico antes de clicar neste botão</strong>
        </div>";
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

        <script type="text/javascript">
          $(document).ready(function(){
              $('#tabela').on('change',function(){
                  var nameTabela = $(this).val();
                  if(nameTabela != ""){
                      $('#coluna').html('<option value="">Selecione um tópico abaixo</option> <option value="objetivoCurso">Objetivos do Curso</option> <option value="criteriosAvaliacao">Criterios de Avaliação</option> <option value="estagio">Estagio</option> <option value="perfilConclusao">Perfil de Formação Profissional</option> <option value="gradeCurricular">Grade Curricular</option>');

                  }else{
                      $('#coluna').html('<option value="">Selecione o Curso primeiro</option>');
                  }
              });

              $('#coluna').on('change',function(){
                  let tabela = document.getElementById("tabela").value;
                  var coluna_ID = $(this).val();
                  $('#summernote').summernote('reset');
                  if(coluna_ID){
                      $.ajax({
                          type:'POST',
                          url:'getDados.php',
                          data:'tabela_ID='+tabela+'&coluna_ID='+coluna_ID,
                          success:function(html){

                            $('#summernote').summernote("pasteHTML", html);
                          }
                      });
                  }else{
                      $('#city').html('<p>Selecione o Tópicos para editar...</p>');
                  }
              });
          });
        </script>

        <link rel="stylesheet" href="dist/summernote-bs4.css">
        <script src="dist/summernote-bs4.min.js"></script>
    </head>
    <body>
        <div class="container my-5">

            <div class="row">

                <div class="col-12">

                    <h3>Marque a opção que deseja atualizar</h3>

                </div>

            </div>

            <div class="row">

                <div class="col-12">

                    <form action="" method="POST" enctype="multipart/form-data" id="postForm">
                        <hr>
                        <div class="text-center">
                            <select class="form-control-inline col-lg-4 p-2 mb-2" name="tabela" id="tabela">
                                <option value="">Selecione o curso</option>
                                <option value="cursoinformatica">Informática</option>
                                <option value="cursocontabilidade">Contabilidade</option>
                                <option value="cursosecretariado">Secretariado</option>
                            </select>
                            <select class="form-control-inline col-lg-4 p-2" name="coluna" id="coluna">
                                <option value="">Selecione o curso primeiro</option>
                            </select>
                        </div>
                        <hr />
                        <textarea class="form-control" name="ndescrição" id="summernote"></textarea>
                        <button type="submit" class="btn btn-primary btn-block mt-3" name="atualizar" id="atualizar" style="background-color: #354698; border:none;">Atualizar Publicação</button>
                        <a href="../painel/painel.php" class="btn btn-block btn-dark" style="background-color: #232323; border:none;">Voltar ao Painel de Controle</a>

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
                        ['color', ['color', 'forecolor', 'backcolor']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                    ],
                    tableClassName: function() {
                        $(this).addClass('table table-bordered')
                        //.attr('cellpadding', 10)
                        //.attr('cellspacing', 0)
                        .attr('border', 1)
                        //.css('borderCollapse', 'collapse');
                        $(this).find('td')
                        .css('borderColor', '#2d2e30')
                        //.css('padding', '10px');
                    },
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    lang: 'pt-BR',
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
