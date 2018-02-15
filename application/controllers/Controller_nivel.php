<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_nivel extends CI_Controller {

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
		$this->load->model('Model_nivel');
        $this->load->model('Model_Fechas');
	}

	public function index()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$data['listaModificacion']=$this->Model_nivel->listaModificaciones();
			$this->load->view('Modificaciones',$data);
		} else {
			$this->load->view('Inicio',$data);
		}	
	 	
	}

	public function validarModificacion($num="")
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$usuariomodificacion=$this->Model_nivel->ObtenModificacion($num);
		$data['id'] = $num;
		$data['curp'] = $usuariomodificacion[0]['CURP'];
		$data['rfc'] = $usuariomodificacion[0]['RFC'];
		$data['primernombre'] = $usuariomodificacion[0]['primerNombre'];
		$data['primerapellido'] = $usuariomodificacion[0]['primerApellido'];
		$data['segundoapellido'] = $usuariomodificacion[0]['segundoApellido'];
		$data['telefono'] = $usuariomodificacion[0]['telefonoCelular'];
		$data['email'] = $usuariomodificacion[0]['correoElectronico'];
		$data['curpant'] = $usuariomodificacion[0]['curpant'];
		$data['rfcant'] = $usuariomodificacion[0]['rfcant'];
		$data['primernombreant'] = $usuariomodificacion[0]['primerNombreant'];
		$data['primerapellidoant'] = $usuariomodificacion[0]['primerApellidoAnt'];
		$data['segundoapellidoant'] = $usuariomodificacion[0]['segundoApellidoAnt'];
		$data['telefonoant'] = $usuariomodificacion[0]['telefonoCelularant'];
		$data['emailant'] = $usuariomodificacion[0]['correoElectronicoant'];
		$CicloEscolarID = $this->Model_Fechas->getCE(date("Y"));		
		$data['ok']=$this->process($num,$CicloEscolarID);
		$data['cts'] = $this->getcts($num,$CicloEscolarID);
	 	$this->load->view('FormularioModificaciones',$data);
	}

	public function cambios()
	{
		$inputs=$this->input->get_post('inputs');
		$typein=$this->input->get_post('typein');
		$idPersona=$this->input->get_post('idPersona');

		$inputssub=substr($inputs, 0, -1);
		$inputsexp=explode(',', $inputssub);

		$arr1=array();
		foreach ($inputsexp as $keyinex => $valueinex) {
			$div=explode('|', $inputsexp[$keyinex]);
			$arr1[$div[1]]=$div[0];
		}
		//print_r($arr1);die();
		$arr2=array('idPersona'=>$idPersona, 'valor' =>$typein);
		$arrayFULL=array_merge($arr1,$arr2);

		if($typein == 2)
		{
			$status=$this->Model_nivel->Modificando($arrayFULL);

		}elseif($typein == 1)
		{
			$status=$this->Model_nivel->Modificando($arrayFULL);
		}
		print_r($status);die();
	}

	public function getcts($PersonaID,$CE){//CE = año actual para pruebas esta en 2017
		$r = $this->Model_nivel->getcts($PersonaID,3);
        if (count($r) > 0) {
            return $r;
        } else {
            return array();
        }
	}

	public function process($PersonaID,$CicloEscolarID){		
		if (strlen($this->input->post('ctAct'))>0) {			
			@$pctID = $this->input->post('pctID');
			@$ctID = $this->input->post('BusID');
		}
		switch ($this->input->post('ctAct')) {
            case 'eliminar':
                $ok=$this->Model_nivel->eliminarelacion($pctID);
				//echo "<pre>"; echo $ok;die();
                return $ok;
			break;
			case 'agregar':			
				//echo "<pre>"; echo $ctID." | ".$PersonaID." | ".$CicloEscolarID;die();
				$existe = $this->Model_nivel->comparaRelacion($ctID,$PersonaID,3);
				if (!$existe) {
					$ok = $this->Model_nivel->agregarrelacion($ctID,$PersonaID,3);
					return $ok;
				} else {
					return FALSE;
				}
			break;
			case 'activar':
			$ok=$this->Model_nivel->negar_cts($PersonaID,3);
			$ok=$this->Model_nivel->activar_ct($pctID);
			//echo "<pre>"; echo $ok;die();
			return $ok;
		break;			
			default:
				# code...
				break;
		}
	}

	//Busqueda
	public function listarCTs(){
        $Bus=$this->input->get_post('Bus');
        //echo "<pre>"; print_r($Bus);die(); 
		$lista=$this->Model_nivel->listaCTs($Bus);
		$arr=array();
		if($lista){
			foreach($lista as $d){
				// $arr[] = $d['Persona'];
				$data[] = array("label" => utf8_encode($d['CCT']),
				"value" => $d['idCCT']);
			}
			echo json_encode($data);
		}
	}

	public function getDirector($ctID,$CE){
		$r = $this->Model_nivel->getcts($ctID,3);
		return $r;
	}

}