<?php
class Timeline_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }

		public function retrieve_posts()
		{
			$query = $this->db->query('select * from POST order by IsPinned desc, Id desc;');
	        return $query->result();
		}

		public function retrieve_sp_acc()
		{
			$query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username;');
	        return $query->result();
		}
}