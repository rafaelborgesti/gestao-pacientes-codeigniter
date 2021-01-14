<div id="layoutSidenav_content">
<main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('sucesso_mensagem')): ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('sucesso_mensagem'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('erro_mensagem')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('erro_mensagem'); ?>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url("login"); ?>" method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label class="small mb-1" for="email">E-mail</label>
                            <input class="form-control py-4 <?php echo (form_error('email')) ? 'is-invalid' : '' ?>" name="email" type="email" value="<?php echo set_value('email',@$paciente->email); ?>" placeholder="Digite o e-mail" />
                            <?php if (form_error('email')): ?>
                                <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="senha">Senha</label>
                            <input class="form-control py-4 <?php echo (form_error('senha')) ? 'is-invalid' : '' ?>" name="senha" type="password" placeholder="Digite a senha" />
                            <?php if (form_error('senha')): ?>
                                <div class="invalid-feedback"><?php echo form_error('senha'); ?></div>
                            <?php endif; ?>
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