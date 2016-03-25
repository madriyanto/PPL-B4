<?php
class Timeline_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }

        public function insert_post($data1)
		{
	        $this->db->insert('POST', $data1);
		}

		public function retrieve_posts()
		{
			$query = $this->db->query('select * from POST order by IsPinned desc, Id desc');
	        return $query->result();
		}
}