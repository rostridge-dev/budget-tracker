<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		// Destroy the session and redirect
		$this->session->sess_destroy();
		redirect(base_url());
	}
}