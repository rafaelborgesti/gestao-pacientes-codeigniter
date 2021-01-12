<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_usuario extends CI_Migration {

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
                                'constraint' => '36'
                        ),
                        'nome' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'senha' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                        ),
                        'st_ativo' => array(
                                'type' => 'tinyint',
                                'constraint' => '1',
                        ),
                        'data_criacao TIMESTAMP DEFAULT NOW()'                        
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('usuario');
        }

        public function down()
        {
                $this->dbforge->drop_table('usuario');
        }
}