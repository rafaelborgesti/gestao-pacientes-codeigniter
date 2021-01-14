<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {

    public function __construct()
    {
       $this->load->database();
    }

    public function get_pacientes()
    {
      
      return $this->db->from("paciente")->get()->result();

    }

    public function cadastrar($params)
    {
      $status = 0;
		  $data = array();
	
      if (isset($params) && count($params)) {

        if (isset($params['uuid'])) $data['uuid'] = $params['uuid'];
        if (isset($params['foto'])) $data['foto'] = $params['foto'];
        if (isset($params['nome'])) $data['nome'] = $params['nome'];
        if (isset($params['nome_mae'])) $data['nome_mae'] = $params['nome_mae'];
        if (isset($params['data_nascimento'])) $data['data_nascimento'] = $params['data_nascimento'];
        if (isset($params['cpf'])) $data['cpf'] = $params['cpf'];
        if (isset($params['cns'])) $data['cns'] = $params['cns'];
        if (isset($params['cep'])) $data['cep'] = $params['cep'];
        if (isset($params['logradouro'])) $data['logradouro'] = $params['logradouro'];
        if (isset($params['numero'])) $data['numero'] = $params['numero'];
        if (isset($params['complemento'])) $data['complemento'] = $params['complemento'];
        if (isset($params['bairro'])) $data['bairro'] = $params['bairro'];
        if (isset($params['estado'])) $data['estado'] = $params['estado'];
        if (isset($params['uf'])) $data['uf'] = $params['uf'];
        if (isset($params['st_ativo'])) $data['st_ativo'] = $params['st_ativo'];
        if (isset($params['st_cadastro'])) $data['st_cadastro'] = $params['st_cadastro'];
        
        if ($this->db->insert('paciente',$data)) $status = $this->db->insert_id();
				
		  }
		
      return $status;
    }

    public function buscar_paciente_by_uuid($uuid)
    {
      if (isset($uuid)) {

        $this->db->from('paciente');
        $this->db->where('uuid',$uuid);
        
        return $this->db->get()->row();
      }	
    }

    public function editar($params)
    {
        $status = 0;
        $data = array();
        
        if (isset($params) && count($params)) {
          
          if (isset($params['foto'])) $data['foto'] = $params['foto'];
          if (isset($params['nome'])) $data['nome'] = $params['nome'];
          if (isset($params['nome_mae'])) $data['nome_mae'] = $params['nome_mae'];
          if (isset($params['data_nascimento'])) $data['data_nascimento'] = $params['data_nascimento'];
          if (isset($params['cpf'])) $data['cpf'] = $params['cpf'];
          if (isset($params['cns'])) $data['cns'] = $params['cns'];
          if (isset($params['cep'])) $data['cep'] = $params['cep'];
          if (isset($params['logradouro'])) $data['logradouro'] = $params['logradouro'];
          if (isset($params['numero'])) $data['numero'] = $params['numero'];
          if (isset($params['complemento'])) $data['complemento'] = $params['complemento'];
          if (isset($params['bairro'])) $data['bairro'] = $params['bairro'];
          if (isset($params['estado'])) $data['estado'] = $params['estado'];
          if (isset($params['uf'])) $data['uf'] = $params['uf'];
          if (isset($params['st_ativo'])) $data['st_ativo'] = $params['st_ativo'];
          if (isset($params['st_cadastro'])) $data['st_cadastro'] = $params['st_cadastro'];
            
            if (isset($params['id'])) {
                
                if ($this->db->update('paciente',$data,array('id'=>$params['id']))) $status = 1;
                
            }
            
        }
        
        return $status;
    }

    public function remove_foto($id)
    {
      return $this->db->update('paciente',['foto'=>''],array('id'=>$id));
    }

    public function excluir($id){
		
      return $this->db->delete('paciente', array('id'=>$id));
      
    }

}