<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_asistencia extends CI_Controller {

    const INDEX="/spdproject/";

    public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->model('Model_admin');
		$this->load->model('Model_asistencia');

	}
    
    public function impindex(){
		$data['raiz']=self::INDEX;
		$data['menu']=$this->Model_admin->menu();
		$data['info']=$this->subirArchivo();
		//$data['ok']=$this->process();
        //echo "<pre>"; print_r($data['xx']);die();
        $puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {
			$this->load->view('vw_impasistencia.php', $data);
		} else {
			$this->load->view('Inicio',$data);
		}	
		
    }

    public function subirArchivo(){
        $errores="Incidencias:<br>";
        @$action = $this->input->post('action');
        if($action = "subirtxt"){

            $rutaEnServidor = $_SERVER['DOCUMENT_ROOT'].self::INDEX."resources/DocumentosTMP/";
            @$tipo = $_FILES["file"]['type'];
            @$rutaTemporal=$_FILES['file']['tmp_name'];
            @$nombre = $_FILES["file"]['name'];
            @$archivo=$rutaEnServidor.$nombre;
            $datos_asist = array();
            $asist = array();
            $cont_txt = 0;

            if ($tipo == "text/plain"){
                move_uploaded_file($rutaTemporal, $archivo);
                if (file_exists($archivo)) {
                    $fp = fopen($archivo, "r");
                    while(!feof($fp)) {
                        $linea = fgets($fp);
                        if (strlen($linea)>0) {
                            $asist = explode("|",$this->limpiar_metas(utf8_encode($linea)));
                            $rfc = $asist[0];
                            $CedeID = $this->Model_asistencia->getCede($asist[2]);
                            $Asistio = $asist[4];
                            $Entrada = $asist[5];
                            $Salida = $asist[6];
                            $turno = $asist[3];
                            //echo "<pre>";
                            $date = explode("/",$asist[1]);
                            $Fecha = date("Y-m-d",strtotime($date[1]."/".$date[0]."/".$date[2]));
                            $d = $this->Model_asistencia->validar($rfc,$Fecha,$turno);
                            //print_r($asist);
                            if(count($d) > 0){
                                //print_r($d);
                                $PersonaID = $d[0]['idPersona'];
                                $FechaID = $d[0]['FechaID'];
                                $CedeAsig = $d[0]['CedeID'];
                                $ok = $this->Model_asistencia->validar2($PersonaID,$FechaID);
                                //echo ($ok?1:0);
                                if ($ok) {
                                    if ($CedeID > 0) {
                                        $ok2 = $this->Model_asistencia->addAsistencia($PersonaID,$FechaID,$CedeID,($CedeID!=$CedeAsig?1:0),$Asistio,$Entrada,$Salida);
                                        $errores .=($ok2?"":$rfc." no se guardo la asistencia para el ".$asist[1]." en el turno ".$turno."<br>");
                                    } else {
                                        $errores .= "Cede incorrecta para ".$rfc." en asistencia para el ".$asist[1]." en el turno ".$turno."<br>";
                                    }
                                    
                                } else {
                                    $errores .= $rfc." ya tiene asistencia para el ".$asist[1]." en el turno ".$turno."<br>";
                                }
                            } else {
                                $errores .= $rfc." no tiene fecha asignada para el ".$asist[1]." en el turno ".$turno."<br>";
                            }
                        }
                    }
                    fclose($fp);
                }else{
                    echo "el archivo no existe";
                }    
                
                if (unlink($archivo)) {
                    #echo "el archivo se ha eliminado correctamente";
                }else{
                    echo "hubo un error al eliminar el archivo ".$archivo;
                } 
            }
        }
        return $errores;
    }
    
    function limpiar_metas($string,$corte = null){
        $caracters_no_permitidos = array('"',"'","ï","»","¿","?");
        # paso los caracteres entities tipo &aacute; $gt;etc a sus respectivos html
        $s = html_entity_decode($string,ENT_COMPAT,'UTF-8');
        # quito todas las etiquetas html y php
        $s = strip_tags($s);
        # elimino todos los retorno de carro
        //$s = str_replace("r", '', $s);
        # en todos los espacios en blanco le añado un <br /> para después eliminarlo
        $s = preg_replace('/(?<!>)n/', "<br />n", $s);
        # elimino la inserción de nuevas lineas
        //$s = str_replace("n", '', $s);
        # elimino tabulaciones y el resto de la cadena
        //$s = str_replace("t", '', $s);
        # elimino caracteres en blanco
        $s = preg_replace('/[ ]+/', ' ', $s);
        $s = preg_replace('/<!--[^-]*-->/', '', $s);
        # vuelvo a hacer el strip para quitar el <br /> que he añadido antes para eliminar las saltos de carro y nuevas lineas
        $s  = strip_tags($s);
        # elimino los caracters como comillas dobles y simples
        $s = str_replace($caracters_no_permitidos,"",$s);
         
        if (isset($corte) && (is_numeric($corte))){
            $s = mb_substr($s,0,$corte, 'UTF-8');
        }
                 
        return $s;
    }

    public function asistenciaindex(){
		$data['raiz']=self::INDEX;
        $data['menu']=$this->Model_admin->menu();
        $data['Procesos']=$this->listarProcesos();
        $data['Asistencias']=$this->listarAsistencias();
        $puede = FALSE;
		foreach ($this->session->userdata('permisos') as $d) {
			if ($d['urlMenu'] == substr($_SERVER['PATH_INFO'],1)) {
				$puede = true;
			}
		}
		if ($puede) {            
			$this->load->view('vw_asistencia.php', $data);
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

    public function listarAsistencias(){
        switch ($this->input->post('action')) {
			case 'buscar':
                $BusID = $this->input->post('Proceso');
				if (strlen($BusID)>0) {
					$r = $this->Model_asistencia->getAsistencias($BusID);
                    if (count($r) > 0) {
                        return array(
                            'Sel' => $BusID,
                            'Datos' => $r
                        );
                    } else {
                        return array(
                            'Sel' => $BusID,
                            'Datos' => array()
                        );
                    }
				} else {
					return array(
                        'Sel' => 1,
                        'Datos' => array()
                    );
				}
				break;
			
			default:
				# code...
				break;
		}
    }
    
}
?>