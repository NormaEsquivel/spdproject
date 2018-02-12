<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_docente extends CI_Controller {

	const INDEX="/spdproject/";

	public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->library('encrypt');
		$this->load->model('Model_admin');
		$this->load->model('Model_docente');
	}

	public function index()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['resultExamen'] = $this->Model_docente->ResultadoExamenHistorico();
	 	$this->load->view('HistoricoDocente',$data);
	}

}