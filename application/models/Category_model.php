<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model {
	
	/**
	 * The table name for this model
	 *
	 * @var string
	 */
	protected $_table = "categories";
	
	/**
	 * The name of the category
	 *
	 * @var string
	 */
	protected $_name;
	
	/**
	 * The purchase date of the category
	 *
	 * @var number
	 */
	protected $_value;
	
	/**
	 * The active status of category
	 *
	 * @var boolean
	 */
	protected $_active;

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Loads the category
	 *
	 * @param string $id The ID of the category to be loaded
 	 * @param boolean $active Whether the category is active or not
	 * @return object $this Returns a copy of the category object or false if not found
	 */
	public function load($id,$active=true) {
	
		$query = $this->db->get_where($this->_table,array('id'=>$id,'active'=>$active,'deleted'=>NULL));
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$this->_id = $row->id;
				$this->_name = $row->name;
				$this->_value = $row->value;
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
			'name' => $this->_name,
			'value' => $this->_value,
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
			'name' => $this->_name,
			'value' => $this->_value,
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
	 * Loads an empty instance of the category model
	 *
	 */
	public function instance() {
	
		return $this;
	
	}
	
	/**
	 * Get the name for the category
	 *
	 * @return string
	 */
	public function getName() {
		return $this->_name;
	}
	
	/**
	 * Set the name for the category
	 *
	 * @param string $value The name of the category
	 */
	public function setName($value) {
		$this->_name = $value;
	}
	
	/**
	 * Get the default value for the category
	 *
	 * @return number
	 */
	public function getValue() {
		return $this->_value;
	}
	
	/**
	 * Set the default value for the category
	 *
	 * @param integer $value The default value of the category
	 */
	public function setValue($value) {
		$this->_value = $value;
	}
	
	/**
	 * Get the active status for the category
	 *
	 * @return boolean
	 */
	public function getActive() {
		return $this->_active;
	}
	
	/**
	 * Set the active status for the category
	 *
	 * @param boolean $value The active status of the category
	 */
	public function setActive($value) {
		$this->_active = $value;
	}

}