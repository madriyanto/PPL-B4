<?php
class Forgetpass_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_user($email)
		{
	        $query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username and B.Email="'.$email.'";');
	        return $query->row_array();
		}

		public function get_user_by_username($username)
		{
	        $query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username and A.Username="'.$username.'";');
	        return $query->row_array();
		}

		public function update_pass($email, $pass)
		{
	        $this->db->query('update SPAccounts set Password=PASSWORD("'.$pass.'") where Email="'.$email.'"');
		}

		public function check_pass($email, $pass)
		{
	        $query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username and B.Email="'.$email.'" and B.Password=PASSWORD("'.$pass.'");');
	        $result = $query->row_array();
	        if($result == null) {
	        	return false;
	        } else {
	        	return true;
	        }
		}
}