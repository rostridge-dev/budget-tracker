<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entries extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index() {
		
		$ci =& get_instance();
		
		$data = array();
		
		// Get the list of active users
		$users = array();
		$query = $this->db->get_where('users',array('active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$users[$row->id] = $row->firstname." ".$row->lastname;
			}
		}
		$data['users'] = $users;
		
		// Get the list of active categories
		$categories = array();
		$query = $this->db->get_where('categories',array('active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$categories[$row->id] = $row->name;
			}
		}
		$data['categories'] = $categories;
		
		// Get the list of active entries
		$entries = array();
		$this->db->order_by('date','DESC');
		$query = $this->db->get_where('entries',array('active'=>true,'deleted'=>NULL),100);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "entries".$row->id;
				$ci->load->model('Entry_model',$alias);
				$entries[$row->id] = $ci->{$alias}->load($row->id);
			}
		}
		$data['entries'] = $entries;
		
		// Load the view for this controller
		$data['title'] = "Entries";		
		$this->template->view('entries_all',$data);
		
	}
	
	/**
	 * The add entry method
	 *
	 */
	public function add() {
		
		$ci =& get_instance();
		
		$this->load->model('Entry_model');
		$entry = $this->Entry_model->instance();
		
		// Check to see the form was submitted
		if($this->input->post('action') == 'submit'){
			
			// Assign the validation rules
			$this->setValidation();
		
			// Validate the form
			if ($this->form_validation->run() == TRUE){
				
				$entry->setUserID($this->session->userdata('user_id'));
				$entry->setDate($this->input->post('date'));
				$entry->setCategoryID($this->input->post('category_id'));
				$entry->setAmount($this->input->post('amount'));
				$entry->setNotes($this->input->post('notes'));			
				$entry->setActive(true);
				$entry->add();
				
				redirect(base_url()."home");
			}
		}
	
		$data = array();
		
		// Get the list of active categories
		$categories = $categories_list = array();
		$this->db->order_by('name','ASC');
		$query = $this->db->get_where('categories',array('active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "categories".$row->id;
				$ci->load->model('Category_model',$alias);
				$categories_list[$row->id] = $ci->{$alias}->load($row->id);
				$categories[$row->id] = $categories_list[$row->id]->getName();
			}
		}
		$data['categories'] = $categories;
		
		// Set the entry date as today by default
		$entry->setDate(date("Y-m-d"));
		
		$data['title'] = "Entries: Add";
		$data['form_action'] = "entries/add";
		$data['entry'] = $entry;
		
		//load the template view
		$this->template->view('entries_form',$data);
	
	}
	
	/**
	 * The edit entry method
	 *
	 */
	public function edit() {
		
		$ci =& get_instance();
	
		$id = $this->uri->segment(3);
		$this->load->model('Entry_model');
		$entry = $this->Entry_model->load($id);
		
		// Check to see the form was submitted
		if($this->input->post('action') == 'submit'){
			
			// Assign the validation rules
			$this->setValidation();
		
			// Validate the form
			if ($this->form_validation->run() == TRUE){
				
				$entry->setUserID($this->session->userdata('user_id'));
				$entry->setDate($this->input->post('date'));
				$entry->setCategoryID($this->input->post('category_id'));
				$entry->setAmount($this->input->post('amount'));
				$entry->setNotes($this->input->post('notes'));
				
				$entry->edit();
				
				redirect(base_url()."home");
			}
		}
		
		$data = array();
		
		// Get the list of active categories
		$categories = $categories_list = array();
		$this->db->order_by('name','ASC');
		$query = $this->db->get_where('categories',array('active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "categories".$row->id;
				$ci->load->model('Category_model',$alias);
				$categories_list[$row->id] = $ci->{$alias}->load($row->id);
				$categories[$row->id] = $categories_list[$row->id]->getName();
			}
		}
		$data['categories'] = $categories;
		
		$data['title'] = "Entries: Edit";
		$data['form_action'] = "entries/edit/".$id;
		$data['entry'] = $entry;
		
		//load the template view
		$this->template->view('entries_form',$data);
		
	}
	
	/**
	 * Delete for this controller
	 *
	 */
	public function delete() {
		
		$id = $this->uri->segment(3);
		$this->load->model('Entry_model');
		$entry = $this->Entry_model->load($id);
		
		// Make sure the current user is deleting their own routes
		$user_id = $this->session->userdata('user_id');
		if ($user_id == $entry->getUserID()) {
			$entry->delete();
		}		
		redirect(base_url()."entries");
		
		
	}
	
	/**
	 * Sets up the common form validation for the add and edit controllers
	 *
	 */
	private function setValidation() {
		
		// Load the form validation library
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger"><p class="text-danger">&nbsp;<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> ','</p></div>');
	
		// Assign validation rules
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required|integer');
		$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
		
	}
}