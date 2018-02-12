<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_layoutFechas extends CI_Model{
		public function __construct(){
			parent::__construct();
        }

        public function buscarFechas(){
			$this->db->select("*");
            $this->db->from('layout');
            //$this->db->limit(10);
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