<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_seleccion extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
        $this->load->model('Model_seleccion');
        $this->load->model('Model_asistencia');

    }

    public function index(){
		$data['raiz']=self::INDEX;
        $data['menu']=$this->Model_admin->menu();
        $data['Procesos']=$this->listarProcesos();
        $puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_seleccion.php', $data);
		} else {
			$this->load->view('Inicio',$data);
		}		
    }

    public function listarProcesos(){
        $r = $this->Model_asistencia->procesos();
        if (count($r) > 0) {
            return $r;
        } else {
            return array();
        }	
    }
}
?>