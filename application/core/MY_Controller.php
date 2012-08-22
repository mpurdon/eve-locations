<?php

/**
 * Eve Locations Controller
 *
 * @author Matthew
 */
class MY_Controller extends CI_Controller
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		// Don't redirect the unauthorized page...
		if(strpos($_SERVER['REQUEST_URI'],'/unauthorized') === 0) {
			return;
		}

		return;

		// Make sure we are using the IGB
		if (!array_key_exists('HTTP_EVE_TRUSTED', $_SERVER)) {
			error_log('Non-IGB attempted to view the site');
			$this->load->helper('url');
			redirect(site_url('unauthorized/trust'));
		}

		// Make sure the IGB trusts us
		if (!array_key_exists('HTTP_EVE_TRUSTED', $_SERVER) || $_SERVER['HTTP_EVE_TRUSTED'] != 'Yes') {
			error_log('An untrusted IGB attempted to view the site');
			$this->load->helper('url');
			redirect(site_url('unauthorized/trust'));
		}

		// Make sure the alliance is correct
		if($_SERVER['HTTP_EVE_ALLIANCEID'] != '1680888152') {
			error_log('Non-MYM8 pilot "' . $_SERVER['HTTP_EVE_CHARNAME'] . '" attempted to view the site');
			$this->load->helper('url');
			redirect(site_url('unauthorized'));
		}
	}
}