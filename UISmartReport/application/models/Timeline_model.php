<?php
class Timeline_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }

		public function retrieve_posts($page)
		{
			if ($page > 1) {
				$query = $this->db->query('select * from POST A, ACCOUNT B where A.OwnerId=B.Username and Status="1" order by IsPinned desc, Id desc limit '.(($page * 9) - 8).', 9;');
				return $query->result();
			} else {
				$query = $this->db->query('select * from POST A, ACCOUNT B where A.OwnerId=B.Username and Status="1" order by IsPinned desc, Id desc limit '.(($page * 9) - 9).', 9;');
				return $query->result();
			}
		}

		public function retrieve_sp_acc()
		{
			$query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username;');
	        return $query->result();
		}
}