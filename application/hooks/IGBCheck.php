<?php

class IGBCheck extends CI_Hooks
{
	public $CI;

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct ();
		$this->CI = get_instance();
	}

	/**
	 * Check the IGB and stuff
	 */
	function check()
	{
		if (!array_key_exists('HTTP_EVE_ALLIANCEID', $_SERVER) || $_SERVER['HTTP_EVE_ALLIANCEID'] != '1680888152') {
			$this->CI->load->helper('url');
			redirect(site_url('unauthorized'));
		}
	}
}
