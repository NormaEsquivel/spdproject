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
			$this->db->join('tblpersonatipoevaluacion b', 'a.idPersona=b.idPersona', 'join');
			$this->db->join('tblpersonacct c', 'b.idPersona=c.idPersona', 'join');
			$this->db->join('tblcct d', 'c.idCCT=d.idCCT', 'join');
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
					'CURP'=>$datos['curpant'],
					'RFC'=>$datos['rfcant'],
					'primerNombre'=>$datos['nombreant'],
					'primerApellido'=>$datos['apellidopant'],
					'segundoApellido'=>$datos['apellidomant'],
					'correoElectronico'=>$datos['correoelectronicoant'],
					'telefonoCelular'=>$datos['telefonoant'],
					'primerNombreant'=>'',
					'primerApellidoAnt'=>'',
					'segundoApellidoAnt'=>'',
					'Curpant'=>'',
					'rfcant'=>'',
					'correoElectronicoant'=>'',
					'telefonoCelularant'=>'',
					'Modificacion' => 0);
				}
				else
				{
					$datosd = array('dtModificacion' => $fechaMod );
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
					
					array_push($d,@$director[0]);
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
			$this->db->where("p.idTipoPersona",4);
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