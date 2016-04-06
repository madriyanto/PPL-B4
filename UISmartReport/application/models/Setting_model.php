<?php
class Setting_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_user($username)
		{
	        $query = $this->db->get_where('ACCOUNT', array('Username' => $username));
	        $result = $query->row_array();
	        return $result;
		}

		public function update_user($data, $username)
		{
	        $this->db->where('Username', $username);
			$this->db->update('ACCOUNT', $data);
		}

		public function get_sp_acc($username)
		{
	        $query = $this->db->get_where('ACCOUNT A, SPAccounts B', array('A.Username' => 'B.Username', 'A.Username' => $username));
	        $result = $query->row_array();
	        return $result;
		}

		public function update_sp_acc($data1, $data2, $username)
		{
	        $this->db->where('Username', $username);
			$this->db->update('ACCOUNT', $data1);
			$this->db->where('Username', $username);
			$this->db->update('SPAccounts', $data2);
		}
}