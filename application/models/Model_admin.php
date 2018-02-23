<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_admin extends CI_Model
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function captcha()
		{

			#create image and set background color
			$captcha = imagecreatetruecolor(120,60);
			$colorR = rand(0,80);
			$colorG = rand(0,80);
			$colorB = rand(0,80);
			$background_color = imagecolorallocate($captcha, $colorR, $colorG, $colorB);
			imagefill($captcha, 0, 0, $background_color);
			
			#draw some lines
			for($i=0;$i<10;$i++){
				$colorR = rand(48,96);
				$colorG = rand(48,96);
				$colorB = rand(48,96);
				imageline($captcha, rand(0,130),rand(0,60), rand(0,130), rand(0,60),imagecolorallocate($captcha, $colorR, $colorG, $colorB));
			}
			

			//Generacion DP

			$number1 = rand(1, 9);
		    $result = 0;
		    $sign = rand(0, 3); //0:+,1:-,2:*,3:/
		    $number2;
		    $string = strval($number1);
		    $result = $number1;
		    switch ($sign)
		    {
		        case 0:
		            $string .= "+";
		            $number2 = rand(1, 9);
		            $result += $number2;
		            $string .= strval($number2);
		            break;
		        case 1:
		            $string .= "-";
		            $number2 = rand(1, $number1 );
		            $result -= $number2;
		            $string .= strval($number2);
		            break;
		        case 2:
		            $string .= "*";
		            $number2 = rand(1, 9);
		            $result *= $number2;
		            $string .= strval($number2);
		            break;
		        case 3:
		            $string .= utf8_decode("÷");
		            $number2 = rand(1, $number1 );
		            while (($number1%$number2) != 0)
		            {
		                $number2 = rand(1, $number1 );
		            }
		            $result /= $number2;
		            $string .= strval($number2);
		            break;
		    }

			#place each character in a random position
			putenv('GDFONTPATH=' . realpath('.'));
			$font = './arial.ttf';
			//echo file_exists($font);
			for($i=0;$i<strlen($string);$i++){
				$colorR = rand(100,255);
				$colorG = rand(100,255);
				$colorB = rand(100,255);
				if(file_exists($font)){
					$x=20+$i*30+rand(0,6);
					$y=15+rand(18,28);
					imagettftext($captcha, 30, rand(-25,25), $x, $y, imagecolorallocate($captcha, $colorR, $colorG, $colorB), $font, $string[$i]);
				}else{
					$x=20+$i*30+rand(0,6);
					$y=15+rand(1,18);
					imagestring($captcha, 24, $x, $y, $string[$i], imagecolorallocate($captcha, $colorR, $colorG, $colorB));
				}
			}
			$matrix = array(array(1, 1, 1), array(2.0, 14, 2.0), array(1, 1, 1));
			imageconvolution($captcha, $matrix, 16, 32);
			$nombre = random_string('alpha', 8);
			imagejpeg($captcha, 'resources/captcha/'.$nombre.'.jpg');
			//$captchaCod = md5(CAPTCHA_HASH . $result);
			$captchaCod = ($result);
			$captcha_data = array('c_wd' => $captchaCod);
			$this->session->set_userdata($captcha_data);
			return $nombre;
		}

		public function ObtenerUsuario($user_name="", $user_pass="")
		{
			if (($user_name === FALSE)||($user_pass === FALSE))
			{
				return FALSE;
			}
			$this->db->select('a.idPersona, a.idStatus, a.primerApellido, a.segundoApellido, a.primerNombre, a.segundoNombre, a.correoElectronico, a.idTipoPersona, a.RFC, a.CURP, a.telefono, a.telefonoCelular, a.tipoFuncionDesempeña, a.fotoUsuario, c.idCCT,d.CCT, d.nombreCT,d.NivelID');
			$this->db->from('tblpersona a');
			$this->db->join('tblpersonacct c', 'a.idPersona=c.idPersona', 'join');
			$this->db->join('tblcct d', 'c.idCCT=d.idCCT', 'join');
	 		$this->db->where('CURP', $user_name);
			$this->db->where('contrasena', $user_pass);
			$this->db->where('idStatus', 1);
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function obtenerNavegador() 
		{
		    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);

		    if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
		            $browser = 'chromium';
		    elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
		            $browser = 'chrome';
		    elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
		            $browser = 'safari';
		    elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
		            $browser = 'opera';
		    elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
		            $browser = 'msie';
		    elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
		            $browser = 'mozilla';

		    preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

		    return array($browser,$version[2], 'name'=>$browser,'version'=>$version[2]);
		}

		public function actualizaAccesoUsuario($usuarioId)
		{
			if (empty($usuarioId))
			{
				return FALSE;
			}
			//FECHA 'AHORA'
			$fechaObj = new DateTime('NOW');
			$fechaMod = $fechaObj->format('Y-m-d H:i:s');
			$ip = $_SERVER['REMOTE_ADDR'];
			$ipRemoto = '';//$_SERVER['HTTP_X_FORWARDED_FOR'];

			$datos = array(
				'dtFechaUltimoAcceso' => $fechaMod,
				'cUsuarioIpUltimoAcceso' => $ip, 
				'cUsuarioIpRemoto' => $ipRemoto 
			);

			//ACTUALIZA BASE
			$this->db->where('iUsuarioId', $usuarioId);
			$this->db->update('cusuarios', $datos);
		}

		public function guardarLogUsuario($accion = '', $datosUsuario = '')
		{
			$user_id = $this->session->userdata('idPersona');
			if((empty($user_id))||(empty($datosUsuario)))
			{
				return FALSE;
			}
			//FECHA AHORA
			$fechaObj = new DateTime('NOW');
			$fechaMod = $fechaObj->format('Y-m-d H:i:s');
			$userAgent = json_encode( $_SERVER['HTTP_USER_AGENT'] );
			$datos = array(
				'idPersona'	=>	$user_id,
				'nombreNavegador'	=>	$datosUsuario['name'],
				'versionNavegador'	=>	$datosUsuario['version'],
				'accion'	=>	$accion,
				'accionTiempo'	=>	$datosUsuario['timer'],
				'resultadoUserAgent'	=> $userAgent,
				'dtLogUsuarioFechaMod'	=>	$fechaMod
				);

			$this->db->insert('tbllogusuario', $datos);
			$res = $this->db->insert_id();
			if ($res!=0)
			{
				return TRUE;	
						
			}

			return FALSE;
		}

		public function menu()
		{
			$this->db->select('a.*, b.idtipopersona');
			$this->db->from('tblmenu a');
			$this->db->join('tblmenutipopersona b','a.idMenu=b.idmenu','inner');
	 		$this->db->where('b.idtipopersona', $this->session->userdata('idTipoPersona'));
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function listaParticipantes()
		{
			$this->db->select('CURP, RFC, CONCAT_WS(" ", primerNombre, segundoNombre, primerApellido, segundoApellido) nombre, correoElectronico, telefono, telefonoCelular');
			$this->db->from('tblpersona');
			if($this->session->userdata("nombreCompleto") != "")
			{$this->db->where('(primerNombre like "%'.$this->session->userdata("nombreCompleto").'%" or segundoNombre like "%'.$this->session->userdata("nombreCompleto").'%" or primerApellido like "%'.$this->session->userdata("nombreCompleto").'%" or segundoApellido like "%'.$this->session->userdata("nombreCompleto").'%")');}
			if($this->session->userdata("CURP") != "")
			{
				$this->db->where('CURP',$this->session->userdata("CURP"));
			}
			if($this->session->userdata("RFC") != "")
			{
				$this->db->where('RFC',$this->session->userdata("RFC"));
			}
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function listaresultados()
		{

			$this->db->select('b.idRegistroResultado,a.idPersona, a.CURP, a.RFC, d.nombreTipoFuncion, CONCAT_WS(" ", a.primerNombre, a.segundoNombre, a.primerApellido, a.segundoApellido) nombrefull, a.correoElectronico, c.nombreResultado, e.nombreCicloEscolar, CCT, nombreCT, te.nombreTipoEvaluacion AS Proceso, concat(d.nombreTipoFuncion,", ",IF(ISNULL(n.Nivel),"S/N",n.Nivel),", ",IF(ISNULL(asig.nombreAsignatura),"S/A",asig.nombreAsignatura)) AS TipoEvaluacion');
			$this->db->from('tblpersona a');
			$this->db->join('tblregistroresultado b','a.idPersona=b.idPersona','inner');
			$this->db->join('tblresultados c','b.idResultado=c.idResultado','inner');
			$this->db->join('tbltipofuncion d','a.idTipoFuncion=d.idTipoFuncion','inner');
			$this->db->join('tblcicloescolar e','b.idCicloEscolar=e.idCicloEscolar','inner');
			$this->db->join('tblpersonacct f','f.idPersona=a.idPersona','inner');
			$this->db->join('tblcct g','g.idcct=f.idcct','inner');
			$this->db->join('tbltipoevaluacion te','b.Proceso = te.idTipoEvaluacion','inner');
			$this->db->join('tblcatniveles n','n.NivelID = g.NivelID','LEFT OUTER');
			$this->db->join('tblpersonaasignatura pa','pa.PersonaID = a.idPersona','LEFT OUTER');
			$this->db->join('tblasignatura asig','asig.idAsignatura = pa.AsignaturaID','LEFT OUTER');
			//$this->db->join('','','LEFT OUTER');
			
			/*print_r($this->session->userdata("Estados"));
			print_r($this->session->userdata("Anios"));die;*/

			if(!empty($this->session->userdata("Estados")))
			{$this->db->where('c.nombreResultado',$this->session->userdata("Estados"));}

			if($this->session->userdata("Anios") != "")
			{$this->db->where('e.nombreCicloEscolar',$this->session->userdata("Anios"));}

			if($this->session->userdata("Grado") != "")
			{//$this->db->where('e.nombreCicloEscolar',$this->session->userdata("Anios"));
			}

			if($this->session->userdata("Grupo") != "")
			{//$this->db->where('e.nombreCicloEscolar',$this->session->userdata("Anios"));
			}

			if($this->session->userdata("nombreCompleto") != "")
			{$this->db->where('(a.primerNombre like "%'.$this->session->userdata("nombreCompleto").'%" or a.segundoNombre like "%'.$this->session->userdata("nombreCompleto").'%" or a.primerApellido like "%'.$this->session->userdata("nombreCompleto").'%" or a.segundoApellido like "%'.$this->session->userdata("nombreCompleto").'%")');}

			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		private function obtenerCamposPsicometra($tipo = 'GENERAL')
		{
	        $campos = "";
	        switch ($tipo) 
	        {
	            case 'OTRO':
	                break;
	            case 'GENERAL':
	            default:
	                $campos = "iReactivosPruebasPsicometricasId,iProcesoId,dtReactivoPPsicometricaAplicacion,cA,cB,cC,cD,cTTestIndId,cDiscriminacion,cTTestCorrelRpbis,cTTestCorrelRpbisCorregido,cTItemDiscParA,cTItemDiscError,cTItemDifParB,cTItemDifError,cTItemDiscJiX,cTItemGradGi,cTItemSigP,cDif,cTItemSigPdos,cGrupoFavorecido,cObservaciones,dtReactivoPruebasPsicometricasFechaMod";
	            break;
	        }
	        return $campos;
	    }

	    public function importarExcelPsicometra($datos = '')
	    {
	        $dataInsert = array();
	        if(empty($datos)){return $dataInsert;}
	        $campos = $this->obtenerCamposPsicometra('GENERAL');
	        $camposArray = explode(",", $campos);
	        foreach ($datos as $keyId => $contenido) {
	            foreach ($contenido as $key => $value) {
	                if($key == 0){
	                    $CURP = $this->CURP($value);
	                    if(!empty($CURP)){
	                        $arrayTmp = array(
	                            'CURP' => $CURP 
	                        );
	                    }
	                }else{
	                    $arrayTmp[$camposArray[$key]] = $value;     
	                }
	            }
	            $dataInsert[] = $arrayTmp;
	        }
	        //INSERT BATCH
	        if(!empty($dataInsert)){
	            $this->db->insert_batch('tablename', $dataInsert);  
	        }
	        return $this->db->affected_rows();
	    }

	    public function CURP($iR='')
	    {
	        $this->db->select('CURP');
	        $this->db->from('tblpersona');
	        $this->db->where('CURP',$iR);
	        $query = $this->db->get();
	        $res = $query->num_rows();

	        if ($res>0)
	        {
	            $data =  $query->result_array();
	            foreach ($data as $key => $value) {
	              $valor=$data[$key]['CURP'];
	            }
	              return $valor;
	        }
	        else
	        {
	          return FALSE;
	        }
	    }

	    public function obtenerPersona()
		{
			$this->db->select('*');
			$this->db->from('tblpersona');
			$this->db->where('idPersona', $this->session->userdata('idPersona'));
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function modificaFoto($datosusu="")
		{
			$datos=array(
			'fotoUsuario' => $datosusu['fotoUsuario']
			);

			if(!empty($datosusu['Nombre']) || !empty($datosusu['Curp']) || !empty($datosusu['rfc']) || !empty($datosusu['email']) || !empty($datosusu['phone']) || !empty($datosusu['Apaterno']) || !empty($datosusu['AMaterno']))
			{
				$datosd= array(
					'primerNombreant'=>$datosusu['Nombre'],
					'primerApellidoAnt'=>$datosusu['Apaterno'],
					'segundoApellidoAnt'=>$datosusu['AMaterno'],
					'Curpant'=>$datosusu['Curp'],
					'rfcant'=>$datosusu['rfc'],
					'correoElectronicoant'=>$datosusu['email'],
					'telefonoCelularant'=>$datosusu['phone'],
					'Modificacion' => 1,
					'primerNombre'=>$datosusu['Nombre'],
					'primerApellido'=>$datosusu['Apaterno'],
					'segundoApellido'=>$datosusu['AMaterno'],
					'CURP'=>$datosusu['Curp'],
					'RFC'=>$datosusu['rfc'],
					'correoElectronico'=>$datosusu['email'],
					'telefonoCelular'=>$datosusu['phone']);
			}
			/*print_r($datosd);die;*/
			if($datosd)
			{
				$datosfull=array_merge($datos, $datosd);
			}
			else
			{
				$datosfull=$datos;
			}
			//print_r($this->session->userdata('idPersona'));die;
			$this->db->where('idPersona', $this->session->userdata('idPersona'));
			$this->db->update('tblpersona', $datosfull);
			$n = $this->db->affected_rows();
			$this->db->trans_complete();

			if($n>0){$res['status'] = TRUE; }
			else
			{$res['status'] = FALSE;}
			return $res;
		}

		public function listaCCT($cct="")
		{
			$this->db->select('*');
			$this->db->from('tblcct');
			$this->db->like('CCT',$cct);
			$this->db->limit(10);
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function obtenerGrados()
		{
			$this->db->select('*');
			$this->db->from('tblgrados');
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function obtenerGrupos()
		{
			$this->db->select('*');
			$this->db->from('tblgrupo');
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function obtenerResultadoPrelacion()
		{
			$this->db->select('*');
			$this->db->from('tblresultados');
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function obtenerCicloEscolar()
		{
			$this->db->select('*');
			$this->db->from('tblcicloescolar');
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function listaCURP($CURP="")
		{
			$this->db->select('CURP');
			$this->db->from('tblpersona');
			$this->db->like('CURP',$CURP);
			$this->db->limit(10);
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}

		public function listaRFC($RFC="")
		{
			$this->db->select('RFC');
			$this->db->from('tblpersona');
			$this->db->like('RFC',$RFC);
			$this->db->limit(10);
			$query = $this->db->get();
			$res = $query->num_rows();

			if ($res>0)
			{
				$data =  $query->result_array();
		    	return $data;
			}
			else
		  	{
		    	return FALSE;
		  	}
		}
		public function validarPermisos($tipoPersona){
            $this->db->select('tblmenutipopersona.idtipopersona, tblmenutipopersona.idmenu, tblmenu .urlMenu');
			$this->db->from('tblmenutipopersona');
			$this->db->join('tblmenu', 'tblmenu.idmenu = tblmenutipopersona.idmenu');
			$this->db->where("tblmenutipopersona.idtipopersona",$tipoPersona);
			$query = $this->db->get();
			$res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return array();
		  	}
		}

		public function modResultado($GrupoDesempeño,$Motivo,$ResultadoID,$UsuarioID){
			$Modificaciones = $this->modificaciones($ResultadoID);
			$Modificaciones++;
			//echo "<pre>"; echo $Modificaciones;die();
			$data = array(
				'idResultado' => $GrupoDesempeño,
				'MotivoUM' => $Motivo,
				'UsrModificoID' => $UsuarioID,
				'Modificaciones' => $Modificaciones
			);
			$this->db->where('idRegistroResultado',$ResultadoID);
			$ok=$this->db->update('tblregistroresultado',$data);
			return $ok;
		}

		public function modificaciones($idRegistroResultado){
			$this->db->select("*");
			$this->db->from('tblregistroresultado');
			$this->db->where("idRegistroResultado",$idRegistroResultado);
			$this->db->limit(1);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();
				//echo "<pre>"; print_r($data);die();
		    	return $data[0]['Modificaciones'];
			}
			else{
				//echo "<pre>"; echo "Ño";die();
		    	return FALSE;
		  	}
		}

		public function listaNomnina()
		{
			$this->db->select("*");
			$this->db->from("tblnomina");
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();
		    	return $data;
			}
			else{
				//echo "<pre>"; echo "Ño";die();
		    	return FALSE;
		  	}
		}

	}
