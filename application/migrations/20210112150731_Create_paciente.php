<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_paciente extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'uuid' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '36',
                        ),
                        'foto' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '36',
                                'null' => TRUE,
                        ),
                        'nome' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'nome_mae' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'data_nascimento' => array(
                                'type' => 'date'
                        ),
                        'cep' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '8',
                        ),
                        'logradouro' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'numero' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'complemento' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'bairro' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'estado' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'uf' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '2',
                        ),
                        'cpf' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '11',
                        ),
                        'cns' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '15',
                        ),
                        'st_ativo' => array(
                                'type' => 'tinyint',
                                'constraint' => '1',
                        ),
                        'data_criacao TIMESTAMP DEFAULT NOW()'
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('paciente');
        }

        public function down()
        {
                $this->dbforge->drop_table('paciente');
        }
}