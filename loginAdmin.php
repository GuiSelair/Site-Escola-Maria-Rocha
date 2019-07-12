<?php
////////////////////////////////////////////
////   LOGIN DE ADMINISTRADOR DO SITE    ///
///////////////////////////////////////////
?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Acesso ao Painel Administrativo</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-none d-sm-block d-md-none text-center">
                            <img src="img/Login.png" alt="Logo Pequno" class="img-fluid" width="100">
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <form name="loginForm" method="POST">
                                <div class="form-row mt-4">
                                    <div class="form-group col-sm-12">
                                        <label for="inputLogin">Usuário</label>
                                        <input type="text" name="login" class="form-control" id="login" placeholder="Login" required>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="inputSenha">Senha</label>
                                        <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
                                    </div>
                                </div>
                                <!--FORMULARIO CAPTCHA-->
                                    <div class="form-group col-sm-12 text-center">
                                        <img src="geraCaptcha.php?l=150&a=50&tf=20&ql=5">
                                        <input class="form-control my-2" type="text" name="palavra" required placeholder="Digite o código"/>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary" name="entrar" type="submit">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block d-xl-block text-center">
                            <img src="img/Login.png" class="mb-2 img-fluid" width="200">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="text-left"><i>Somente para <b>Administradores</b></i></p>
            </div>
        </div>
    </div>
</div>
