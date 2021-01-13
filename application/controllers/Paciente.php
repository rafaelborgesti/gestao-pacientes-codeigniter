<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('Uuid');
		$this->load->library('session');
		$this->load->model('paciente_model');

	}

	public function index()
	{

		if (!$this->session->userdata('usurlogged')) redirect(base_url('login'));

		$data['pacientes'] = $this->paciente_model->get_pacientes();

		$this->load->view('layout/header');
		$this->load->view('layout/sidenav');
		$this->load->view('paciente/index',$data);
		$this->load->view('layout/footer');

	}

	public function cadastrar()
	{
		if (!$this->session->userdata('usurlogged')) redirect(base_url('login'));

		$data = $_POST;
		$data["uuid"] = $this->uuid->v4();
		$data["st_ativo"] = 0;
		$data["st_cadastro"] = 0;

		$this->paciente_model->cadastrar($data);

		$paciente = $this->paciente_model->buscar_usuario_by_uuid($data["uuid"]);

		if (is_object($paciente))
			redirect(base_url("paciente/editar/".$paciente->uuid));
		
		redirect(base_url("paciente"));
	}

	public function editar($uuid)
	{
		
		if (!$this->session->userdata('usurlogged')) redirect(base_url('login'));
		
		$paciente = $this->paciente_model->buscar_usuario_by_uuid($uuid);
		
		if (!is_object($paciente)) 
			redirect(base_url("paciente/index/"));

		if ($this->input->post()){

			$data = $_POST;
			$data["nome"] = $this->input->post("nome");
			$data["nome_mae"] = $this->input->post("nome_mae");
			$data["data_nascimento"] = implode("-",array_reverse(explode("/",$this->input->post("data_nascimento"))));
			$data["cpf"] = str_replace(".","",str_replace("-","",$this->input->post("cpf")));
			$data["cns"] = $this->input->post("cns");
			$data["cep"] = str_replace("-","",$this->input->post("cep"));
			$data["logradouro"] = $this->input->post("logradouro");
			$data["numero"] = $this->input->post("numero");
			$data["complemento"] = $this->input->post("complemento");
			$data["bairro"] = $this->input->post("bairro");
			$data["estado"] = $this->input->post("estado");
			$data["uf"] = $this->input->post("uf");
			$data["st_ativo"] = 1;
			$data["st_cadastro"] = 1;
			$data["id"] = $paciente->id;

			if ($this->paciente_model->editar($data)){

				$this->session->set_flashdata('sucesso_mensagem','Atualizado com sucesso');

			} else {

				$this->session->set_flashdata('erro_mensagem','Ocorreu um erro');

			}

			redirect(base_url("pacientes"));

		}

		$this->load->view('layout/header');
		$this->load->view('layout/sidenav');
		$this->load->view('paciente/editar',['paciente'=>$paciente]);
		$this->load->view('layout/footer');
	}

}
