<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_Fechas extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function listarTurnos(){
			$this->db->select("*");
			$this->db->from('tblcatturnos');
			$query = $this->db->get();
			$res = $query->num_rows();
			if ($res>0){
				$data =  $query->result_array();
		    	return $data;
			}
			else{
		    	return array();
		  	}
		}
		
		public function getFechas(){
			$this->db->select("f.FechaAplicacionID,date(f.Fecha) AS Fecha, time(f.Fecha) AS Hora, ee.Descripcion AS Etapa, t.Turno, ce.nombreCicloEscolar as Ciclo");
			$this->db->from('tblcatfechas f');
			$this->db->join("catetapasevaluacion ee","ee.EtapaID = f.EtapaID","INNER");
			$this->db->join("tblcatturnos t","t.TurnoID = f.TurnoID","INNER");
			$this->db->join("tblcicloescolar ce","ce.idCicloEscolar = f.CicloEscolarID","INNER");
			$this->db->where("fecha >=", date("Y-m-d"));
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data;
			} else {
		    	return array();
		  	}
		}

		public function getCE($ce){
			$this->db->select("*");
			$this->db->from('tblcicloescolar');
			$this->db->where("nombreCicloEscolar", $ce);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
				$data =  $query->result_array();
		    	return $data[0]['idCicloEscolar'];
			} else {
		    	return 0;
		  	}
		}

		public function validaFecha($Fecha,$CicloEscolarID,$Proceso,$Turno){
			$this->db->select("*");
			$this->db->from('tblcatfechas');
			$this->db->where("date(Fecha)", $Fecha);
			$this->db->where("CicloEscolarID", $CicloEscolarID);
			$this->db->where("EtapaID", $Proceso);
			$this->db->where("TurnoID", $Turno);
			$query = $this->db->get();
            $res = $query->num_rows();
            if ($res>0) {
		    	return true;
			} else {
		    	return false;
		  	}
		}

		public function addFecha($Fecha,$CicloEscolarID,$Proceso,$Turno){
			$Data = array(
				'Fecha' => $Fecha,
				'CicloEscolarID' => $CicloEscolarID,
				'EtapaID' => $Proceso,
				'TurnoID' => $Turno
			);
			$ok = $this->db->insert('tblcatfechas',$Data);
			return $ok;
		}

    }
?>