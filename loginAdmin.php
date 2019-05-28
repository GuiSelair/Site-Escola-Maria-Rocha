<!-- TELA MODAL LOGIN ADMIN -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span> <!-- Botão X para sair -->
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="container"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <form name="loginForm" method="POST">
                                <div class="form-row mt-4">
                                    <div class="form-group col-sm-12">
                                        <label for="inputLogin">Login</label>
                                        <input type="text" name="login" class="form-control" id="login"
                                            placeholder="Usuário">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="inputSenha">Senha</label>
                                        <input type="password" name="senha" class="form-control" id="senha"
                                            placeholder="Senha">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary" name="entrar" type="submit">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-6 text-center">
                            <img src="img/Login.png" class="mr-auto ml-5 mb-4" width="70%">
                        </div>
                    </div>
                </div>
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <p class="text-left"><i>Somente para Administradores</i></p>
            </div>
        </div>
    </div>
</div>