<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_nivel extends CI_Model
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function listaModificaciones()
		{
			$this->db->select('*');
			$this->db->from('tblpersona a');
			$this->db->join('tblpersonatipoevaluacion b', 'a.idPersona=b.idPersona', 'inner');
			$this->db->join('tblpersonacct c', 'b.idPersona=c.idPersona', 'inner');
			$this->db->join('tblcct d', 'c.idCCT=d.idCCT', 'left');
			$this->db->where('b.idTipoEvaluacion','7');
			$this->db->where('d.NivelID',$this->session->userdata('NivelID'));
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

		public function ObtenModificacion($num="")
		{
			$this->db->select('*');
			$this->db->from('tblpersona');
			$this->db->where('idPersona', $num);
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

		public function Modificando($datos='')
		{
			$fechaObj = new DateTime('NOW');
			$fechaMod = $fechaObj->format('Y-m-d H:i:s');
			if($datos['valor']==1)
			{
				$datosd= array(
				'primerNombreant'=>'',
				'primerApellidoAnt'=>'',
				'segundoApellidoAnt'=>'',
				'Curpant'=>'',
				'rfcant'=>'',
				'correoElectronicoant'=>'',
				'telefonoCelularant'=>'',
				'Modificacion' => 0);
			}elseif($datos['valor']==2)
			{
				if(!empty($datos['nombreant']))
				{
					$datosd= array(
					'CURP'=>$datos['curp'],
					'RFC'=>$datos['rfc'],
					'primerNombre'=>$datos['nombre'],
					'primerApellido'=>$datos['apellidop'],
					'segundoApellido'=>$datos['apellidom'],
					'correoElectronico'=>$datos['correoelectronico'],
					'telefonoCelular'=>$datos['telefono'],
					'primerNombreant'=>$datos['nombreant'],
					'primerApellidoAnt'=>$datos['apellidopant'],
					'segundoApellidoAnt'=>$datos['apellidomant'],
					'Curpant'=>$datos['curpant'],
					'rfcant'=>$datos['rfcant'],
					'correoElectronicoant'=>$datos['correoelectronicoant'],
					'telefonoCelularant'=>$datos['telefonoant'],
					'Modificacion' => 0);
				}
				else
				{
					$datosd = array(
						'CURP'=>$datos['curp'],
						'RFC'=>$datos['rfc'],
						'dtModificacion' => $fechaMod );
				}
			}
			$this->db->where('idPersona', $datos['idPersona']);
			$this->db->update('tblpersona', $datosd);
			$n = $this->db->affected_rows();
			$this->db->trans_complete();

			if($n>0){$res['status'] = TRUE; }
			else
			{$res['status'] = FALSE;}
			return $res;
		}

		public function getcts($PersonaID,$CE){
			$this->db->select('pc.idPersonaCCT, c.nombreCT, c.CCT, pc.Activo, c.idCCT');
			$this->db->from('tblpersonacct pc');
			$this->db->join("tblcct c", "c.idCCT = pc.idCCT", "INNER");
			$this->db->where('pc.idPersona',$PersonaID);
			$this->db->where('pc.idCicloEscolar',$CE);
			$query = $this->db->get();
			$res = $query->num_rows();
			$newarr = array();
			if ($res>0)
			{
				$data =  $query->result_array();
				//echo "<pre>";
				//print_r($data);
				foreach ($data as $d) {
					//echo $d['idCCT'];
					$director = $this->getDirector($d['idCCT'],$CE);
					$supervisor = $this->getSupervisor($d['CCT']);
					array_push($d,@$director[0]);//meter directores
					array_push($d,@$supervisor[0]);//meter supervisores
					array_push($newarr,$d);
					//print_r($newarr);
				}
				//die;
		    	return $newarr;
			}
			else
		  	{
		    	return array();
		  	}
		}

		public function eliminarelacion($id){			
			$this->db->delete('tblpersonacct', array("idPersonaCCT" => $id));
		}

		public function agregarrelacion($idCCT,$PersonaID,$CicloEscolarID){
			$data = array(
				'idPersona' => $PersonaID,
				'idCCT' => $idCCT,
				'idCicloEscolar' => $CicloEscolarID
            );
            //echo "<pre>"; print_r($data);die();
			$ok=$this->db->insert('tblpersonacct',$data);
			return $ok;
		}

		public function comparaRelacion($idCCT,$PersonaID,$CicloEscolarID){
			$this->db->select("*");
			$this->db->from('tblpersonacct');
			$this->db->where("idPersona",$PersonaID);
			$this->db->where("idCCT",$idCCT);
			$this->db->where("idCicloEscolar",$CicloEscolarID);
			$this->db->limit(1);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
		    	return TRUE;
			}
			else{
		    	return FALSE;
		  	}
		}

		public function listaCTs($Bus){
			$this->db->select("*");
			$this->db->from('tblcct');
			$this->db->like("CCT",$Bus);
			$this->db->limit(10);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();				
		    	return $data;
			}
			else{
		    	return FALSE;
		  	}
		}
		
		public function negar_cts($PersonaID,$CE){
			$this->db->where('idPersona',$PersonaID);
			$this->db->where('idCicloEscolar',$CE);
			$ok=$this->db->update('tblpersonacct',array('Activo' => 0));
			return $ok;	
		}

		public function activar_ct($id){
			$this->db->where('idPersonaCCT',$id);
			$ok=$this->db->update('tblpersonacct',array('Activo' => 1));
			return $ok;	
		}

		public function getDirector($ctID,$CE){
			$this->db->select("concat(p.primerApellido,' ',p.segundoApellido,' ',p.primerNombre,' ',p.segundoNombre) AS Maestro,P.RFC,P.CURP,concat('Calle ',p.Calle,' #',p.NumeroExt,' ',if((p.NumeroInt <> 0),concat(' int.',p.NumeroInt),''),' x ',p.Cruzamiento1,' y ',p.Cruzamiento2,', C.P. ',p.CodigoPostal) AS Direccion, IF(p.telefonoCelular <> 0, p.telefonoCelular,p.telefono) AS Telefono");
			$this->db->from('tblpersonacct pc');
			$this->db->join("tblpersona p","pc.idPersona = p.idPersona","INNER");
			$this->db->limit(1);
			$this->db->where("pc.idCCT",$ctID);
			$this->db->where("pc.idCicloEscolar",$CE);
			$this->db->where("(p.IdTipoFuncion=2 or p.IdTipoFuncion=4)");
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res > 0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
				return array();
			}
			
		}

		public function getSupervisor($cct){
			// $sql = "SELECT c.CCT,c.nombreCT,s.zona,concat(p.primerApellido,' ',p.segundoApellido,' ',p.primerNombre) AS Supervisor,
			// p.CURP,p.RFC,concat('Calle ',p.Calle,' #',p.NumeroExt,' ',if((p.NumeroInt <> 0),concat(' int.',p.NumeroInt),''),' x ',p.Cruzamiento1,' y ',p.Cruzamiento2,', C.P. ',p.CodigoPostal) AS Direccion, 
			// IF(p.telefonoCelular <> 0, p.telefonoCelular,p.telefono) AS Telefono,n.Nivel, 
			// IF(ss.Subsistema IS null,'N/A',ss.Subsistema) AS Subsistema
			// FROM tblcct c
			// LEFT OUTER JOIN catsupervisores s ON c.NivelID = s.NivelID AND c.Zona = s.Zona
			// LEFT OUTER JOIN tblpersona p ON s.PersonaID = p.idPersona
			// LEFT OUTER JOIN tblcatniveles n ON n.NivelID = s.NivelID
			// LEFT OUTER JOIN tblcatsubsistemas ss ON ss.SubsistemaID = s.SubsistemaID
			// WHERE c.CCT = '31DPR0850Q'";

			$this->db->select("c.CCT,c.nombreCT,s.zona,concat(p.primerApellido,' ',p.segundoApellido,' ',p.primerNombre,' ',p.segundoNombre) AS Supervisor,p.CURP,p.RFC, concat('Calle ',p.Calle,' #',p.NumeroExt,' ',if((p.NumeroInt <> 0),concat(' int.',p.NumeroInt),''),' x ',p.Cruzamiento1,' y ',p.Cruzamiento2,', C.P. ',p.CodigoPostal) AS Direccion,IF(p.telefonoCelular <> 0, p.telefonoCelular,p.telefono) AS Telefono,n.Nivel, IF(ss.Subsistema IS null,'N/A',ss.Subsistema) AS Subsistema");
			$this->db->from('tblcct c');
			$this->db->join("catsupervisores s","c.NivelID = s.NivelID AND c.Zona = s.Zona","INNER");
			$this->db->join("tblpersona p","s.PersonaID = p.idPersona","INNER");
			$this->db->join("tblcatniveles n","n.NivelID = s.NivelID","INNER");
			$this->db->join("tblcatsubsistemas ss","ss.SubsistemaID = s.SubsistemaID","LEFT");
			$this->db->limit(1);
			$this->db->where("c.CCT",$cct);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res > 0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
				return array();
			}
			
		}

		// $PR="SELECT concat(p.primerApellido,' ',p.segundoApellido,' ',p.primerNombre,p.segundoNombre) AS Nombre,n.Fecha_Ingreso_Sep,n.Descrip_Tipo_Plaza,n.Movimiento,n.Vig_Ini_Mov, n.Vig_Final_Mov 
		// FROM tblpersona p
		// LEFT OUTER JOIN tblnomina n ON p.RFC = n.RFC OR p.CURP = n.CURP
		// LEFT OUTER JOIN tblpersonaasignatura pa ON p.idPersona = pa.PersonaID
		// LEFT OUTER JOIN tblasignatura a ON a.idAsignatura = pa.AsignaturaID
		// LEFT OUTER JOIN tblpersonacct pc ON pc.idPersona =p.idPersona
		// LEFT OUTER JOIN tblcct c ON c.idCCT = pc.idCCT
		// WHERE p.idPersona = 1";

	}