<div id="layoutSidenav_content">
<main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Cadastro</h3></div>
                <div class="card-body">
                    <form action="<?php echo base_url("registrar"); ?>" method="POST">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="nome">Nome</label>
                                    <input class="form-control py-4" name="nome" id="nome" type="text" value="" placeholder="Digite seu nome"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control py-4" name="email" id="email" type="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="senha">Senha</label>
                                    <input class="form-control py-4" name="senha" id="senha" type="password" placeholder="Digite a senha"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-0"><input type="submit" class="btn btn-primary btn-block" value="Criar conta" /></div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="<?php echo base_url("login"); ?>">login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>