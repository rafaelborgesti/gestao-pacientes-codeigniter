<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_pacientes(){

		return $this->db->from("paciente")->get()->result();

    }
}