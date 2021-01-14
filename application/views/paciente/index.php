<main>
    <div class="container">

    <h1 class="mt-4">Pacientes</h1>
    <p><a href="<?php echo base_url("paciente/cadastrar"); ?>" class="btn btn-success">Cadastrar</a></p>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pacientes</li>
    </ol>
    
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

    <?php if (count($pacientes)): ?>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Data Nasc.</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CNS</th>
                    <th scope="col">UF</th>
                    <th scope="col" style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pacientes as $paciente): ?>
                <tr>
                    <td scope="row"><?php echo $paciente->nome ?></td>
                    
                    <td scope="row"><?php echo formata_data_br($paciente->data_nascimento); ?></td>
                    <td scope="row"><?php echo $paciente->cpf ?></td>
                    <td scope="row"><?php echo $paciente->cns ?></td>
                    <td scope="row"><?php echo $paciente->uf ?></td>
                    <td align="center">
                        <a href="<?php echo base_url("paciente/editar/".$paciente->uuid); ?>" class="" title="Editar"><i style="color:#28a745" class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0);" class="btn-excluir-paciente" data-uuid="<?php echo $paciente->uuid; ?>"><i style="color:#dc3545" class="fas fa-trash-alt"></i></a>
                        &nbsp;&nbsp;
                        <?php if (!$paciente->st_cadastro): ?>
                        <i class="fas fa-exclamation-circle" title="Cadastro incompleto"></i>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Sem registros de pacientes...</p>
    <?php endif; ?>
    </div>
</main>