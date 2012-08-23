<?php
class Whitelist_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function isValidIP() {
		$query = $this->db->get_where('whitelist', array('ip'=>$_SERVER['REMOTE_ADDR']));

		return ($query->num_rows() > 0);
	}

	public function add()
	{
		$this->load->helper('url');

		$ip = $this->input->post('ip');
		$character_id = $this->input->post('character_id');

		// Remove existing IPs
		$query = $this->db->delete('whitelist', array('character_id' => $character_id));

		$data = array(
				'ip' => $ip,
				'character_id' => $character_id
		);

		return $this->db->insert('whitelist', $data);
	}
}
