<?php
class Notification_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get($username)
		{
	        $query = $this->db->query('select * from NOTIFICATION A, NOTES B, ACCOUNT C where A.NotesId=B.Id and A.Origins=C.Username and A.Dest="'.$username.'" order by Status desc, A.Id desc;');
	        return $query->result();
		}

		public function count_notif($username)
		{
	        $this->db->where('Status', 1);
	        $this->db->where('Dest', $username);
			$this->db->from('NOTIFICATION');
			return $this->db->count_all_results();
		}
		
		public function insert($data)
		{
	        $this->db->insert('NOTIFICATION', $data);
		}

		public function delete($post_id, $notes)
		{
	        $this->db->where('PostId', $post_id);
	        $this->db->where('NotesId', $notes);
			$this->db->delete('NOTIFICATION');
		}

		public function is_unread($username, $post_id)
		{
	        $query = $this->db->query('select Status from NOTIFICATION where Dest="'.$username.'" and PostId="'.$post_id.'" and Status=1;');
	        $result = $query->row_array();
	        if ($result == null) {
	        	return false;
	        } else {
	        	return true;
	        }
		}

		public function set_read($username, $post_id)
		{
	        $query = $this->db->query('update NOTIFICATION set Status="0" where Dest="'.$username.'" and PostId="'.$post_id.'";');
		}
}