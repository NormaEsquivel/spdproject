<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_admin extends CI_Controller {

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
	}

	public function index()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
 		if($this->input->post('Ingresar') != 'Ingresar')
 		{
 			if($this->session->userdata('status') == "logged")
			{
				$data['nombreUsuario']=$this->session->userdata('primerNombre').' '.$this->session->userdata('primerApellido').' '.$this->session->userdata('segundoApellido');
				$data['idPersona']=$this->session->userdata('idPersona');

				if($this->session->userdata('cnombreImagen') == null)
				{$data['foto']="usuario.png";}
				else
				{$data['foto']=$this->session->userdata('cnombreImagen');}

				$datosLog=$this->Model_admin->obtenerNavegador();
				$datosLog['timer']=0;
				$this->Model_admin->guardarLogUsuario('INGRESAR',$datosLog);
				$this->load->view('Inicio',$data);
			}
			else
 			{
 				$data['captcha']= self::generarCaptcha();
 				$data['error']="";
 				$this->load->view('Login',$data);
 			}
 		}
 		if($this->input->post('Ingresar') == 'Ingresar')
 		{
 			/*echo '<pre>';print_r($this->input->post('password'));
 			echo '<pre>';print_r($this->input->post('usuario'));die();*/
 			$contrasena= md5(MY_HASH.md5($this->input->post('password')));
 			//echo '<pre>';print_r($VerificarUsuario);die();
 			$VerificarUsuario= $this->Model_admin->ObtenerUsuario($this->input->post('usuario'),$contrasena);
 			//echo '<pre>';print_r($contrasena);die();
 			if($VerificarUsuario){	
 				$captcha= md5(CAPTCHA_HASH.md5($this->input->post('captcha')));
 				$checa= md5(CAPTCHA_HASH.md5($this->session->userdata('c_wd')));
 				
 				if($captcha == $checa){
					$arr = $this->Model_admin->validarPermisos($VerificarUsuario[0]['idTipoPersona']);
					//echo "<pre>";
					//print_r($arr);
					//echo "holi";
					//die;
 					$datosUsu = array(
 						'idPersona' => $VerificarUsuario[0]['idPersona'],
 						'idTipoPersona' => $VerificarUsuario[0]['idTipoPersona'],
 						'primerNombre'=> $VerificarUsuario[0]['primerNombre'],
 						'segundoNombre'=>$VerificarUsuario[0]['segundoNombre'],
 						'primerApellido'=>$VerificarUsuario[0]['primerApellido'],
 						'segundoApellido'=>$VerificarUsuario[0]['segundoApellido'],
 						'correoElectronico'=>$VerificarUsuario[0]['correoElectronico'],
 						'fotoUsuario'=>$VerificarUsuario[0]['fotoUsuario'],
 						'CURP'=>$VerificarUsuario[0]['CURP'],
 						'NivelID' => $VerificarUsuario[0]['NivelID'],
						'status' =>'logged',
						'permisos' => $arr); 

 					$this->session->set_userdata($datosUsu);
 					if($this->session->userdata('status') == "logged"){
 						$data['nombreUsuario']=$this->session->userdata('primerNombre').' '.$this->session->userdata('primerApellido').' '.$this->session->userdata('segundoApellido');
 						$data['idPersona']=$this->session->userdata('idPersona');

 						if($this->session->userdata('cnombreImagen') == null)
 						{$data['foto']="usuario.png";}
	 					else
	 					{$data['foto']=$this->session->userdata('cnombreImagen');}

	 					$datosLog=$this->Model_admin->obtenerNavegador();
 						$datosLog['timer']=0;
 						$this->Model_admin->guardarLogUsuario('INGRESAR',$datosLog);
 						$data['menu']=$this->Model_admin->menu();
	 					$this->load->view('Inicio',$data);
	 				}
					
 				}else
 				{
 					$data['captcha']= self::generarCaptcha();
		 			$data['error']="La imagen no coincide con el resultado";
		 			$this->load->view('Login',$data);
 				}
 			}
 			else
 			{
 				$data['captcha']= self::generarCaptcha();
 				$data['error']="Verifique el usuario o contraseña";
 				$this->load->view('Login',$data);
 			}
 		}
	}

	private function generarCaptcha()
	{
		return $this->Model_admin->captcha();
	}

	public function formulario($vari='')
	{
		$data['raiz']=self::INDEX;
		$this->load->view('', $data);
	}

	public function salir()
	{
		$datosLog=$this->Model_admin->obtenerNavegador();
		$datosLog['timer']=0;
		$this->Model_admin->guardarLogUsuario('SALIR',$datosLog);
		$this->session->sess_destroy();
		redirect();
	}

	public function participantes()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();

		$araypar = array();
		
		if(!empty($this->input->get_post('selectes')) || !empty($this->input->get_post('inputext')))
		{
			$cadena=$this->input->get_post('selectes');
			$cadenasub=substr($cadena, 0 , -1);
			$cadenaexpl=explode(',', $cadenasub);
			
			foreach ($cadenaexpl as $keycade => $valcade) {
				$div=explode('|', $cadenaexpl[$keycade]);
				$araypar[$div[0]]=$div[1];
			}

			$cadenados=$this->input->get_post('inputext');
			$cadenadossub=substr($cadenados, 0 , -1);
			$cadenadosexpl=explode(',', $cadenadossub);
			
			foreach ($cadenadosexpl as $keycadedos => $valcadedos) {
				$divd=explode('|', $cadenadosexpl[$keycadedos]);
				$araypar[$divd[0]]=$divd[1];
			}

			$this->session->set_userdata($araypar);
		}

		$data['listaparticipantes']= $this->Model_admin->listaParticipantes($araypar);

		$data['listaGrados']=$this->Model_admin->obtenerGrados();
		$data['listaGrupos']=$this->Model_admin->obtenerGrupos();
		$data['ListaResPrela']=$this->Model_admin->obtenerResultadoPrelacion();
		$data['ListaCicloEscolar']=$this->Model_admin->obtenerCicloEscolar();
	 	$this->load->view('ListaParticipantes',$data);
	}

	public function resultados()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		
		$aray = array();
		
		if(!empty($this->input->get_post('selectes')) || !empty($this->input->get_post('inputext')))
		{
			$cadena=$this->input->get_post('selectes');
			$cadenasub=substr($cadena, 0 , -1);
			$cadenaexpl=explode(',', $cadenasub);
			
			foreach ($cadenaexpl as $keycade => $valcade) {
				$div=explode('|', $cadenaexpl[$keycade]);
				$aray[$div[0]]=$div[1];
			}

			$cadenados=$this->input->get_post('inputext');
			$cadenadossub=substr($cadenados, 0 , -1);
			$cadenadosexpl=explode(',', $cadenadossub);
			
			foreach ($cadenadosexpl as $keycadedos => $valcadedos) {
				$divd=explode('|', $cadenadosexpl[$keycadedos]);
				$aray[$divd[0]]=$divd[1];
			}

			$this->session->set_userdata($aray);
		}

		$data['listaGrados']=$this->Model_admin->obtenerGrados();
		$data['listaGrupos']=$this->Model_admin->obtenerGrupos();
		$data['ListaResPrela']=$this->Model_admin->obtenerResultadoPrelacion();
		$data['ListaCicloEscolar']=$this->Model_admin->obtenerCicloEscolar();

		$data['ListaResultados']=$this->Model_admin->listaresultados($aray);
		
		$puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('ListaResultados',$data);
		} else {
			$this->load->view('Inicio',$data);
		}
	 	
	}

	public function modificarResultado(){
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		switch ($this->input->post('ResultadosAct')) {
			case 'modificar':
				// $ok=$this->Model_catDocentes->modPersona($idPersona,base64_decode($StatusID),base64_decode($TipoPersonaID),base64_decode($TipoFuncionID),$Curp,$RFC,$ApellidoPaterno,$ApellidoMaterno,$Nombres,$Correo,$Contrasena,$telefono,$telefonoCelular,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal,$tipoFuncionDesempeña,$dtFechaContrato,$ConsideracionID);
				// return $ok;
				
				$GrupoDesempeño = $this->input->post('GrupoDesempeño');
				$Motivo = $this->input->post('Motivo');
				$resultadoID = $this->input->post('ResultadoID');
				$UsuarioID = $this->input->post('ModID');
				
				$this->Model_admin->modResultado($GrupoDesempeño,$Motivo,$resultadoID,$UsuarioID);
				$data['listaGrados']=$this->Model_admin->obtenerGrados();
				$data['listaGrupos']=$this->Model_admin->obtenerGrupos();
				$data['ListaResPrela']=$this->Model_admin->obtenerResultadoPrelacion();
				$data['ListaCicloEscolar']=$this->Model_admin->obtenerCicloEscolar();
				$data['ListaResultados']=$this->Model_admin->listaresultados();
				$this->load->view('ListaResultados',$data);
				break;			
			default:
				# code...
				break;
		}
	}

	public function importacionresultados()
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		
	 	$this->load->view('ImportacionResultados',$data);
	}

	public function importandoExcel()
	{
		/*------------------------------------------- uno -----------------------------------*/

		$fechaObj = new DateTime('NOW');
		$fechaMod = $fechaObj->format('Y-m-d');
		extract($_POST);
		$tamano = $_FILES["file"]['size'];
		$tipo = $_FILES["file"]['type'];
		$archivo = $_FILES["file"]['name'];
		$destino = "resources/Documentos/bak".'_'.$fechaMod.'_'.$archivo;
		copy($_FILES['file']['tmp_name'],$destino);
		$n = 0;
		$status = 'ERROR';
		//$cabeceras = array( 'Folio','Proceso','Fecha de uso (YYYY-MM-DD)','A','B','C','D','Dificultad','Discriminación','Punto biserial','Punto biserial corregido','a (discriminación)','a SD','b (dificultad)','b SD','ᵡ2','gl','p-valor','DIF','p-valor','Grupo favorecido','Comentarios');
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(in_array($_FILES['file']['type'],$mimes))
		{
			if ($_FILES["file"]["error"] > 0) 
			{
			    redirect('importacionresult', 'refresh');
			  	die();
			}
			else 
			{
			    $nombre = explode('.', $_FILES["file"]["name"]);
			    $ext = strtolower( end($nombre) );
			}
		}else 
		{
			redirect('importacionresult', 'refresh');
		  	die();
		}
		//FECHA 'AHORA'
		$fechaObj = new DateTime('NOW');
		$fechaMod = $fechaObj->format('Y-m-d');

		//readFile($_FILES["fileCSV"]["tmp_name"]);
		$file = $_FILES["file"]["tmp_name"];
		if(empty($file)){return FALSE;}
		require_once APPPATH."/third_party/Simplexlsx.php";

		$continuar = FALSE;
		switch ($ext) 
		{
			case 'xlsx':
				$xlsx = new SimpleXLSX($file);
				foreach ($xlsx->rows() as $key => $value) {
					if($key == 0){ 
						//if($value = $cabeceras){
							$continuar = TRUE;
						//}
					}else{
						if($continuar){
							if(!empty($value[0])){
								$totalData[] = $value;
							}
						}	
					}
				}
				//print_r($totalData);die();
				$res = $this->Model_psicometra->importarExcelPsicometra($totalData);
				if($res > 0){
					$status = 'OK';
					$n = $res;
				}
				break;
			case 'csv':
				if (file_exists($destino)){
					$handle = fopen($destino, "r");
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
					{
						print_r($data);
					}die();
				}
				else{
					echo "Necesitas primero importar el archivo";
				}
			case "xls":
			default:
				$status = 'ERROR';
				break;
		}
	}

	public function perfil($cambio=0)
	{
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['cambio']=$cambio;
		$datosPersona=$this->Model_admin->obtenerPersona();
		if($datosPersona)
		{
			$data['curp'] = $datosPersona[0]['CURP'];
			$data['rfc'] = $datosPersona[0]['RFC'];
			$data['correoElectronico'] = $datosPersona[0]['correoElectronico'];
			$data['telefonoCelular'] = $datosPersona[0]['telefonoCelular'];
			$data['primerNombre'] = $datosPersona[0]['primerNombre'];
			$data['primerApellido'] = $datosPersona[0]['primerApellido'];
			$data['segundoApellido'] = $datosPersona[0]['segundoApellido'];
		}
		$this->load->view('Perfil',$data);
	}

	public function subirFotoPerfil()
	{
		$datosUsuario=$this->Model_admin->obtenerPersona();

		if($datosUsuario[0]['primerNombre'] != $this->input->get_post('Nombre') || $datosUsuario[0]['primerApellido'] != $this->input->get_post('Apaterno') || $datosUsuario[0]['segundoApellido'] != $this->input->get_post('AMaterno') || $datosUsuario[0]['CURP'] != $this->input->get_post('Curp') || $datosUsuario[0]['RFC'] != $this->input->get_post('rfc') || $datosUsuario[0]['correoElectronico'] != $this->input->get_post('email') || $datosUsuario[0]['telefonoCelular'] != $this->input->get_post('phone'))
			{
				if(!empty($this->input->get_post('Nombre')) || !empty($this->input->get_post('Apaterno')) || !empty($this->input->get_post('AMaterno')) || !empty($this->input->get_post('Curp')) || !empty($this->input->get_post('rfc')) || !empty($this->input->get_post('email')) || !empty($this->input->get_post('phone')))
				{
					$datosn=array(
					'Nombre'=>$this->input->get_post('Nombre'),
					'Apaterno'=>$this->input->get_post('Apaterno'),
					'AMaterno'=>$this->input->get_post('AMaterno'),
					'Curp'=>$this->input->get_post('Curp'),
					'rfc'=>$this->input->get_post('rfc'),
					'email'=>$this->input->get_post('email'),
					'phone'=>$this->input->get_post('phone')
					);
				}
			}
		$tamano = $_FILES["file"]['size'];
		$tipo = $_FILES["file"]['type'];
		$archivo = $_FILES["file"]['name'];
		$prefijo = substr(md5(uniqid(rand())),0,6);
		if ($archivo != "") {
		    // guardamos el archivo a la carpeta files
		    $destino =  "resources/profile/".$archivo;
		    $datosUsu = array(
				'fotoUsuario'=>$archivo);
		    if($datosn)
		    {
		    	$datosnuevo=array_merge($datosn,$datosUsu);
		    }
		    else
		    {
		    	$datosnuevo=$datosUsu;
		    }
		    $this->Model_admin->modificaFoto($datosnuevo);

		    if (copy($_FILES['file']['tmp_name'],$destino)) {
		    	
				$this->session->set_userdata($datosUsu);
		        redirect('miperfil/1');
		    } else {
		        $status = "Error al subir el archivo";
		    }
		} else {
			
			$datosUsu = array(
				'fotoUsuario'=>$this->session->userdata('fotoUsuario'));

		    if($datosn)
		    {
		    	$datosnuevo=array_merge($datosn,$datosUsu);
		    }
		    else
		    {
		    	$datosnuevo=$datosUsu;
		    }
		    $status=$this->Model_admin->modificaFoto($datosnuevo);

		    //$status = "Error al subir archivo";
		}

		print_r($status);
		redirect('miperfil/1');
	}

	public function listaCCTs()
	{
		$clavect=$this->input->get_post('term');
		$lista=$this->Model_admin->listaCCT($clavect);
		$arr=array();
		if($lista)
		{
			foreach($lista as $keycct => $valorcct)
				{
					$arr[] = $lista[$keycct]['CCT'];
				}
			echo json_encode($arr);
		}
	}

	public function listaCURP()
	{
		$ClaveURP=$this->input->get_post('term');
		$lista=$this->Model_admin->listaCURP($ClaveURP);
		$arr=array();
		if($lista)
		{
			foreach($lista as $keycct => $valorcct)
				{			
					$arr[] = $lista[$keycct]['CURP'];
				}
			echo json_encode($arr);
		}
	}

	public function listaRFC()
	{
		$claveRFC=$this->input->get_post('term');
		$lista=$this->Model_admin->listaRFC($claveRFC);
		$arr=array();
		if($lista)
		{
			foreach($lista as $keycct => $valorcct)
				{			
					$arr[] = $lista[$keycct]['RFC'];
				}
			echo json_encode($arr);
		}
	}

	public function listarPermisos($tipoPersona){
		$lista=$this->Model_admin->validarPermisos($tipoPersona);
		print_r($lista);
	}

	public function fechas($fechaentera='')
	{
		$divf=explode('-', $fechaentera);
		$dia=$divf[2];
		$mes=$divf[1];
		$anio=$divf[0];

		switch ($mes) {
			case '1':
				$lafecha= $dia.' de Enero de '.$anio;
			break;
			case '2':
				$lafecha= $dia.' de Febrero de '.$anio;
			break;
			case '3':
				$lafecha= $dia.' de Marzo de '.$anio;
			break;
			case '4':
				$lafecha= $dia.' de Abril de '.$anio;
			break;
			case '5':
				$lafecha= $dia.' de Mayo de '.$anio;
			break;
			case '6':
				$lafecha= $dia.' de Junio de '.$anio;
			break;
			case '7':
				$lafecha= $dia.' de Julio de '.$anio;
			break;
			case '8':
				$lafecha= $dia.' de Agosto de '.$anio;
			break;
			case '9':
				$lafecha= $dia.' de Septiembre de '.$anio;
			break;
			case '10':
				$lafecha= $dia.' de Octubre de '.$anio;
			break;
			case '11':
				$lafecha= $dia.' de Noviembre de '.$anio;
			break;
			case '12':
				$lafecha= $dia.' de Diciembre de '.$anio;
			break;

			default:
			$lafecha="";
			break;
		}

		return $lafecha;
  	}

	public function listaNomina()
	{
		$data['raiz']=self::INDEX;
		$data['arrNomina']=$this->Model_admin->listaNomnina();
		$data['menu']=$this->Model_admin->menu();
		$this->load->view('vistaNomina', $data);
	}
}