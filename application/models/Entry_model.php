<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry_model extends MY_Model {
	
	/**
	 * The table name for this model
	 *
	 * @var string
	 */
	protected $_table = "entries";
	
	/**
	 * The user associated to the entry
	 *
	 * @var integer
	 */
	protected $_user_id;
	
	/**
	 * The date of the entry (YYYY-MM-DD)
	 *
	 * @var string
	 */
	protected $_date;
	
	/**
	 * The category ID of the entry (entertainment, grocery, etc)
	 *
	 * @var integer
	 */
	protected $_category_id;
	
	/**
	 * The distance run for the entry in kilometers
	 *
	 * @var number
	 */
	protected $_amount;
	
	/**
	 * The notes for an entry
	 *
	 * @var string
	 */
	protected $_notes;
	
	/**
	 * The active status of entry
	 *
	 * @var boolean
	 */
	protected $_active;

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Loads the entry
	 *
	 * @param string $id The ID of the entry to be loaded
 	 * @param boolean $active Whether the entry is active or not
	 * @return object $this Returns a copy of the entry object or false if not found
	 */
	public function load($id,$active=true) {
	
		$query = $this->db->get_where($this->_table,array('id'=>$id,'active'=>$active,'deleted'=>NULL));
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$this->_id = $row->id;
				$this->_user_id = $row->user_id;
				$this->_date = $row->date;
				$this->_category_id = $row->category_id;
				$this->_amount = $row->amount;
				$this->_notes = $row->notes;
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
			'user_id' => $this->_user_id,
			'date' => $this->_date,
			'category_id' => $this->_category_id,
			'amount' => $this->_amount,
			'notes' => $this->_notes,
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
			'user_id' => $this->_user_id,
			'date' => $this->_date,
			'category_id' => $this->_category_id,
			'amount' => $this->_amount,
			'notes' => $this->_notes,
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
	 * Loads an empty instance of the entry model
	 *
	 */
	public function instance() {
	
		return $this;
	
	}
	
	/**
	 * Get the userID for the entry
	 *
	 * @return integer
	 */
	public function getUserID() {
		return $this->_user_id;
	}
	
	/**
	 * Set the userID for the entry
	 *
	 * @param integer $value The userID of the entry
	 */
	public function setUserID($value) {
		$this->_user_id = $value;
	}
	
	/**
	 * Get the date for the entry
	 *
	 * @return string
	 */
	public function getDate() {
		return $this->_date;
	}
	
	/**
	 * Set the date for the entry
	 *
	 * @param string $value The date of the entry
	 */
	public function setDate($value) {
		$this->_date = $value;
	}
	
	/**
	 * Get the category ID for the entry
	 *
	 * @return integer
	 */
	public function getCategoryID() {
		return $this->_category_id;
	}
	
	/**
	 * Set the category ID for the entry
	 *
	 * @param integer $value The category ID of the entry
	 */
	public function setCategoryID($value) {
		$this->_category_id = $value;
	}
	
	/**
	 * Get the amount of the entry
	 *
	 * @return string
	 */
	public function getAmount() {
		return $this->_amount;
	}
	
	/**
	 * Set the amount for the entry
	 *
	 * @param float $value The amount of the entry
	 */
	public function setAmount($value) {
		$this->_amount = $value;
	}
	
	/**
	 * Get the notes for the entry
	 *
	 * @return string
	 */
	public function getNotes() {
		return $this->_notes;
	}
	
	/**
	 * Set the notes for the entry
	 *
	 * @param string $value The notes of the entry
	 */
	public function setNotes($value) {
		if ($value == NULL) {
			$this->_notes = "";
		} else {
			$this->_notes = $value;
		}
	}
	
	/**
	 * Set the active status for the entry
	 *
	 * @param boolean $value The active status of the entry
	 */
	public function setActive($value) {
		$this->_active = $value;
	}

}