<?php
class Post_model extends CI_Model {

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

		public function insert_comment($data)
		{
	        $this->db->insert('COMMENT', $data);
		}
		
        public function get_post($id)
		{
			$query = $this->db->query('select * from POST A where A.Id="'.$id.'";');
	        return $query->row_array();
		}

		public function get_comments($id)
		{
			$query = $this->db->query('select * from COMMENT A, ACCOUNT B where A.OwnerId=B.Username and PostId="'.$id.'";');
	        return $query->result();
		}

		public function get_commenters($id, $owner)
		{
			$query = $this->db->query('select distinct Origins from NOTIFICATION where PostId="'.$id.'" and Origins<>"'.$owner.'" and NotesId="1";');
	        return $query->result();
		}

		public function get_mentions($id)
		{
			$query = $this->db->query('select Name, Username from MENTION A, ACCOUNT B where A.SPAcc=B.Username and PostId="'.$id.'";');
	        return $query->result();
		}
		
		public function is_mentioned($post_id, $username)
		{
			$query = $this->db->query('select * from MENTION where PostId="'.$post_id.'" and SPAcc="'.$username.'";');
	        $result = $query->result();
			if ($result == null) {
				return false;
			} else {
				return true;
			}
		}

		public function get_lastest_post_id()
		{
			$query = $this->db->query('select max(Id) as max from POST;');
	        $result = $query->result();
	        $count = 0;
	        foreach($result as $row){
	        	$count = $row->max;
	        }
	        return $count;
		}
		
		public function get_first_post_id()
		{
			$query = $this->db->query('select min(Id) as max from POST;');
	        $result = $query->result();
	        $count = 0;
	        foreach($result as $row){
	        	$count = $row->max;
	        }
	        return $count;
		}

		public function count_comment($post_id)
		{
	        $this->db->where('PostId', $post_id);
			$this->db->from('COMMENT');
			return $this->db->count_all_results();
		}

		public function pin_post($post_id)
		{
			$query = $this->db->query('update POST set IsPinned="1" where Id="'.$post_id.'";');
		}

		public function unpin_post($post_id)
		{
			$query = $this->db->query('update POST set IsPinned="0" where Id="'.$post_id.'";');
		}

		public function edit_post($data, $id)
		{
			$this->db->where('Id', $id);
			$this->db->update('POST', $data);
		}

		public function delete_mention($id)
		{
			$this->db->where('PostId', $id);
			$this->db->delete('MENTION');
		}

		public function delete_post($id)
		{
			$this->db->where('Id', $id);
			$this->db->delete('POST');
		}
}