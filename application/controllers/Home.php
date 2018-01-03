<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		$data = array();
		
		// Get the list of expense categories
		$data['expense_categories'] = $this->config->item('expense_categories');
		
		// Load the view for this controller
		$data['title'] = "Home";
		$this->template->view('home',$data);
	}
}