<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		
		$currentMonth = date("n");
		$currentYear = date("Y");
		$this->load->model('Budget_model');
		
		$query = $this->db->get_where('budgets',array('year'=>$currentYear,'month'=>$currentMonth,'active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$budget = $this->Budget_model->load($row->id);
			}
		}
		
		$data = array();
		
		// Get the budget details
		$data['budget_allowances'] = $budget->getCategoryAllowances();
		$data['budget_totals'] = $budget->getCategoryTotals();
		
		// Load the view for this controller
		$data['title'] = "Home";
		$this->template->view('home',$data);
	}
}