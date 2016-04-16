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
	        $this->db->query('update SPAccounts set Password=PASSWORD("'.$pass.'") where Email="'.$email.'";');
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
		
		public function get_encryption($username)
		{
			$query = $this->db->query('select Password from ACCOUNT A, SPAccounts B where A.Username=B.Username and B.Username="'.$username.'";');
	        $result = $query->row_array();
			
			return md5($result['Password']).md5($username);
		}
		
		public function check_encryption($encryption)
		{
			$query = $this->db->query('select * from SPAccounts;');
	        $result = $query->result();
			
			foreach($result as $row) {
				if(md5($row->Password).md5($row->Username) == $encryption) {
					return true;
				}
			}
			
			return false;
		}
		
		public function update_pass_encryption($encryption, $newpass)
		{
			$query = $this->db->query('select * from SPAccounts;');
	        $result = $query->result();
	        $username = null;
			
			foreach($result as $row) {
				if(md5($row->Password).md5($row->Username) == $encryption) {
					$username = $row->Username;
				}
			}
			
			if ($username != null) {
				$this->db->query('update SPAccounts set Password=PASSWORD("'.$newpass.'") where Username="'.$username.'";');
				return true;
			} else {
				return false;
			}
		}
}