<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_logUsuarios extends CI_Model{
		public function __construct(){
			parent::__construct();
        }

        public function listarlogs($Bus){
			$this->db->select("tbllogusuario.*,CONCAT(tblpersona.primerApellido,' ',tblpersona.segundoApellido,' ',tblpersona.primerNombre,' ',tblpersona.segundoNombre) as Persona");
            $this->db->from('tbllogusuario');
            $this->db->join('tblpersona',"tbllogusuario.idPersona = tblpersona.idPersona");
			$this->db->like("CONCAT(tblpersona.primerApellido,' ',tblpersona.segundoApellido,' ',tblpersona.primerNombre,' ',tblpersona.segundoNombre)",$Bus);
            $this->db->group_by("tblpersona.idPersona");
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
        
        public function BuscarLogsXUsuario($BusID){
			$this->db->select("tbllogusuario.*,CONCAT(tblpersona.primerApellido,' ',tblpersona.segundoApellido,' ',tblpersona.primerNombre,' ',tblpersona.segundoNombre) as Persona");
            $this->db->from('tbllogusuario');
            $this->db->join('tblpersona',"tbllogusuario.idPersona = tblpersona.idPersona");
			$this->db->where("tbllogusuario.idPersona",$BusID);
            $this->db->order_by("tbllogusuario.dtLogUsuarioFechaMod","DESC");
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
    }
?>