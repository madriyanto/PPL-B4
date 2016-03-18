<?php
class Logout_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function isSPAcc($username)
		{
	        $query = $this->db->query('select IsSPAcc from ACCOUNT where Username="'.$username.'";');
	        $result = $query->row_array();
	        if($result['IsSPAcc'] == 1)
	        {
	        	return true;
	        } else {
	        	return false;
	        }
		}
}