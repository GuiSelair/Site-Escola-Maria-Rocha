<?php
    session_start();
    include_once("conexao/config.php");
    include_once("conexao/conexao.php");
    include_once("conexao/function.php");

    $consulta = "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 1";
    $pesquisa = mysqli_query(DBConecta(),$consulta);
    $resultado = mysqli_fetch_assoc($pesquisa);
    $id = $resultado['id'];

    $consulta = "SELECT * FROM imagens WHERE idPosts = $id";
    $pesquisa = mysqli_query(DBConecta(),$consulta);
    $linhas = mysqli_num_rows($pesquisa);
    $nome = '...';
    if ($linhas > 0){
        $imagem = mysqli_fetch_assoc($pesquisa);
        $nome = '../Galeria/'.$imagem['nome'];
    }
    

    $nomeArq = 'noticias/'.$resultado['id'].".php";
    echo $nomeArq;
    if (!$arquivo = fopen($nomeArq, "w")){
        echo 'Erro ao criar arquivo';
        exit();
    }

    $conteudo = "
    <!DOCTYPE html>
    <html>
        <head>
            <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
            <meta http-equiv='refresh' content='30'>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
            <meta name='keywords' content='maria rocha, escola maria rocha, escola professora maria rocha, escola profª maria rocha, santa maria, RS'>
            <meta name='description' content='Escola estadual de ensino médio e tecnico maria rocha'>


            <!-- Links Boostrap e CSS -->
            <link rel='stylesheet' href='../node_modules/bootstrap/compiler/bootstrap.css'>
            <link rel='stylesheet' href='../node_modules/bootstrap/compiler/style.css'>
            <link rel='stylesheet' href='../node_modules/font-awesome/css/font-awesome.css'>
            <link rel='stylesheet' href='../font-awesome/css/font-awesome.min.css'>
            <link rel='shortcut icon' href='../img/favicon.ico' />
        </head>
        <body>
            <?php include('menu.php'); ?>
            <div class='container text-center'>
                <h3 class='display-4'>".$resultado['titulo']."</h3>
                <img src='".$nome."' class='img-fluid my-4'>
                <hr style='border-color: #354698; '>
                <p class='text-justify mb-5'>".$resultado['descricao']."</p>
                <p class='text-left'><span class='fa fa-user'></span> Postado por <i>".$resultado ['postador']."</i><i> em ".$resultado['data']."</i></p>
            </div>
            <?php include('../footer.php'); ?>
        </body>
    </html>
    ";

    if (fwrite($arquivo, $conteudo) === FALSE){
        echo 'Erro ao gravar';
        exit();
    }
    mysqli_close($imagem);
    mysqli_close($pesquisa);
    fclose($arquivo);
?>
