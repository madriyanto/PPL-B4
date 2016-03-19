<?php
class Loginsp_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_user($username)
		{
	        $query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username="'.$username.'";');
	        return $query->row_array();
		}

		public function check_pass($username, $pass)
		{
	        $query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username="'.$username.'" and B.Password=PASSWORD("'.$pass.'");');
	        $result = $query->row_array();
	        if($result == null)
	        {
	        	return false;
	        }
	        else
	        {
	        	return true;
	        }
		}
}