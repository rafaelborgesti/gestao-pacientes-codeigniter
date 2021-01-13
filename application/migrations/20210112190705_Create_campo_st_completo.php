<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_campo_st_completo extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field("ALTER TABLE paciente ADD st_cadastro int2 NULL;");
        }

        public function down()
        {
                $this->dbforge->drop_table('paciente');
        }
}