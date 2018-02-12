<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_catCedes extends CI_Model{
		public function __construct(){
			parent::__construct();
        }

        public function listaCedes($Bus){
			$this->db->select("*");
			$this->db->from('tblcedes');
			$this->db->like("Nombre",$Bus);
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
        
        public function buscarCede($BusID){
			//$this->db->select("*,CONCAT(primerApellido,' ',segundoApellido,' ',primerNombre,' ',segundoNombre) as Persona");
			$this->db->select("");
			$this->db->from('tblcedes');
			$this->db->where("CedeID",$BusID);
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
        
        public function addCede($Nombre,$Telefono,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal){ 
			$data = array(
				'Nombre' => $Nombre,
				'Calle' => $Calle,
				'NumeroExt' => $NumeroExt,
				'NumeroInt' => $NumeroInt,
				'Cruzamiento1' => $Cruzamiento1,
				'Cruzamiento2' => $Cruzamiento2,
				'Colonia' => $Colonia,
				'MunicipioID' => $Municipio, 
				'CodigoPostal' => $CodigoPostal,
				'Telefono' => $Telefono
            );
            //echo "<pre>"; print_r($data);die();
			$ok=$this->db->insert('tblcedes',$data);
			return $ok;
		}

		public function modCede($CedeID,$Nombre,$Telefono,$Calle,$NumeroExt,$NumeroInt,$Cruzamiento1,$Cruzamiento2,$Colonia,$Municipio,$CodigoPostal){ 
			//$persona=$this->buscarPersona(base64_decode($idPersona));
			$data = array(
				'Nombre' => $Nombre,
				'Calle' => $Calle,
				'NumeroExt' => $NumeroExt,
				'NumeroInt' => $NumeroInt,
				'Cruzamiento1' => $Cruzamiento1,
				'Cruzamiento2' => $Cruzamiento2,
				'Colonia' => $Colonia,
				'MunicipioID' => $Municipio, 
				'CodigoPostal' => $CodigoPostal,
				'Telefono' => $Telefono
            );
            //echo "<pre>"; print_r($data);die();
			$this->db->where('CedeID',$CedeID);
			$ok=$this->db->update('tblcedes',$data);
			return $ok;			
		}

    }
?>