<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	/**
	 * Index Page for this controller; also used as the edit page for the profile
	 *
	 */
	public function index() {
	
		$this->load->model('User_model');
		$user = $this->User_model->load($this->session->userdata('user_id'));
		
		// Check to see the form was submitted
		if($this->input->post('action') == 'submit'){
		
			// Load the form validation library
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="bg-danger"><p class="text-danger">&nbsp;<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> ','</p></div>');
		
			// Assign validation rules
			$this->form_validation->set_rules('username', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('firstname', 'First name', 'required');
			$this->form_validation->set_rules('lastname', 'Last name', 'required');
		
			// Validate the form
			if ($this->form_validation->run() == TRUE){
				
				$user->setUsername($this->input->post('username'));
				$user->setFirstname($this->input->post('firstname'));
				$user->setLastname($this->input->post('lastname'));
				$user->setPassword($this->input->post('password'));
				$user->edit();
				
				// Set the session data and redirect
				$userData = array('firstname'=>$user->getFirstname(),'lastname'=>$user->getLastname(),'logged_in'=>true,'user_id'=>$user->getID());	
				$this->session->set_userdata($userData);				
				redirect(base_url()."profile");
			}
		}
		
		// Load the view for this controller
		$data['title'] = "Profile";
		$data['form_action'] = "profile";
		$data['user'] = $user;
		$this->template->view('profile_form',$data);
		
	}
}