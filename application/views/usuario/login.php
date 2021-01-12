<div id="layoutSidenav_content">
<main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                <div class="card-body">
                    <form action="<?php echo base_url("login"); ?>" method="POST">
                        <div class="form-group">
                            <label class="small mb-1" for="email">E-mail</label>
                            <input class="form-control py-4" id="email" name="email" type="email" placeholder="Enter email address" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="senha">Senha</label>
                            <input class="form-control py-4" id="senha" name="senha" type="password" placeholder="Enter password" />
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-primary" value="Login" />
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="<?php echo base_url("registrar"); ?>">Criar conta</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>