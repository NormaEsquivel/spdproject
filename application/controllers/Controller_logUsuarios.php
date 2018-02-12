<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_logUsuarios extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
		$this->load->model('Model_logUsuarios');

	}
    
    public function index(){
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['logs']=$this->CargarLogsXUsuario();
		//$data['ok']=$this->process();
		//echo "<pre>"; print_r($data['xx']);die();
		$puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_logUsuarios.php', $data);
		} else {
			$this->load->view('Inicio',$data);
		}	
		
    }

    //Busqueda
	public function listarlogs(){
		$Bus=$this->input->get_post('Bus');
		$lista=$this->Model_logUsuarios->listarlogs($Bus);
		$arr=array();
		if($lista){
			foreach($lista as $d){
				// $arr[] = $d['Persona'];
				$data[] = array("label" => utf8_encode($d['Persona']),
				"value" => $d['idPersona']);
			}
			echo json_encode($data);
		}
    }
    
    //Busqueda
    public function CargarLogsXUsuario(){
        switch ($this->input->post('action')) {
			case 'Buscar':
				$BusID = $this->input->post('BusID');
				if (strlen($BusID)>0) {
					$lista=$this->Model_logUsuarios->BuscarLogsXUsuario($BusID);
					//echo "<pre>"; print_r($lista);die();
					return $lista;
				} else {
					return array();
				}
				break;
			
			default:
				# code...
				break;
		}
    }
}
?>