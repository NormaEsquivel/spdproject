<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_catDocentes extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
		$this->load->model('Model_catDocentes');
	}
    
    public function holaMundo(){
        //echo "Hola mundo!";
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['selTipoPersona']=$this->selTipoPersona();
		$data['selTipoFuncion']=$this->selTipoFuncion();
		$data['selStatus']=$this->selStatus2();
		$data['mun']=$this->selMun();
		$data['con']=$this->selCon();
		$data['Persona']=$this->index();
		$data['ok']=$this->process();
		$puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_catDocentes.php', $data);
		} else {
			$this->load->view('Inicio',$data);
		}		

		
	}
	
	public function selTipoPersona(){
		$Sel="";
		$r = $this->Model_catDocentes->listarTipoPersona();
		if ($r!=false) {
			$Sel.="<select name='TipoPersona' class='form-control'>";
			foreach ($r as $d) {
				//idTipoPersona se codifica en base64 no olvidar decodificar
				$Sel.="<option value='".base64_encode($d['idTipoPersona'])."'>".$d['nombreTipoPersona']."</option>";
			}
			$Sel.="</select>";
			return $Sel;
		} else {
			return "No se consiguieron cargar los datos";
		}		
	}

	public function selTipoFuncion(){
		$Sel="";
		$r = $this->Model_catDocentes->listarTipoFuncion();
		if ($r!=false) {
			$Sel.="<select name='TipoFuncion' class='form-control'>";
			foreach ($r as $d) {
				//idTipoPersona se codifica en base64 no olvidar decodificar
				$Sel.="<option value='".base64_encode($d['idTipoFuncion'])."'>".$d['nombreTipoFuncion']."</option>";
			}
			$Sel.="</select>";
			return $Sel;
		} else {
			return "No se consiguieron cargar los datos";
		}		
	}

	public function selStatus2(){
		$Sel="";
		$r = $this->Model_catDocentes->listarStatus();
		if ($r!=false) {
			return $r;
		} else {
			return "No se consiguieron cargar los datos";
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

	public function selCon(){//Select consideraciones
		$Sel="";
		$r = $this->Model_catDocentes->listarConsideraciones();
		if ($r!=false) {
			return $r;
		} else {
			return "No se consiguieron cargar los datos";
		}		
	}

	//Busqueda
	public function listaPersonas(){
		$Bus=$this->input->get_post('Bus');
		$lista=$this->Model_catDocentes->listaPersonas($Bus);
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

	public function index(){
		//echo "<pre>"; print_r('entra');die();
		switch ($this->input->post('action')) {
			case 'Buscar':
				$BusID = $this->input->post('BusID');
				if (strlen($BusID)) {
					$lista=$this->Model_catDocentes->buscarPersona($BusID);
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
		
		if (strlen($this->input->post('DocentesAct'))>0) {
			@$idPersona = $this->input->post('idPersona');
			$StatusID = $this->input->post('Status');
			$TipoPersonaID = $this->input->post('TipoPersona');
			$TipoFuncionID = $this->input->post('TipoFuncion');
			//echo "<pre>"; echo $TipoPersonaID.' & '.$TipoFuncionID;die();
			$Curp = $this->input->post('Curp');
			$RFC = $this->input->post('RFC');
			$ApellidoPaterno = $this->input->post('ApellidoPaterno');
			$ApellidoMaterno = $this->input->post('ApellidoMaterno');
			$Nombres = $this->input->post('Nombres');
			$Correo = $this->input->post('Correo');
			$Contrasena = $this->input->post('Contrasena');
			$passhash = md5(MY_HASH.md5($Contrasena));
			$telefono = $this->input->post('telefono');
			$telefonoCelular = $this->input->post('telefonoCelular');

			$Calle = $this->input->post('Calle');
			$NumeroExt = $this->input->post('NumeroExt');
			$NumeroInt = $this->input->post('NumeroInt');
			$Cruzamiento1 = $this->input->post('Cruzamiento1');
			$Cruzamiento2 = $this->input->post('Cruzamiento2');
			$Colonia = $this->input->post('Colonia');
			$Municipio = $this->input->post('Municipio');
			$CodigoPostal = $this->input->post('CodigoPostal');

			$tipoFuncionDesempeña = $this->input->post('tipoFuncionDesempeña');
			$dtFechaContrato = $this->input->post('dtFechaContrato');
			@$ConsideracionID = $this->input->post('ConsideracionID');
		}
		switch ($this->input->post('DocentesAct')) {
			case 'agregar':
				$ok=$this->Model_catDocentes->addPersona(base64_decode($StatusID),base64_decode($TipoPersonaID),base64_decode($TipoFuncionID),$Curp,$RFC,$ApellidoPaterno,$ApellidoMaterno,$Nombres,$Correo,$passhash,$telefono,$telefonoCelular,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal,$tipoFuncionDesempeña,$dtFechaContrato,$ConsideracionID);
				return $ok;
				break;
			case 'modificar':
				$StsAnt = $this->Model_catDocentes->getStatus($idPersona);
				$ok=$this->Model_catDocentes->modPersona($idPersona,base64_decode($StatusID),base64_decode($TipoPersonaID),base64_decode($TipoFuncionID),$Curp,$RFC,$ApellidoPaterno,$ApellidoMaterno,$Nombres,$Correo,$Contrasena,$telefono,$telefonoCelular,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal,$tipoFuncionDesempeña,$dtFechaContrato,$ConsideracionID);
				if ($ok) {
					$datosLog=$this->Model_admin->obtenerNavegador();
					$datosLog['timer']=0;					
					// echo "<pre>";
					// echo $StsAnt;
					// die;
					if ($StsAnt != 0 && $StsAnt != base64_decode($StatusID)) {
						$txt = 'CAMBIA STATUS A: '.base64_decode($StatusID).", A: ".base64_decode($idPersona)."-".$ApellidoPaterno." ".$ApellidoMaterno." ".$Nombres;
						// echo "<pre>";
						// echo $txt;
						// die;
						$this->Model_admin->guardarLogUsuario($txt,$datosLog);
					}
				}
				return $ok;
				break;			
			default:
				# code...
				break;
		}
	}
}
?>