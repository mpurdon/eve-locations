<?php

class Locations extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('location_model');
	}

	public function index($sort_by='date', $sort_dir='desc', $offset=0)
	{
		$locationsPerPage = 20;

		$locationRecords = $this->location_model->search($locationsPerPage, $offset, $sort_by, $sort_dir);
		$data['locations'] = $locationRecords['records'];
		$data['num_locations'] = $locationRecords['count'];
		$data['title'] = 'Recent Locations';

		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('pagination');

		$configuration = array(
			'base_url' => site_url("/locations/{$sort_by}/{$sort_dir}"),
			'per_page' => $locationsPerPage,
			'total_rows' => $data['num_locations'],
			'uri_segment' => 4,
		);

		$this->pagination->initialize($configuration);
		$data['pagination'] = $this->pagination->create_links();

		$data['fields'] = array(
			'Pilot' => 'pilot',
			'When' => 'date',
			'Station' => 'station',
			'System' => 'system',
			'Constellation' => 'constellation',
			'Region' => 'region'
		);

		$data['sort_by'] = $sort_by;
		$data['sort_dir'] = $sort_dir;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('locations/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($pilot)
	{
// 		$data['locations'] = $this->location_model->search($pilot);
	}

	public function create()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a location record';

		$this->form_validation->set_rules('notice', 'Notice', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('locations/create');
			$this->load->view('templates/footer');

			return;
		}

		$this->location_model->set_location();
		$this->load->view('locations/success');
	}

	public function search()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pilot', 'Pilot', 'alpha_dash');
		$this->form_validation->set_rules('system', 'System', 'alpha_dash');
		$this->form_validation->set_rules('constellation', 'Constellation', 'alpha_dash');
		$this->form_validation->set_rules('region', 'Region', 'alpha_dash');

		$data['title'] = 'Search for locations';

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('locations/search');
			$this->load->view('templates/footer');

			return;
		}

		$search = array_filter($this->input->post());
		unset($search['action']);

		$query_string = '';
		if (count($search) > 0) {
			$query_string = '?' . http_build_query($search);
		}

		redirect('locations/date/desc' . $query_string);
	}
}
