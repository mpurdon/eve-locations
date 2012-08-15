<?php
class Location_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 *
	 * @param integer $limit
	 * @param integer $offset
	 * @return multitype:NULL
	 */
	public function search($limit, $offset, $sort_by, $sort_dir)
	{
		$data = array();

		$sort_by = (in_array($sort_by, array('pilot', 'date', 'station', 'system', 'constellation', 'region')) ? $sort_by : 'date');
		$sort_dir = ($sort_dir == 'desc' ? 'desc' : 'asc');

		$query = $this->db->select('pilot, date, station, system, constellation, region', false)
		                  ->from('location')
		                  ->limit($limit, $offset)
						  ->order_by($sort_by, $sort_dir);

		// Handle search queries
		$pilot = $this->input->get('pilot');
		if($pilot) {
			$this->db->like('pilot', $pilot);
		}

		$system = $this->input->get('system');
		if($system) {
			$this->db->like('system', $system);
		}

		$constellation = $this->input->get('constellation');
		if($constellation) {
			$this->db->like('constellation', $constellation);
		}

		$region = $this->input->get('region');
		if($region) {
			$this->db->like('region', $region);
		}

		$region = $this->input->get('region');
		if($region) {
			$this->db->like('region', $region);
		}

		$data['records'] = $query->get()->result();

		// Count query
		$query = $this->db->select('COUNT(*) as count', false)
		                  ->from('location');

		if($pilot) {
			$this->db->like('pilot', $pilot);
		}

		if($system) {
			$this->db->like('system', $system);
		}

		if($constellation) {
			$this->db->like('constellation', $constellation);
		}

		if($region) {
			$this->db->like('region', $region);
		}

		$result = $query->get()->result();
		$data['count'] = $result[0]->count;

		return $data;
	}

	public function searchByPilot($pilot)
	{
		$query = $this->db->get_where('location', array('pilot' => $pilot));

		return $query->row_array();
	}

	public function set_location()
	{
		$this->load->helper('url');

		$notice = $this->input->post('notice');

		// Get the pilot from the notice
		$pilotPattern = "#I found ([a-zA-Z0-9-_ ]+) for you.#";
		preg_match($pilotPattern, $notice, $matches);

		$pilot = $matches[1];

		// Get the date from the notice
		$datePattern = "#Sent: (\d{4}\.\d{2}\.\d{2} \d{2}:\d{2})#";
		preg_match($datePattern, $notice, $matches);
		$rawDate = $matches[1];
		$date = str_replace('.', '-', $rawDate);

		// Get the location details from the notice
		$locationPattern = "#(?:Sh|H)e is (?:(?:at (.*?) station ?)?)in the (.*?) system, (.*?) constellation of (?:(?:the )?)(.*?) region.#";
		preg_match($locationPattern, $notice, $matches);

		list($all, $station, $system, $constellation, $region) = $matches;

		if(strlen($station) == 0) {
			$station = '(in space)';
		}

		$data = array(
				'pilot' => $pilot,
				'date' => $date,
				'station' => $station,
				'system' => $system,
				'constellation' => $constellation,
				'region' => $region,
				'ship_type' => 'unknown'
		);

		return $this->db->insert('location', $data);
	}
}
