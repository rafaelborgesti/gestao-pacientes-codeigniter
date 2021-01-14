<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('paciente');
		$this->load->library('Uuid');
		$this->load->library('session');
		$this->load->model('paciente_model');

		$this->pasta_upload = 'public/upload/';
		$this->pasta_imagem = 'imagem/';
		$this->pasta_imagem_thumb = 'thumb/';
		$this->pasta_imagem_screen = 'screen/';
		$this->allowed_types = 'jpeg|jpg|png';
		$this->max_size = 3072;

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

		$paciente = $this->paciente_model->buscar_paciente_by_uuid($data["uuid"]);

		if (is_object($paciente))
			redirect(base_url("paciente/editar/".$paciente->uuid));
		
		redirect(base_url("paciente"));
	}

	public function editar($uuid)
	{
		
		if (!$this->session->userdata('usurlogged')) redirect(base_url('login'));
		
		$paciente = $this->paciente_model->buscar_paciente_by_uuid($uuid);
		
		if (!is_object($paciente)) 
			redirect(base_url("paciente/index/"));

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="text-danger small">', '</span>');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('nome_mae', 'Nome mãe', 'required');
		$this->form_validation->set_rules('data_nascimento', 'Data nascimento', 'required');
		$this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique_field[paciente.cpf.id.'.$paciente->id.'.]|validate_cpf');
		$this->form_validation->set_rules('cns', 'CNS', 'required|is_unique_field[paciente.cns.id.'.$paciente->id.'.]|validate_cns');
		$this->form_validation->set_rules('cep', 'CEP', 'required');
		$this->form_validation->set_rules('logradouro', 'Logradouro', 'required');
		$this->form_validation->set_rules('numero', 'Número', 'required');
		$this->form_validation->set_rules('bairro', 'Bairro', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('uf', 'UF', 'required');

		if ($this->form_validation->run() !== FALSE) {

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

	public function adicionar_imagem()
	{
		
		if (!$this->session->userdata('usurlogged')) exit;

		$result['status'] = 'error';
		$result['mensagem'] = 'Ocorreu um erro';
		$result['foto'] = '';
		$result['url_foto'] = '';
		
		$paciente = $this->paciente_model->buscar_paciente_by_uuid($this->input->post('uuid'));
		
		if (is_object($paciente)) {

			if (isset($_FILES)) {
			
				$this->pasta_paciente = $paciente->uuid.'/';		
				
				//CRIA AS PASTAS AUTOMATICAMENTE
				criar_pasta($this->pasta_upload.$this->pasta_paciente);
				criar_pasta($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem);
				criar_pasta($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_thumb);
				criar_pasta($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_screen);
				
				$arquivo_nome_original = $_FILES['imagem']['name'];
				
				$extensao = pathinfo($arquivo_nome_original, PATHINFO_EXTENSION);

				$arquivo_nome = (!$paciente->foto) ? gerar_string_randomica() . '.' . $extensao : $paciente->foto;

				$config['upload_path']          = $this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem;
				$config['allowed_types']        = $this->allowed_types;
				$config['max_size']             = $this->max_size;
				$config['file_name'] 			= $arquivo_nome;
				$config['overwrite'] 			= TRUE;
				
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('imagem')) {
	
					$config_resize['image_library'] = 'gd2';
					$config_resize['maintain_ratio'] = TRUE;
					$config_resize['master_dim'] = 'height';
					$config_resize['quality'] = "100%";
					$config_resize['source_image'] = $this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$arquivo_nome;
					$config_resize['new_image'] = $this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_thumb.$arquivo_nome;
					$config_resize['height'] = 500;
					$config_resize['width'] = 1;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					unset($config_resize);
					
					$config_resize['image_library'] = 'gd2';
					$config_resize['maintain_ratio'] = TRUE;
					$config_resize['master_dim'] = 'height';
					$config_resize['quality'] = "100%";
					$config_resize['source_image'] = $this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$arquivo_nome;
					$config_resize['new_image'] = $this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_screen.$arquivo_nome;
					$config_resize['height'] = 800;
					$config_resize['width'] = 1;
					
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					$this->image_lib->clear();
	
					$this->paciente_model->editar(['id'=>$paciente->id,'foto'=>$arquivo_nome]);

					$result['status'] = 'success';
					$result['mensagem'] = 'Cadastrado com sucesso!';
					$result['foto'] = $paciente->foto;
					$result['url_foto'] = base_url('public/upload/'.$paciente->uuid.'/imagem/screen/'.$arquivo_nome);

				} else {
					
					$result['status'] = 'error';
					$result['mensagem'] = strip_tags($this->upload->display_errors());

				}
	
			}
	
		}
		echo json_encode($result);
	}

	public function excluir_imagem()
	{
		if (!$this->session->userdata('usurlogged')) exit;

		$result['status'] = 'error';
		$result['mensagem'] = 'Ocorreu um erro';
		
		if ($this->input->post()){
			
			$paciente = $this->paciente_model->buscar_paciente_by_uuid($this->input->post('uuid'));
			
			if (is_object($paciente)) {
				
				$this->pasta_paciente = $paciente->uuid.'/';
				
				if ($this->paciente_model->remove_foto($paciente->id)){ 
					
					excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$paciente->foto);
					excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_thumb.$paciente->foto);
					excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_screen.$paciente->foto);
					
					$result['status'] = 'success';
					$result['mensagem'] = 'Excluído com sucesso';
					$result['url_foto'] = base_url('public/image/foto_default.jpg');
										
				}
				
			}
			
		}
		
		echo json_encode($result);
		
	}

	public function excluir()
	{

		if (!$this->session->userdata('usurlogged')) exit;

		$result['status'] = 'error';
		$result['mensagem'] = 'Ocorreu um erro';

		if ($this->input->post()) {
			
			$paciente = $this->paciente_model->buscar_paciente_by_uuid($this->input->post('uuid'));
			
			if (is_object($paciente)) {

				if ($this->paciente_model->excluir($paciente->id)) {

					$this->pasta_paciente = $paciente->uuid.'/';

					if ($paciente->foto) {

						excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$paciente->foto);
						excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_thumb.$paciente->foto);
						excluir_arquivo($this->pasta_upload.$this->pasta_paciente.$this->pasta_imagem.$this->pasta_imagem_screen.$paciente->foto);

					}

					$this->session->set_flashdata('sucesso_mensagem','Excluído com sucesso');

					$result['status'] = 'success';
					$result['mensagem'] = 'Excluído com sucesso';

				}
			}
		}
		echo json_encode($result);
	}

}
