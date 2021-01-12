<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function cadastrar($params)
    {
        $status = 0;
		$data = array();
	
		if (isset($params) && count($params)){
			
			if (isset($params['uuid'])) $data['uuid'] = $params['uuid'];
			if (isset($params['nome'])) $data['nome'] = $params['nome'];
			if (isset($params['email'])) $data['email'] = $params['email'];
			if (isset($params['senha'])) $data['senha'] = $params['senha'];
			if (isset($params['st_ativo'])) $data['st_ativo'] = $params['st_ativo'];
			
			if ($this->db->insert('usuario',$data)) $status = $this->db->insert_id();
				
		}
		
		return $status;
    }

    public function buscar_usuario_by_email($email){

		if (isset($email)){

			$this->db->from('usuario');
			$this->db->where('email',$email);
			$this->db->limit(1);
			
            return $this->db->get()->row();

		}	
    }
}