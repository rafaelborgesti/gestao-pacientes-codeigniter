<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
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

}
