<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_layoutFechas extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
		$this->load->model('Model_layoutFechas');

	}
    
    public function index(){
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['fechas']=$this->buscarFechas();
		//$data['ok']=$this->process();
		//echo "<pre>"; print_r($data['xx']);die();
		// $puede = FALSE;
		// foreach ($this->session->userdata('permisos') as $d) {
		// 	if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
		// 		$puede = true;
		// 	}
		// }
		// if ($puede) {
		 	$this->load->view('vw_layoutFechas.php', $data);
		// } else {
		// 	$this->load->view('Inicio',$data);
		// }	
		
    }

    //Busqueda
	public function buscarFechas(){
        $lista=$this->Model_layoutFechas->buscarFechas();
        return $lista;
    }
}
?>