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

		$query = $this->db->select('location.*, system.system_id as system_id', false)
		                  ->from('location')
		                  ->join('system', 'system.system_name = location.system', 'left')
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

	public function add_location()
	{
		$this->load->helper('url');

		$notice = $this->input->post('notice');

		// Get the pilot from the notice
		$pilotPattern = "#I found (.*?) for you.#";
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

		// Check for duplicate before writing.
		$query = $this->db->get_where('location', array('pilot'=>$pilot, 'date'=> $date));
		if ($query->num_rows() > 0) {
			throw new InvalidArgumentException('Location for ' . $pilot . ' was already recorded at ' . $date);
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

		$this->db->insert('location', $data);

		if($this->db->affected_rows() == 0) {
			throw new InvalidArgumentException('Could not store the location for :' . implode(',', $data));
		}
	}

	/**
	 * Similar to add_location but uses regular form fields rather than the eve notice
	 *
	 * @throws InvalidArgumentException
	 */
	public function add_sighting()
	{
		$this->load->helper('url');

		$pilot = $this->input->post('pilot');
		$date = $this->input->post('eve-date');
		$station = $this->input->post('station');
		$system = $this->input->post('system');
		$constellation = $this->input->post('constellation');
		$region = $this->input->post('region');
		$ship = $this->input->post('ship');

		if(strlen($station) == 0) {
			$station = '(in space)';
		}

		if(strlen($ship) == 0) {
			$ship = 'unknown';
		}

		// Check for duplicate before writing.
		$query = $this->db->get_where('location', array('pilot'=>$pilot, 'date'=> $date));
		if ($query->num_rows() > 0) {
			throw new InvalidArgumentException('Sighting for ' . $pilot . ' was already recorded at ' . $date);
		}

		$data = array(
				'pilot' => $pilot,
				'date' => $date,
				'station' => $station,
				'system' => $system,
				'constellation' => $constellation,
				'region' => $region,
				'ship_type' => $ship
		);

		$this->db->insert('location', $data);

		if($this->db->affected_rows() == 0) {
			throw new InvalidArgumentException('Could not store the location for :' . implode(',', $data));
		}
	}
}
