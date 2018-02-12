<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Fechas extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
        $this->load->model('Model_Fechas');        
		$this->load->model('Model_catCedes');		
        $this->load->model('Model_asistencia');
    }

    public function index(){
		$data['raiz']=self::INDEX;
        $data['menu']=$this->Model_admin->menu();
        $data['ok']=$this->process();
		$data['Procesos']=$this->listarProcesos();
		$data['Turnos']=$this->listarTurnos();
        $data['Fechas']=$this->listarFechas();        
        $puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_catFechas.php', $data);
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
	
	public function listarTurnos(){
        $r = $this->Model_Fechas->listarTurnos();
        if (count($r) > 0) {
            return $r;
        } else {
            return array();
        }	
    }
	
	public function listarFechas(){
        $r = $this->Model_Fechas->getFechas();
        if (count($r) > 0) {
            return $r;
        } else {
            return array();
        }	
    }

    public function process(){		
		if (strlen($this->input->post('FechasAct'))>0) {			
            $Fecha = $this->input->post('Fecha');
            $Hora = $this->input->post('Hora');
            $CicloEscolar = $this->input->post('CicloEscolar');
            $CicloEscolarID = $this->Model_Fechas->getCE($CicloEscolar);
            $Proceso = $this->input->post('Proceso');
            $Turno = $this->input->post('Turno');
			// echo "<pre>"; echo $Fecha." ".$Hora.' & '.$CicloEscolarID.' & '.$Proceso.' & '.$Turno;die();
		}
		switch ($this->input->post('FechasAct')) {
            case 'agregar':
                $existe=$this->Model_Fechas->validaFecha($Fecha,$CicloEscolarID,$Proceso,$Turno);
                if ($existe) {
                    return 2;//Existe la fecha
                } else {
                    $ok=$this->Model_Fechas->addFecha($Fecha.' '.$Hora,$CicloEscolarID,$Proceso,$Turno);
                    return ($ok?$ok:2);
                }
				break;			
			default:
				# code...
				break;
		}
	}
	
}
?>