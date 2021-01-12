<main>
    <div class="container-fluid">
    <?php if (count($pacientes)): ?>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Data Nasc.</th>
                <th scope="col">CPF</th>
                <th scope="col">CNS</th>
                <th scope="col">UF</th>
                <th scope="col" style="width:  15%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pacientes as $paciente): ?>
                <tr>
                    <td scope="row"><?php echo $paciente->nome ?></td>
                    <td scope="row"><?php echo $paciente->data_nascimento ?></td>
                    <td scope="row"><?php echo $paciente->cpf ?></td>
                    <td scope="row"><?php echo $paciente->cns ?></td>
                    <td scope="row"><?php echo $paciente->uf ?></td>
                    <td>
                        <a href="<?php echo base_url("paciente/editar/".$paciente->uuid); ?>" class="">Editar</a> |
                        <a href="javascript:void(0);" class="">Excluir</a>
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