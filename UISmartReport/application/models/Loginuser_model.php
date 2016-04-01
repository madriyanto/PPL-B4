<?php
class Loginuser_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function check_user($username)
		{
	        $query = $this->db->get_where('USERS', array('Username' => $username));
	        $result = $query->row_array();
	        if($result == null)
	        {
	        	return false;
	        } else {
	        	return true;
	        }
		}

		public function insert_user($data1, $data2)
		{
	        $this->db->insert('USERS', $data1);
	        $this->db->insert('ACCOUNT', $data2);
		}

		public function get_user($username)
		{
	        $query = $this->db->query('select * from ACCOUNT A, USERS B where A.Username=B.Username and A.Username="'.$username.'";');
	        return $query->row_array();
		}
}