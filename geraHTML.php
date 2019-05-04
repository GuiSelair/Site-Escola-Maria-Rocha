<?php
    session_start();
    include_once("conexao/config.php");
    include_once("conexao/conexao.php");
    include_once("conexao/function.php");

    $consulta = "SELECT * FROM mr_posts ORDER BY id DESC LIMIT 1";
    $pesquisa = mysqli_query(DBConecta(),$consulta);
    $resultado = mysqli_fetch_assoc($pesquisa);
    
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
                <h3 class='my-4'>".$resultado['titulo']."</h3>
                <p class='mb-5'>".$resultado['descricao']."</p>
                <span class='fa fa-user mb-4'></span> Postado por <i>".$resultado ['postador']."</i><i> em ".$resultado['data']."</i>
            </div>
            <?php include('../footer.php'); ?>
        </body>
    </html>
    ";

    if (fwrite($arquivo, $conteudo) === FALSE){
        echo 'Erro ao gravar';
        exit();
    }
    fclose($arquivo);
    mysqli_close($pesquisa);
?>
