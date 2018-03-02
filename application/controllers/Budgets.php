<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budgets extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index() {
	}
	
	/**
	 * The monthly rollover method
	 *
	 */
	public function rollover() {
		$ci =& get_instance();

		$currentMonth = date("n");
		$previousMonth = $currentMonth - 1;
		$currentYear = date("Y");
		
		// Get the previous month budget
		$query = $this->db->get_where('budgets',array('year'=>$currentYear,'month'=>$previousMonth,'active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "budget_old".$row->id;
				$ci->load->model('Budget_model',$alias);
				$budget = $ci->{$alias}->load($row->id);
			}
		}
		
		// Add the new budget for the current month
		$alias = "budget-new";
		$ci->load->model('Budget_model',$alias);
		$nextBudget = $ci->{$alias}->instance();
		$nextBudget->setYear($currentYear);
		$nextBudget->setMonth($currentMonth);
		$nextBudget->setActive(true);
		$nextBudget->add();
		
		// Load the current month budget and add the categories
		$query = $this->db->get_where('budgets',array('year'=>$currentYear,'month'=>$currentMonth,'active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "budget".$row->id;
				$ci->load->model('Budget_model',$alias);
				$nextBudget = $ci->{$alias}->load($row->id);
			}
		}
		
		$nextBudget->addCategories($budget);
		
		redirect(base_url()."home");
	}
}