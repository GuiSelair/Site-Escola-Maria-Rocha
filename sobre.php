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
        header("location: sobre.php");
    } else {
        echo "<script>alert('Usuário ou Senha inválida!')</script>";
    }
}

if (isset($_GET['deslogar'])) {
    session_destroy();
    header("location: sobre.php");
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


        <!-- SOBRE O SITE -->

        <div class="container">

            <div class="row mt-5  justify-content-center">

                <div class="col-12 text-center mt-5">

                    <h1><strong>WILLIAM VARGAS</strong></h1>
                    <p class="text-muted">Estudante</p>

                </div>

                <img src="img/Perfil%20Will.png" class="img-responsive">

            </div>

            <div class="text-center center-block mb-5">
                <a href="https://www.facebook.com/Will.bvargas" target="_blank"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>

                <a href="https://twitter.com/BarcellosVargas" target="_blank"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>

                <a href="https://www.instagram.com/will.barcellos/?hl=pt-br" target="_blank"><i id="social-inst" class="fa fa-instagram fa-3x social"></i></a>

                <a href="mailto:vargahs3101@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
            </div>


        </div>

        <div class="container">

            <div class="row text-center">

                <div class="col-lg-6 display-4">EDUCAÇÃO</div>
                <div class="col-lg-6 display-4">DESENVOLVIMENTO</div>

            </div>
            <p></p>
            <div class="row text-center">

                <div class="col-md-6">

                    <h6>2012</h6>

                    <p class="mt-5 lead"><strong>Escola Municipal de Ensino Fundamental Zenir Aita</strong></p>
                    <hr>

                </div>

                <div class="col-md-6">

                    <strong>O TCC</strong>
                    <p></p>
                    <p style="text-align: justify;">Demorei um bom tempo para pensar em qual seria o assunto do meu TCC, quando decidi que seria sobre a escola, entrei em vários sites escolares de Santa Maria e Região pra ter uma ideia de como faria o meu. Depois de muita pesquisa eu comecei ele. Comecei e desisti, pois achava que não estava legal, foi criando e desistindo que acabei fazendo este, o qual me satisfez muito e foi meu trabalho final.</p>
                    <hr>
                </div>


            </div>

            <div class="row text-center">

                <div class="col-sm-6">

                    <h6>2013</h6>

                    <p class="mt-5 lead"><strong>Escola Estadual de Educação Básica Augusto Ruschi</strong></p>
                    <hr>
                </div>

                <div class="col-sm-6">

                    <strong>Por que a Escola?</strong>
                    <p></p>
                    <p style="text-align: justify;">A Escola Profª Maria Rocha investe muito em educação profissional para os alunos, oferecendo alguns cursos profissionalizantes para que possam entrar na carreira. E pelo motivo de um desses cursos ser de Técnico em Informática, no qual eu cursava, foi no meu TCC que decidi fazer um novo site para a escola, contendo um layout mais bonito e mais limpo, para que os conteúdos fossem bem localizados e os visitantes se sentissem mais confortáveis ao visita-lo.</p>
                    <hr>
                </div>


            </div>

            <div class="row text-center">

                <div class="col-sm-6">

                    <h6>2014</h6>

                    <p class="mt-5 lead"><strong>Escola Estadual de Ensino Médio Professora Maria Rocha</strong></p>
                    <p class="lead"><strong>Técnico em Informática Integrado ao Ensino Médio</strong></p>
                    <hr>
                </div>

                <div class="col-sm-6">

                    <strong>Aprendizado</strong>
                    <p></p>
                    <p style="text-align: justify;">Durante o desenvolvimento do site, acompanhava vários sites de pesquisa sobre Html, CSS e Bootstrap para poder fazer, e nesse tempo absorvi muitas informações destas pesquisas, no qual me fez ter mais conhecimento na área.</p>
                    <hr>
                </div>


            </div>
            
            <div class="row text-center">

                <div class="col-sm-6">

                    <h6>2018</h6>

                    <p class="mt-5 lead"><strong>Udemy</strong></p>
                    <p class="lead"><strong>Cuso Online Bootstrap 4 - Completo, Prático e Responsivo</strong></p>
                    <hr>
                </div>


            </div>



        </div>

        <div class="container">

            <div class="row">

                <div class="col-lg-12 text-center display-4 mb-5">INDICAÇÕES</div>

            </div>

            <div class="row text-center">

                <div class="col-sm-4">

                    <img src="Img/Perfil%20Pippi.png" class="img-responsive">
                    <p class="mt-3 display-5"><i class="fa fa-user" aria-hidden="true"></i>
                        <strong>Thomas Pippi</strong>
                    </p>
                    <p class="text-muted"><i class="fa fa-mobile" aria-hidden="true"></i> (55) 9 9650-8566</p>
                    <span class="text-muted"><i class="fa fa-envelope-o" aria-hidden="true"></i> thomas_pippi@hotmail.com</span>

                </div>
                <div class="col-sm-4">

                    <img src="Img/Perfil%20Duda.png" class="img-responsive">
                    <p class="mt-3 display-5"><i class="fa fa-user" aria-hidden="true"></i>
                        <strong>Eduarda Schimdit</strong>
                    </p>
                    <p class="text-muted"><i class="fa fa-mobile" aria-hidden="true"></i> (55) 9 9184-1847</p>
                    <span class="text-muted"><i class="fa fa-envelope-o" aria-hidden="true"></i> eduardacezarschmidt@gmail.com</span>

                </div>
                <div class="col-sm-4">

                    <img src="Img/Perfil%20Rico.png">
                    <p class="mt-3 display-5"><i class="fa fa-user" aria-hidden="true"></i>
                        <strong>Enrique Carvalho</strong>
                    </p>
                    <p class="text-muted"><i class="fa fa-mobile" aria-hidden="true"></i> (55) 9 8408-6471</p>
                    <span class="text-muted"><i class="fa fa-envelope-o" aria-hidden="true"></i> enrique.carvalho60@gmail.com</span>

                </div>

            </div> 
        </div>





        <!--FOOTER-->

        <div class="container mb-4">
            <div class="row bg-inverse">
                <div class="col-12 mb-3"><hr></div>

                <div class="col-lg-4 text-center mt-5">

                    <div class="btn-group-vertical btn-block btn-block-lg">
                        <a href="http://www.educacao.rs.gov.br/inicial" target="_blank" class="btn btn-outline-danger">Secretaria da Educação</a>                
                        <a href="https://secweb.procergs.com.br/rheportal/logon.xhtml" target="_blank" class="btn btn-outline-danger">Portal do Servidor</a>                
                        <a href="http://portaldoprofessor.mec.gov.br/index.html" target="_blank" class="btn btn-outline-danger">Portal do Professor</a>                
                        <a href="http://site.ufsm.br/" target="_blank" class="btn btn-outline-danger">UFSM</a>                              
                    </div>

                </div>

                <div class="col-lg-4 text-center mt-2">

                    <h3>Sites e Blogs</h3>

                    <div class="btn-group-vertical btn-block btn-block-lg">
                        <a href="http://infomariarocha.blogspot.com.br/" target="_blank" class="btn btn-outline-danger">Curso de Informática</a>
                        <a href="http://www.blogdonatanael.com/" target="_blank" class="btn btn-outline-danger">Professor Natanael</a>
                        <a href="http://supervisaoctmr.blogspot.com.br/" target="_blank" class="btn btn-outline-danger">Supervisão dos Cursos Técnicos</a>
                    </div>

                </div>

                <div class="col-lg-4 text-center mt-5">

                    <div class="btn-group-vertical btn-block btn-block-lg">
                        <a href="http://portal.mec.gov.br/" target="_blank" class="btn btn-outline-danger">MEC</a>                
                        <a href="http://prouniportal.mec.gov.br/" target="_blank" class="btn btn-outline-danger">Prouni</a>                
                        <a href="https://enem.inep.gov.br/#/antes?_k=4k5apg" target="_blank" class="btn btn-outline-danger">Enem</a>                
                        <a href="http://www.dominiopublico.gov.br/pesquisa/PesquisaObraForm.jsp" target="_blank" class="btn btn-outline-danger">Domínio Público</a>                              
                    </div>

                </div>
            </div>

            <div class="row text-center">
                <div class="col-12 lead">&copy; 2018 - Maria Rocha</div>
            </div>

        </div>


        <!--MODAL LOGIN-->


        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">

            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">Login</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>&times;</span>
                        </button>   
                    </div>

                    <div class="modal-body">

                        <div class="container">

                            <div class="container">

                                <div class="row">

                                    <div class="col-6">

                                        <form name="loginForm" method="POST">

                                            <div class="form-row mt-4">

                                                <div class="form-group col-sm-12">

                                                    <label for="inputLogin">Login</label>
                                                    <input type="text" name="login" class="form-control" id="login" placeholder="Usuário">

                                                </div>

                                                <div class="form-group col-sm-12">

                                                    <label for="inputSenha">Senha</label>
                                                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <button class="btn btn-primary" name="entrar" type="submit">Entrar</button>

                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                    <div class="col-6">
                                        <img src="img/Login.png" width="100%">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Links JS, Jquery e Popper -->
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </body>
</html>