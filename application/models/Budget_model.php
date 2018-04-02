<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends MY_Model {
	
	/**
	 * The table name for this model
	 *
	 * @var string
	 */
	protected $_table = "budgets";
	
	/**
	 * The year of the budget
	 *
	 * @var number
	 */
	protected $_year;
	
	/**
	 * The month of the budget
	 *
	 * @var number
	 */
	protected $_month;
	
	/**
	 * The active status of budget
	 *
	 * @var boolean
	 */
	protected $_active;

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Loads the budget
	 *
	 * @param string $id The ID of the budget to be loaded
 	 * @param boolean $active Whether the budget is active or not
	 * @return object $this Returns a copy of the budget object or false if not found
	 */
	public function load($id,$active=true) {
	
		$query = $this->db->get_where($this->_table,array('id'=>$id,'active'=>$active,'deleted'=>NULL));
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$this->_id = $row->id;
				$this->_year = $row->year;
				$this->_month = $row->month;
				$this->_active = $row->active;
			}
			return $this;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Adds an entry for this model
	 *
	 * @return boolean
	 */
	public function add() {
		
		$data = array(
			'year' => $this->_year,
			'month' => $this->_month,
			'active' => $this->_active			
		);
		$this->db->insert($this->_table,$data);
		
		return true;
	}
	
	/**
	 * Edits an entry for this model
	 *
	 * @return boolean
	 */
	public function edit() {
		
		$data = array(
			'year' => $this->_year,
			'month' => $this->_month,
			'active' => $this->_active
		);
		$this->db->where('id',$this->_id);
		$this->db->update($this->_table,$data);
		
		return true;
	}	
	
	/**
	 * Deletes an entry for this model
	 *
	 * @return boolean
	 */
	public function delete() {
		
		$data = array('active'=>false,'deleted'=>true);
		$this->db->where('id',$this->_id);
		$this->db->update($this->_table, $data);
		
		return true;
	}
	
	/**
	 * Loads an empty instance of the budget model
	 *
	 */
	public function instance() {
	
		return $this;
	
	}
	
	/**
	 * Get the year for the budget
	 *
	 * @return integer
	 */
	public function getYear() {
		return $this->_year;
	}
	
	/**
	 * Set the year for the budget
	 *
	 * @param integer $value The year of the budget
	 */
	public function setYear($value) {
		$this->_year = $value;
	}
	
	/**
	 * Get the month for the budget
	 *
	 * @return integer The month of the budget
	 */
	public function getMonth() {
		return $this->_month;
	}
	
	/**
	 * Set the month for the budget
	 *
	 * @param integer $value The month of the budget
	 */
	public function setMonth($value) {
		$this->_month = $value;
	}
	
	/**
	 * Get the active status for the budget
	 *
	 * @return boolean
	 */
	public function getActive() {
		return $this->_active;
	}
	
	/**
	 * Set the active status for the budget
	 *
	 * @param boolean $value The active status of the budget
	 */
	public function setActive($value) {
		$this->_active = $value;
	}
	
	/**
	 * Get the list of category allowances for the budget
	 *
	 * @return array The list of category allowances for the budget
	 */
	public function getCategoryAllowances() {
		$ci =& get_instance();
		$categories = array();
		
		$query = $ci->db->get_where('budget_categories',array('budget_id'=>$this->_id,'active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$alias = "categories".$row->id;
				$ci->load->model('Category_model',$alias);
				$categories[$row->category_id] = $ci->{$alias}->load($row->category_id);
				$defaultValue = $categories[$row->category_id]->getValue();
				$categories[$row->category_id]->setValue($defaultValue + $row->carryover);
			}
		}
		
		return $categories;
		
	}
	
	/**
	 * Get the list of category totals for the budget
	 *
	 * @return array The list of category totals for the budget
	 */
	public function getCategoryTotals() {
		$ci =& get_instance();
		$categories = $totals = array();
		
		$query = $ci->db->get_where('budget_categories',array('budget_id'=>$this->_id,'active'=>true,'deleted'=>NULL));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$categories[] = $row->category_id;
			}
		}
		
		foreach ($categories as $category_id) {
			$sum = 0;
			$query = $ci->db->get_where('entries',array('category_id'=>$category_id,'active'=>true,'deleted'=>NULL));
			foreach ($query->result() as $row) {
				if ((date("Y",strtotime($row->date)) == $this->_year) && (date("n",strtotime($row->date)) == $this->_month)) {
					$sum += $row->amount;
				}
			}
			$totals[$category_id] = $sum;
		}
		
		return $totals;
		
	}
	
	/**
	 * Add in the categories for the current budget, using last month's budget for carryover values
	 *
	 * @param object $previousBudget An object that stores the budget from the month prior to this one
	 * @return boolean
	 */
	public function addCategories($previousBudget) {
		$ci =& get_instance();
		$categories = array();
		
		// Get the budget details
		$previousAllowances = $previousBudget->getCategoryAllowances();
		$previousTotals = $previousBudget->getCategoryTotals();
		
		$query = $ci->db->get_where('categories',array('active'=>true,'deleted'=>NULL));
		foreach ($query->result() as $row) {
			$alias = "category".$row->id;
			$ci->load->model('Category_model',$alias);
			$category = $ci->{$alias}->load($row->id);
			$categories[$row->id] = $category;
		}
		
		foreach ($categories as $category_id => $category) {
			$value = round($previousAllowances[$category->getID()]->getValue() - $previousTotals[$category->getID()],2);
			$data = array(
				'budget_id' => $this->_id,
				'category_id' => $category->getID(),
				'carryover' => $value,
				'active' => $this->_active			
			);
			
			$ci->db->insert('budget_categories',$data);
		}
		
		return true;
		
	}

}