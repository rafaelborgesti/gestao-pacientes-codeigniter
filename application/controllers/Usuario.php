<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
		$this->load->library('Uuid');
		$this->load->library('session');
		$this->load->model('usuario_model');

	}

	public function login()
	{

		if ($this->session->userdata('usurlogged')) redirect(base_url('paciente'));

		if ($this->input->post()) {
			
			$login = $this->usuario_model->buscar_usuario_by_email($this->input->post("email"));

			if (is_object($login)) {

				if (password_verify($this->input->post("senha"), $login->senha)) {

					$this->session->set_userdata([
						'id' => $login->id,
						'uuid' => $login->uuid,
						'nome' => $login->nome,
						'email' => $login->email,
						'usurlogged' => TRUE
					]);
	
					redirect(base_url('paciente'));

				} else {
					
					$this->session->set_flashdata('erro_mensagem','Senha incorreta');
				}
				
			} else {
				
				$this->session->set_flashdata('erro_mensagem','E-mail não encontrado');
				
			}
			
		}

		$this->load->view('layout/header');
		$this->load->view('layout/sidenav');
		$this->load->view('usuario/login');
		$this->load->view('layout/footer');

	}

	public function logout()
	{

		$this->session->sess_destroy();
		redirect(base_url('login'));

	}

	public function cadastrar()
	{

		if ($this->session->userdata('usurlogged')) redirect(base_url('paciente'));
		
		if ($this->input->post()) {
			
			$data = [];
			$data["uuid"] = $this->uuid->v4();
			$data["nome"] = $this->input->post("nome");
			$data["email"] = $this->input->post("email");
			$data["senha"] = password_hash($this->input->post("senha"), PASSWORD_DEFAULT);
			$data["st_ativo"] = 1;
			
			$this->usuario_model->cadastrar($data);
		}

		$this->load->view('layout/header');
		$this->load->view('layout/sidenav');
		$this->load->view('usuario/cadastrar');
		$this->load->view('layout/footer');
	}

}
