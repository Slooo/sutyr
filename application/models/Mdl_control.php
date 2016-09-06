<?php
class Mdl_control extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	# выбор пользователя
	public function users_get($data)
	{
		$query = $this->db->get_where('users', $data);
		return $query->num_rows();
	}

}