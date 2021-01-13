<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_campos_null_paciente extends CI_Migration {

        public function up()
        {
                
                $fields = array(
                        'nome' => array(
                                'null' => TRUE,
                        ),
                        'nome_mae' => array(
                                'null' => TRUE,
                        ),
                        'data_nascimento' => array(
                                'null' => TRUE,
                        ),
                        'cep' => array(
                                'null' => TRUE,
                        ),
                        'logradouro' => array(
                                'null' => TRUE,
                        ),
                        'numero' => array(
                                'null' => TRUE,
                        ),
                        'complemento' => array(
                                'null' => TRUE,
                        ),
                        'bairro' => array(
                                'null' => TRUE,
                        ),
                        'estado' => array(
                                'null' => TRUE,
                        ),
                        'uf' => array(
                                'null' => TRUE,
                        ),
                        'cpf' => array(
                                'null' => TRUE,
                        ),
                        'cns' => array(
                                'null' => TRUE,
                        ),
                        'st_ativo' => array(
                                'null' => TRUE,
                        )
                );
                $this->dbforge->modify_column('paciente', $fields);
        }

        public function down()
        {
                $this->dbforge->drop_table('paciente');
        }
}