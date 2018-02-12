<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_catCedes extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
		$this->load->model('Model_catCedes');
		$this->load->model('Model_catDocentes');

	}
    
    public function index(){
        //echo "Hola mundo!";
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
        $data['CedeDat']=$this->BucarCede();
		$data['ok']=$this->process();
		$data['mun']=$this->selMun();
		//echo "<pre>"; print_r($data['xx']);die();
		$puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_catCedes.php', $data);
		} else {
			$this->load->view('Inicio',$data);
		}	
        
    }

    //Busqueda
	public function listaCedes(){
        $Bus=$this->input->get_post('Bus');
        //echo "<pre>"; print_r($Bus);die(); 
		$lista=$this->Model_catCedes->listaCedes($Bus);
		$arr=array();
		if($lista){
			foreach($lista as $d){
				// $arr[] = $d['Persona'];
				$data[] = array("label" => utf8_encode($d['Nombre']),
				"value" => $d['CedeID']);
			}
			echo json_encode($data);
		}
	}
	
	public function selMun(){
		$Sel="";
		$r = $this->Model_catDocentes->listarMun();
		if ($r!=false) {
			return $r;
		} else {
			return "No se consiguieron cargar los datos";
		}		
	}
    
    public function BucarCede(){
        //
        switch ($this->input->post('action')) {
            case 'Buscar':
                $BusID = $this->input->post('BusID');
                //echo "<pre>"; print_r($BusID);die();
                if (strlen($BusID)) {
                    $lista=$this->Model_catCedes->buscarCede($BusID);
                    //echo "<pre>"; print_r($lista);die();
                    return $lista;
                } else {
                    return false;
                }
            break;
            default:
            # code...
            break;
        }
    }

    public function process(){
		
		if (strlen($this->input->post('CedesAct'))>0) {
			@$CedeID = $this->input->post('CedeID');
			$Nombre = $this->input->post('Nombre');
			$Telefono = $this->input->post('Telefono');
			$Calle = $this->input->post('Calle');
			//echo "<pre>"; echo $TipoPersonaID.' & '.$TipoFuncionID;die();
			$NumeroExt = $this->input->post('NumeroExt');
			$NumeroInt = $this->input->post('NumeroInt');
			$Cruzamiento1 = $this->input->post('Cruzamiento1');
			$Cruzamiento2 = $this->input->post('Cruzamiento2');
			$Colonia = $this->input->post('Colonia');
			$Municipio = $this->input->post('Municipio');
			$CodigoPostal = $this->input->post('CodigoPostal');
		}
		switch ($this->input->post('CedesAct')) {
			case 'agregar':
                $ok=$this->Model_catCedes->addCede($Nombre,$Telefono,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal);
				return $ok;
				break;
			case 'modificar':
				$ok=$this->Model_catCedes->modCede(base64_decode($CedeID),$Nombre,$Telefono,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal);
				return $ok;
				break;
			
			default:
				# code...
				break;
		}
	}

}
?>