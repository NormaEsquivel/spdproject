<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_asistencia extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function validar($RFC,$Fecha,$turno){
            $this->db->select('*');
			$this->db->from('vw_listas');
			$this->db->where("rfc",$RFC);
			$this->db->where("Fecha",$Fecha);
			$this->db->where("turnoID",$turno);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return array();
		  	}
		}

		public function procesos(){
			$this->db->select('*');
			$this->db->from('catetapasevaluacion');
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return array();
		  	}
		}

		public function getAsistencias($proceso){
			$this->db->select("a.AsistenciaID,if(a.Asistio = 1,'Si','No') as Asistio,if(a.Entrada = 1,'Si','No') as Entrada,if(a.Salida = 1,'Si','No') as Salida, concat(p.primerApellido,' ',p.segundoApellido,' ',p.primerNombre,' ',p.segundoNombre) AS Docente,f.Fecha, ee.Descripcion AS Etapa, t.Turno, ce.nombreCicloEscolar as Ciclo,s.Nombre as Sede, if(a.CambioCede = 1,'Si','No') as CambioCede");
			$this->db->from('tblasistencias a');
			$this->db->join("tblpersona p","p.idPersona = a.PersonaID","INNER");
			$this->db->join("tblcatfechas f","f.FechaAplicacionID = a.FechaID","INNER");
			$this->db->join("catetapasevaluacion ee","ee.EtapaID = f.EtapaID","INNER");
			$this->db->join("tblcatturnos t","t.TurnoID = f.TurnoID","INNER");
			$this->db->join("tblcicloescolar ce","ce.idCicloEscolar = f.CicloEscolarID","INNER");
			$this->db->join("tblcedes s","s.CedeID = a.CedeID","INNER");
			$this->db->where("f.EtapaID",$proceso);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return array();
		  	}
		}
		
		public function validar2($PersonaID,$FechaID){
            $this->db->select('*');
			$this->db->from('tblasistencias');
			$this->db->where("PersonaID",$PersonaID);
			$this->db->where("FechaID",$FechaID);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res > 0) {
		    	return false;
			} else {
		    	return true;
		  	}
		}

		public function getCede($Clave){
            $this->db->select('*');
			$this->db->from('tblcedes');
			$this->db->where("Clave",$Clave);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res > 0) {
				$data =  $query->result_array();
		    	return $data[0]['CedeID'];
			} else {
		    	return 0;
		  	}
		}
		
		public function addAsistencia($PersonaID,$FechaID,$CedeID,$CambioCede,$Asistio,$Entrada,$Salida){
			$Data = array(
				'PersonaID' => $PersonaID,
				'FechaID' => $FechaID,
				'CedeID' => $CedeID,
				'CambioCede' => $CambioCede,
				'Asistio' => $Asistio,
				'Entrada' => $Entrada,
				'Salida' => $Salida
			);
			$ok = $this->db->insert('tblasistencias',$Data);
			return $ok;
		}
        
    }
?>