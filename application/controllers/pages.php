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

	public function unauthorized($trust=null)
	{
		$data['title'] = 'Unauthorized Access';

		$data['message'] = 'This site provides intelligence to those who have access. If you are seeing this message, you are not one of them.';

		if (!is_null($trust)) {
			$data['message'] = 'This site must be viewed in a trusted in-game browser, accept the trust request and <a href="/">try again</a> or add your IP to the whitelist.';
		}

		$this->load->view('templates/header', $data);
		$this->load->view('pages/unauthorized', $data);
		$this->load->view('templates/footer', $data);
	}
}
