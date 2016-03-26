<?php
class Timeline_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }

        public function insert_post($data)
		{
	        $this->db->insert('POST', $data);
		}

		public function insert_mention($data)
		{
	        $this->db->insert('MENTION', $data);
		}

		public function retrieve_posts()
		{
			$query = $this->db->query('select * from POST order by IsPinned desc, Id desc;');
	        return $query->result();
		}

		public function get_mentions($id)
		{
			$query = $this->db->query('select Name from MENTION A, ACCOUNT B where A.SPAcc=B.Username and PostId="'.$id.'";');
	        return $query->result();
		}

		public function get_lastest_post_id()
		{
			$query = $this->db->query('select max(Id) as max from POST');
	        $result = $query->result();
	        $count = 0;
	        foreach($result as $row){
	        	$count = $row->max;
	        }
	        return $count+1;
		}

		public function retrieve_sp_acc()
		{
			$query = $this->db->query('select * from ACCOUNT A, SPAccounts B where A.Username=B.Username;');
	        return $query->result();
		}

		public function count_comment($post_id)
		{
			$query = $this->db->query('select count(Id) as comment from COMMENT where PostId="'.$post_id.'";');
	        return $query->result();
		}

		public function pin_post($post_id)
		{
			$query = $this->db->query('update POST set IsPinned="1" where Id="'.$post_id.'";');
		}

		public function unpin_post($post_id)
		{
			$query = $this->db->query('update POST set IsPinned="0" where Id="'.$post_id.'";');
		}
}