<?php

class Pages extends MY_Controller
{
	public function view($page = 'home')
	{
		if ( ! file_exists('application/views/pages/'.$page.'.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->helper('url');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	public function unauthorized()
	{
		$data['title'] = 'Unauthorized Access';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/unauthorized', $data);
		$this->load->view('templates/footer', $data);
	}
}
