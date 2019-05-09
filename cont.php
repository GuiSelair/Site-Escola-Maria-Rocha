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
        header("location: cont.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: cont.php");
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
    <link rel="shortcut icon" href="img/favicon.ico" />
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
        <h2 class="display-4 my-5">Curso Técnico em Contabilidade</h2>
        <hr style="border-color: #354698;">
    </div>
    <!--
        <div class="carousel slide" id="cInfo" data-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item active">

                    <img id="cInfo" src="img/cont.jpg" class="img-fluid d-block" width="100%">

                    <div class="carousel-caption text-dark d-none d-md-block mb-5">

                        <h1 class="display-1"><strong>Contabilidade</strong></h1>
                        <hr>
                        <p class="lead"><strong>Contabilidade é uma ciência aplicada que tem como objecto de estudo o patrimônio das entidades, seus fenômenos e variações, tanto no aspecto quantitativo quanto no qualitativo.</strong></p>

                    </div>

                </div>
            </div>
        </div>
        -->

    <div class="container">

        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-calculator mx-2"></i>Critérios de Avaliação</h5>
                <hr class="text-left">
                <p>A comprovação do desempenho do aluno é realizada através de instrumentos como testes, provas,
                    trabalhos escritos e orais, relatórios, projetos. O resultado é expresso pela palavra APTO e pela
                    expressão NÃO APTO, para sinalizar ao aluno a aquisição ou a não-aquisição das competências
                    requeridas pelo perfil profissional de conclusão.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-calculator mx-2"></i>Estágio</h5>
                <hr class="text-left">
                <p>O estágio constitui a prática de ensino do educando e visa ao bom desempenho de sua profissão e à
                    complementação de sua formação.
                    O estágio curricular é previsto para a 3º etapa do Curso Técnico em Contabilidade conforme a matriz
                    curricular, devendo ser realizado em 100 horas.
                    Para a realização do referido estágio, o aluno deverá pagar o seguro obrigatório que será
                    oportunizado através da escola em forma de apólice coletiva.
                    O desenvolvimento do estágio é regulamentado e supervisionado pela comissão de estágio constituída
                    pelo coordenador do estágio, professores orientadores e representantes da empresa onde o estágio é
                    realizado.
                    Ao término do estágio, o aluno deverá apresentar a uma banca de professores um relato oral e um
                    trabalho final escrito, em data e horário previamente agendados.
                    Obs.: A solenidade de formatura - conclusão do Curso - é unificada.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-calculator mx-2"></i>Dependência</h5>
                <hr class="text-left">
                <p>Os alunos que, após estudos adicionais no final do módulo ou etapa, forem considerados
                    Não-Aptos terão a oportunidade de realizar dependência.
                    Os estudos de dependência são realizados em períodos concomitantes, porém em horários
                    diferenciados, (sempre que houver compatibilidade do horário do aluno e da oferta da
                    Escola).</p>

            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-calculator mx-2"></i>Recuperação</h5>
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
                <h5 class="text-left display-4 my-3" style="font-size: 30pt;"><i class="fa fa-calculator mx-2"></i>Perfil Profissional de Conclusão</h5>
                <hr class="text-left">
                <p>O egresso do Curso Técnico em Contabilidade - Área de Gestão deve ser um profissional capaz
                    de desenvolver processos de mudanças, objetivando a excelência contábil, transformando as
                    informações em conhecimentos técnicos e operacionais inerentes à área de gestão;</p>
                <ul class="text-left">
                    <li>Deve ser auto gerenciador dos seus serviços, adaptar-se às novas tecnologias, ser aprendiz
                        permanente, buscando o aperfeiçoamento técnico, socializando os seus conhecimentos na área
                        contábil;</li>
                    <li>Deve ter capacidade de liderança, de trabalho em equipe;</li>
                    <li>Deve preparar-se para enfrentar situações adversas;</li>
                    <li>Ter iniciativa, criatividade, senso crítico, ter espírito empreendedor e ético para exercer
                        a cidadania, contribuindo para a prática da gestão social;</li>
                    <li>Ter visão ampla de contabilidade na área de gestão, ser organizado no planejamento, nas
                        operações, nos controles e nos processos que se referem ao patrimônio, à produção e aos
                        sistemas de informações da contabilidade em geral, conforme legislação em vigor;</li>
                    <li>Exercer a atividade de escrituração contábil e fiscal, realizar balancetes, balanço
                        patrimonial, analisá-lo e observar as leis vigentes;</li>
                    <li>Ter condições, conhecimentos e capacidade de interpretar e analisar dados estatísticos
                        extraídos dos diversos relatórios contábeis, facilitando o crescimento econômico
                        administrativo das instituições.</li>
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