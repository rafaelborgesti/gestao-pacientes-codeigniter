<main>

<div class="container">
    <h1 class="mt-4">Pacientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo base_url("pacientes"); ?>">Pacientes</a></li>
        <li class="breadcrumb-item active">editar</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
        <div class="form-row align-items-center">
            <div class="form-group col-md-4">
                <img class="foto-paciente" 
                src="<?php echo ($paciente->foto) ? base_url("public/upload/".$paciente->uuid."/imagem/screen/".$paciente->foto) : base_url('public/image/foto_default.jpg'); ?>" 
                class="rounded" alt="Foto paciente" width=250 height=250>
            </div>
            <div class="form-group col-md-6">
                <div>
                <p>Tamanho máximo: 3 MB - imagens permitidas: jpeg, jpg e png</p>
                </div>
                <div class="erros-foto-paciente" style="color:red;font-weight: bold;">
                </div>
                <hr>
                <input type="button" class="btn btn-danger" id="btn-excluir-foto-paciente" value="Excluir" <?php echo (!$paciente->foto) ? "disabled" : "" ?>>
                <hr>
                <input type="file" name="imagem">
                <hr>
                <div class="progress">
                    <div class="progress-bar" id="progressBar"></div>
                </div>
            </div>

            <input type="hidden" name="paciente_uuid" value="<?php echo $paciente->uuid; ?>">

        </div>
        <form class="form-group" action="<?php echo base_url("paciente/editar/".$paciente->uuid); ?>" method="POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="form-row align-items-center">
            <div class="form-group col-md-6">
                <label for="nome">Nome paciente</label>
                <input type="text" class="form-control <?php echo (form_error('nome')) ? 'is-invalid' : '' ?>" name="nome" value="<?php echo set_value('nome',@$paciente->nome); ?>" placeholder="Nome completo do paciente">
                <?php if (form_error('nome')): ?>
                <div class="invalid-feedback"><?php echo form_error('nome'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control cpf-mask <?php echo (form_error('cpf')) ? 'is-invalid' : '' ?>" name="cpf" value="<?php echo set_value('cpf',@$paciente->cpf); ?>" placeholder="CPF">
                <?php if (form_error('cpf')): ?>
                <div class="invalid-feedback"><?php echo form_error('cpf'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-3">
                <label for="cns">CNS</label>
                <input type="text" class="form-control cns-mask <?php echo (form_error('cns')) ? 'is-invalid' : '' ?>" name="cns" value="<?php echo set_value('cns',@$paciente->cns); ?>" placeholder="Cartão nacional de saúde">
                <?php if (form_error('cns')): ?>
                <div class="invalid-feedback"><?php echo form_error('cns'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-3">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="text" class="form-control dt-nasc <?php echo (form_error('data_nascimento')) ? 'is-invalid' : '' ?>" name="data_nascimento" value="<?php echo set_value('data_nascimento',implode("/",array_reverse(explode("-",@$paciente->data_nascimento)))); ?>" placeholder="Data de Nascimento">
                <?php if (form_error('data_nascimento')): ?>
                <div class="invalid-feedback"><?php echo form_error('data_nascimento'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="nome_mae">Nome mãe</label>
                <input type="text" class="form-control <?php echo (form_error('nome_mae')) ? 'is-invalid' : '' ?>" name="nome_mae" value="<?php echo set_value('nome_mae',@$paciente->nome_mae); ?>" placeholder="Nome da mãe">
                <?php if (form_error('nome_mae')): ?>
                <div class="invalid-feedback"><?php echo form_error('nome_mae'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control consulta-cep cep-mask <?php echo (form_error('cep')) ? 'is-invalid' : '' ?>" name="cep" value="<?php echo set_value('cep',@$paciente->cep); ?>" placeholder="CEP">
                <?php if (form_error('cep')): ?>
                <div class="invalid-feedback"><?php echo form_error('cep'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-8">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control <?php echo (form_error('logradouro')) ? 'is-invalid' : '' ?>" name="logradouro" value="<?php echo set_value('logradouro',@$paciente->logradouro); ?>" placeholder="Logradouro">
                <?php if (form_error('logradouro')): ?>
                <div class="invalid-feedback"><?php echo form_error('logradouro'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-2">
                <label for="numero">Número</label>
                <input type="text" class="form-control <?php echo (form_error('numero')) ? 'is-invalid' : '' ?>" name="numero" value="<?php echo set_value('numero',@$paciente->numero); ?>" placeholder="Número">
                <?php if (form_error('numero')): ?>
                <div class="invalid-feedback"><?php echo form_error('numero'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" name="complemento" value="<?php echo set_value('complemento',@$paciente->complemento); ?>" placeholder="Complemento">
            </div>
            <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control <?php echo (form_error('bairro')) ? 'is-invalid' : '' ?>" name="bairro" value="<?php echo set_value('bairoo',@$paciente->bairro); ?>" placeholder="Bairro">
                <?php if (form_error('bairro')): ?>
                <div class="invalid-feedback"><?php echo form_error('bairro'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="estado">Estado</label>
                <input type="text" class="form-control <?php echo (form_error('estado')) ? 'is-invalid' : '' ?>" name="estado" value="<?php echo set_value('estado',@$paciente->estado); ?>" placeholder="Estado">
                <?php if (form_error('estado')): ?>
                <div class="invalid-feedback"><?php echo form_error('estado'); ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="uf">UF</label>
                <input type="text" class="form-control <?php echo (form_error('uf')) ? 'is-invalid' : '' ?>" name="uf" value="<?php echo set_value('uf',@$paciente->uf); ?>" placeholder="UF">
                <?php if (form_error('uf')): ?>
                <div class="invalid-feedback"><?php echo form_error('uf'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="Salvar">
        <a href="javascript:void(0);" class="btn btn-danger btn-excluir-paciente" data-uuid="<?php echo $paciente->uuid; ?>">Excluir</a>
    </form>
        </div>
    </div>
</div>

</main>