<main>

<div class="container">
    <h1 class="mt-4">Pacientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Sidenav Light</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
        <form class="form-group" action="<?php echo base_url("paciente/editar/".$paciente->uuid); ?>" method="POST">
        <div class="form-row align-items-center">
            <div class="form-group col-md-6">
                <label for="nome">Nome paciente</label>
                <input type="text" class="form-control" name="nome" value="<?php echo set_value('nome',@$paciente->nome); ?>" placeholder="Nome completo do paciente">
            </div>
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control cpf-mask" name="cpf" value="<?php echo set_value('cpf',@$paciente->cpf); ?>" placeholder="CPF">
            </div>
            <div class="form-group col-md-3">
                <label for="cns">CNS</label>
                <input type="text" class="form-control cns-mask" name="cns" value="<?php echo set_value('cns',@$paciente->cns); ?>" placeholder="Cartão nacional de saúde">
            </div>
            <div class="form-group col-md-3">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="text" class="form-control" name="data_nascimento" value="<?php echo set_value('data_nascimento',implode("/",array_reverse(explode("-",@$paciente->data_nascimento)))); ?>" placeholder="Data de Nascimento">
            </div>
            <div class="form-group col-md-6">
                <label for="nome_mae">Nome mãe</label>
                <input type="text" class="form-control" name="nome_mae" value="<?php echo set_value('nome_mae',@$paciente->nome_mae); ?>" placeholder="Nome da mãe">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control consulta-cep cep-mask" name="cep" value="<?php echo set_value('cep',@$paciente->data_nascimento); ?>" placeholder="CEP">
            </div>
            <div class="form-group col-md-8">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" name="logradouro" value="<?php echo set_value('logradouro',@$paciente->logradouro); ?>" placeholder="Logradouro">
            </div>
            <div class="form-group col-md-2">
                <label for="numero">Número</label>
                <input type="text" class="form-control" name="numero" value="<?php echo set_value('numero',@$paciente->numero); ?>" placeholder="Número">
            </div>
            <div class="form-group col-md-6">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" name="complemento" value="<?php echo set_value('complemento',@$paciente->complemento); ?>" placeholder="Complemento">
            </div>
            <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?php echo set_value('bairoo',@$paciente->bairro); ?>" placeholder="Bairro">
            </div>
            <div class="form-group col-md-6">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" name="estado" value="<?php echo set_value('estado',@$paciente->estado); ?>" placeholder="Estado">
            </div>
            <div class="form-group col-md-6">
                <label for="uf">UF</label>
                <input type="text" class="form-control" name="uf" value="<?php echo set_value('uf',@$paciente->uf); ?>" placeholder="UF">
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="Salvar">
        <input type="submit" class="btn btn-danger" value="Excluir">
    </form>
        </div>
    </div>
</div>


</main>