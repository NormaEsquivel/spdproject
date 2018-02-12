<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_docente extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function resultado()
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

		public function ResultadoExamenHistorico()
		{
			//print_r($this->session->userdata('CURP'));die();
			$this->db->select('a.idPersona, a.CURP, a.RFC, b.resulta');
			$this->db->from('tblpersona a');
			$this->db->join('tbltemp b', 'a.CURP=b.curp', 'inner');
			$this->db->where('a.CURP', $this->session->userdata('CURP'));
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
}

	