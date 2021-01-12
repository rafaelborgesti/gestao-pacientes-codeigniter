<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
		$this->load->library('Uuid');

	}

	public function cadastrar()
	{
		if ($this->input->post())
		{
			$this->load->model('usuario_model');

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
