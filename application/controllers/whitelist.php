<?php

class Whitelist extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('whitelist_model');
	}

	public function add()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a whitelist record';
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['in_whitelist'] = $this->whitelist_model->isValidIP() ? 'is' : 'is not';

		$this->form_validation->set_rules('ip', 'IP', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('whitelist/add');
			$this->load->view('templates/footer');

			return;
		}

		$this->whitelist_model->add();
		$this->load->view('whitelist/success');
	}
}
