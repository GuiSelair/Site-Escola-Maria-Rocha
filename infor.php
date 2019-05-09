<?php

session_start();

include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if(isset($_POST['entrar'])) {
    $conn = DBConecta();

    $login = mysqli_escape_string($conn, $_POST['login']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    $cript = md5($senha);

    $conect = DBQuery('mr_usuarios', " WHERE login = '$login' AND senha = '$cript' ");

    if ($conect) {
        $_SESSION['Logado'] = true;
        $_SESSION["user"] = $login;
        header("location: infor.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: infor.php");
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>&nbsp; :::&nbsp; E.E.E.M. Profª Maria Rocha&nbsp; :::</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Boostrap e CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="shortcut icon" href="Img/favicon.ico" />
    <style>
        #nvcor {
            background-color: #354698;
        }
    </style>
</head>

<body>

    <!--NAVBAR-->

    <?php include 'menu.php'; ?>

    <div class="container text-center">
        <h2 class="display-4 my-5">Curso Técnico em Informática</h2>
        <hr style="border-color: #354698;">
    </div>
    <!--
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/info.jpg" alt="First slide">
                
            </div>
        </div>
    </div>
    -->

    <div class="container">

        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-laptop mx-2"></i>Objetivos do Curso</h5>
                <hr class="text-left">
                <p>Formar profissionais de nível técnico com visão empreendedora que atendam ás novas
                    necessidades da vida produtiva e que desenvolvam e adaptam softwares básicos e de sistemas
                    computacionais específicos.<br>
                    Oportunizar condições para um aperfeiçoamento e qualificação profissionais, atendendo a novos
                    paradigmas. Preparar profissionais para o mercado de trabalho, priorizando valores éticos, buscando
                    soluções novas no campo produtivo para melhoria da qualidade de vida.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-laptop mx-2"></i>Critérios de Avaliação</h5>
                <hr class="text-left">
                <p>A comprovação do desempenho do aluno é realizada através de instrumentos como testes, provas,
                    trabalhos escritos e orais, relatórios, projetos. <br>O resultado é expresso pela palavra APTO e
                    pela expressão NÃO APTO, para sinalizar ao aluno a
                    aquisição ou a não-aquisição das competências requeridas pelo perfil profissional de
                    conclusão.</p>
            </div>
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-laptop mx-2"></i>Estágio</h5>
                <hr class="text-left">
                <p>O estágio constitui a prática de ensino do educando e visa ao bom desempenho de sua profissão
                    e à complementação de sua formação.<br>O estágio curricular é previsto para a 3º etapa do Curso
                    Técnico em Informática conforme a matriz curricular, devendo ser realizado em 100 horas. Para a
                    realização do referido estágio, o aluno deverá pagar o seguro obrigatório que será oportunizado
                    através da escola em forma de apólice coletiva. O desenvolvimento do estágio é regulamentado e
                    supervisionado pela comissão de estágio constituída pelo coordenador do estágio, professores
                    orientadores e representantes da empresa onde o estágio é realizado. Ao término do estágio, o aluno
                    deverá apresentar a uma banca de professores um relato oral e um trabalho final escrito, em data e
                    horário previamente agendados.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-laptop mx-2"></i>Recuperação</h5>
                <hr class="text-left">
                <p>O estudo de recuperação visa ao oferecimento de novas oportunidades para que o aluno progrida
                    nos estudos.
                    Deve ser apresentados paralelamente as competências e desenvolvido no decorrer de cada módulo
                    ou etapa.
                    Caso o aluno ainda permaneça com dificuldades, a escola volta a oferecer depois de concluído
                    o módulo ou etapa, nova oportunidade de recuperação: os estudos adicionais.
                    Dos estudos adicionais, podem participar todos os alunos. Nos estudos adicionais, são
                    retomadas as competências e habilidades, aplicando-se novos instrumentos de avaliação.</p>


            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-laptop mx-2"></i>Perfil Profissional de Conclusão</h5>
                <hr class="text-left">
                <p>O Técnico em Informática – Área de Informática deve ser um profissional flexível, ágil e
                    criativo na solução de problemas da área, com visão empresarial e noções básicas sobre
                    gestão de negócios. Deve ser ético, responsável, que trabalhe em equipe e que:</p>
                <ul class="text-left">
                    <li>Se mantenha atualizado, e compartilhe conhecimentos e tecnologias;</li>
                    <li>Possua capacitação de base em lógica de programação, estruturas de dados, bancos de dados,
                        gestão empresarial;</li>
                    <li>Interprete especificações de sistemas;</li>
                    <li>Conheça aplicativos, clientes, servidor e linguagens de consulta;</li>
                    <li>Desenvolva aplicativo, nas linguagens de programação;</li>
                    <li>Conheça escrituração, instalação, configuração de programas, monitoração e manutenção de
                        computadores em rede;</li>
                    <li>Conheça os componentes e a origem de falhas no funcionamento de computadores, periféricos e
                        softwares básicos.</li>
                </ul>
            </div>
        </div>

    </div>

    <!--FOOTER-->
    <?php
            include_once("footer.php");
        ?>

    <!--TELA DE LOGIN -->
    <?php
            include_once("loginAdmin.php");
        ?>

    <!-- Links JS, Jquery e Popper -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>