<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_catDocentes extends CI_Model{
		public function __construct(){
			parent::__construct();
        }
        public function listarTipoPersona(){
            $this->db->select('*');
			$this->db->from('tbltipopersona');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return FALSE;
		  	}
        }
        public function listarTipoFuncion(){
            $this->db->select('*');
			$this->db->from('tbltipofuncion');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return FALSE;
		  	}
        }     

        public function listarStatus(){
            $this->db->select('idStatus,StatusNombre');
			$this->db->from('tblstatus');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return FALSE;
		  	}
		}
		public function listarMun(){
            $this->db->select('*');
			$this->db->from('tblmunicipio');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return FALSE;
		  	}
		}
		public function listarConsideraciones(){
            $this->db->select('*');
			$this->db->from('tblcatconcideraciones');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return FALSE;
		  	}
		}
		
		public function listaPersonas($Bus){
			$this->db->select("*,CONCAT(primerApellido,' ',segundoApellido,' ',primerNombre,' ',segundoNombre) as Persona");
			$this->db->from('tblpersona');
			$this->db->like("CONCAT(primerApellido,' ',segundoApellido,' ',primerNombre,' ',segundoNombre)",$Bus);
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

		public function buscarPersona($BusID){
			//$this->db->select("*,CONCAT(primerApellido,' ',segundoApellido,' ',primerNombre,' ',segundoNombre) as Persona");
			$this->db->select("tblpersona.*,CONCAT(tblpersona.primerApellido,' ',tblpersona.segundoApellido,' ',tblpersona.primerNombre,' ',tblpersona.segundoNombre) as Persona,tbltipopersona.nombreTipoPersona AS TipoPersona, tbltipofuncion.nombreTipoFuncion AS TipoFuncion, tblstatus.StatusNombre AS Estatus");
			$this->db->from('tblpersona');
			$this->db->join('tbltipopersona','tbltipopersona.idTipoPersona = tblpersona.idTipoPersona');
			$this->db->join('tbltipofuncion','tbltipofuncion.idTipoFuncion = tblpersona.idTipoPersona');
			$this->db->join('tblstatus','tblstatus.idStatus = tblpersona.idStatus');
			$this->db->where("tblpersona.idPersona",$BusID);
			$this->db->limit(1);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();
				//echo "<pre>"; print_r($data);die();
		    	return $data;
			}
			else{
		    	return FALSE;
		  	}
		}

		public function getStatus($Bus){
			$this->db->select("idStatus");
			$this->db->from('tblpersona');
			$this->db->where("idPersona",base64_decode($Bus));
			$this->db->limit(1);
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();
				// echo "<pre>";
				// print_r($data[0]['idStatus']);
				// die;
		    	return $data[0]['idStatus'];
			}
			else{
		    	return 0;
		  	}
		}

		public function addPersona($StatusID,$TipoPersonaID,$TipoFuncionID,$Curp,$RFC,$ApellidoPaterno,$ApellidoMaterno,$Nombres,$Correo,$Contrasena,$telefono,$telefonoCelular,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal,$tipoFuncionDesempeña,$dtFechaContrato,$ConsideracionID){ 
			$data = array(
				'idTipoPersona' => $TipoPersonaID,
				'idTipoFuncion' => $TipoFuncionID,
				'idStatus' => $StatusID,
				'CURP' => $Curp,
				'RFC' => $RFC,
				'primerNombre' => $Nombres,
				'segundoNombre' => "",
				'primerApellido' => $ApellidoPaterno, 
				'segundoApellido' => $ApellidoMaterno,
				'correoElectronico' => $Correo,
				'contrasena' => $Contrasena,
				'telefono' => $telefono,
				'telefonoCelular' => $telefonoCelular,
				'Calle' => $Calle,
				'NumeroExt' => $NumeroExt,
				'NumeroInt' => $NumeroInt,
				'Cruzamiento1' => $Cruzamiento1,
				'Cruzamiento2' => $Cruzamiento2,
				'Colonia' => $Colonia,
				'MunicipioID' => $Municipio, 
				'CodigoPostal' => $CodigoPostal,
				'dtIngresoServicio' => $dtFechaContrato,
				'tipoFuncionDesempeña' => $tipoFuncionDesempeña,
				'dtFechaContrato' => $dtFechaContrato,
				'primerNombreant' => "",
				'primerApellidoAnt' => "",
				'segundoApellidoAnt' => "",
				'curpant' => "",
				'rfcant' => "",
				'correoElectronicoant' => "",
				'telefonoant' => "",
				'telefonoCelularant' => "",
				'CalleAnt' => "",
				'NumeroExtAnt' => "",
				'NumeroIntAnt' => "",
				'Cruzamiento1Ant' => "",
				'Cruzamiento2Ant' => "",
				'ColoniaAnt' => "",
				'MunicipioIDAnt' => "", 
				'CodigoPostalAnt' => "",
				'Modificacion' => 0,
				'ConsideracionID' => $ConsideracionID
			);
			$ok=$this->db->insert('tblpersona',$data);
			return $ok;
		}

		public function modPersona($idPersona,$StatusID,$TipoPersonaID,$TipoFuncionID,$Curp,$RFC,$ApellidoPaterno,$ApellidoMaterno,$Nombres,$Correo,$Contrasena,$telefono,$telefonoCelular,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal,$tipoFuncionDesempeña,$dtFechaContrato,$ConsideracionID){ 
			$persona=$this->buscarPersona(base64_decode($idPersona));
			//echo "<pre>"; print_r($persona);die();
			if (count($persona)>0) {
				$data = array(
					'idTipoPersona' => $TipoPersonaID,
					'idTipoFuncion' => $TipoFuncionID,
					'idStatus' => $StatusID,
					'CURP' => $Curp,
					'RFC' => $RFC,
					'primerNombre' => $Nombres,
					'segundoNombre' => "",
					'primerApellido' => $ApellidoPaterno, 
					'segundoApellido' => $ApellidoMaterno,
					'correoElectronico' => $Correo,
					'telefono' => $telefono,
					'telefonoCelular' => $telefonoCelular,
					'Calle' => $Calle,
					'NumeroExt' => $NumeroExt,
					'NumeroInt' => $NumeroInt,
					'Cruzamiento1' => $Cruzamiento1,
					'Cruzamiento2' => $Cruzamiento2,
					'Colonia' => $Colonia,
					'MunicipioID' => $Municipio, 
					'CodigoPostal' => $CodigoPostal,
					'dtIngresoServicio' => $dtFechaContrato,
					'tipoFuncionDesempeña' => $tipoFuncionDesempeña,
					'dtFechaContrato' => $dtFechaContrato,
					'primerNombreant' => $persona['0']['primerNombre']." ".$persona['0']['segundoNombre'],
					'primerApellidoAnt' => $persona['0']['primerApellido'],
					'segundoApellidoAnt' => $persona['0']['segundoApellido'],
					'curpant' => $persona['0']['CURP'],
					'rfcant' => $persona['0']['RFC'],
					'correoElectronicoant' => $persona['0']['correoElectronico'],
					'telefonoant' => $persona['0']['contrasena'],
					'telefonoCelularant' => $persona['0']['telefonoCelular'],
					'CalleAnt' => $persona['0']['Calle'],
					'NumeroExtAnt' => $persona['0']['NumeroExt'],
					'NumeroIntAnt' => $persona['0']['NumeroInt'],
					'Cruzamiento1Ant' => $persona['0']['Cruzamiento1'],
					'Cruzamiento2Ant' => $persona['0']['Cruzamiento2'],
					'ColoniaAnt' => $persona['0']['Colonia'],
					'MunicipioIDAnt' => $persona['0']['MunicipioID'], 
					'CodigoPostalAnt' => $persona['0']['CodigoPostal'],
					'Modificacion' => 1,
					'ConsideracionID' => $ConsideracionID
				);
				$this->db->where('idPersona',base64_decode($idPersona));
				$ok=$this->db->update('tblpersona',$data);
				return $ok;
			} else {
				return false;
			}
			
		}
    }

?>