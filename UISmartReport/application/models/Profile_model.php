<?php
class Profile_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }

		public function retrieve_posts($username)
		{
			$query = $this->db->query('select * from POST A, ACCOUNT B where A.OwnerId=B.Username and B.Username="'.$username.'" order by IsPinned desc, Id desc;');
			return $query->result();
		}

		public function retrieve_pinned_posts($username)
		{
			$query = $this->db->query('select * from POST A, MENTION B, ACCOUNT C where A.OwnerId=C.Username and A.Id=B.PostId and A.IsPinned="1" and B.SPAcc="'.$username.'" order by A.Id desc;');
			return $query->result();
		}

		public function retrieve_mention_posts($username)
		{
			$query = $this->db->query('select A.Id as Id, OwnerId, Timestamp, Status, Title, Data, Attachments, IsPinned, IsAnonymous, IsViewable, C.Username as Username, PictLink, IsSPAcc, Name from POST A, MENTION B, ACCOUNT C where A.OwnerId=C.Username and A.Id=B.PostId and B.SPAcc="'.$username.'" order by IsPinned desc, A.Id desc;');
			return $query->result();
		}

		public function retrieve_search_posts($username, $search, $status)
		{
			if ($status != null) {
				$query = $this->db->query('select A.Id as Id, OwnerId, Timestamp, Status, Title, Data, Attachments, IsPinned, IsAnonymous, IsViewable, C.Username as Username, PictLink, IsSPAcc, Name from POST A, MENTION B, ACCOUNT C where A.OwnerId=C.Username and A.Id=B.PostId and B.SPAcc="'.$username.'" and A.Status="'.$status.'" and (A.Title like "%'.$search.'%" or A.Data like "%'.$search.'%") order by IsPinned desc, A.Id desc;');
			} else {
				$query = $this->db->query('select A.Id as Id, OwnerId, Timestamp, Status, Title, Data, Attachments, IsPinned, IsAnonymous, IsViewable, C.Username as Username, PictLink, IsSPAcc, Name from POST A, MENTION B, ACCOUNT C where A.OwnerId=C.Username and A.Id=B.PostId and B.SPAcc="'.$username.'" and (A.Title like "%'.$search.'%" or A.Data like "%'.$search.'%") order by IsPinned desc, A.Id desc;');
			}
			return $query->result();
		}
}