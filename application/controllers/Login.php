<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		// Get any errors
		$data = array();
		if ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}
		
		// Load the view for this controller
		$this->load->view('login',$data);
	}
	
	/**
	 * Authentication page for this controller.
	 *
	 */
	public function authenticate()
	{
		// Get the username and password
		if ($this->input->post('username') && $this->input->post('password')) {
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$this->load->model('user_model');
			
			if ($id = $this->user_model->authenticate($username,$password)) {
				
				// Load the user
				$user = $this->user_model->load($id);
				
				// Set the session data and redirect
				$userData = array('firstname'=>$user->getFirstname(),'lastname'=>$user->getLastname(),'logged_in'=>true,'user_id'=>$user->getID());	
				$this->session->set_userdata($userData);
				
				redirect(base_url()."home");
				
			} else {

				// Set an error and redirect
				$this->session->set_flashdata("error", "<p class=\"text-danger\">Your username and/or password was incorrect. Please try again.</p>");
				redirect(base_url()."login");
			
			}
			
		} else {
			
			// Set an error and redirect
			$this->session->set_flashdata("error", "<p class=\"text-danger\">Please enter your username and password.</p>");
			redirect(base_url()."login");
			
		}
	}
}
