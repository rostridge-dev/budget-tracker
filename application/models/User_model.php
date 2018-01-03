<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
	
	/**
	 * The table name for this model
	 *
	 * @var string
	 */
	protected $_table = "users";
	
	/**
	 * The username of this user
	 *
	 * @var string
	 */
	protected $_username;
	
	/**
	 * The first name of this user
	 *
	 * @var string
	 */
	protected $_firstname;
	
	/**
	 * The last name of this user
	 *
	 * @var string
	 */
	protected $_lastname;
	
	/**
	 * The password of this user (set only)
	 *
	 * @var string
	 */
	protected $_password;
	
	/**
	 * The active status of this user
	 *
	 * @var string
	 */
	protected $_active;

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Loads the user
	 *
	 * @param string $id The ID of the user to be loaded
 	 * @param boolean $active Whether the user is active or not
	 * @return object $this Returns a copy of the user object or false if not found
	 */
	public function load($id,$active=true) {
	
		$query = $this->db->get_where($this->_table,array('id'=>$id,'active'=>$active));
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$this->_id = $row->id;
				$this->_username = $row->username;
				$this->_firstname = $row->firstname;
				$this->_lastname = $row->lastname;
				$this->_active = $row->active;
			}
			return $this;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Edits an entry for this model
	 *
	 * @return boolean
	 */
	public function edit() {
		
		if ($this->_password != "") {
			$data = array(
				'id' => $this->_id,
				'username' => $this->_username,
				'firstname' => $this->_firstname,
				'lastname' => $this->_lastname,
				'password' => $this->_password,
				'active' => $this->_active			
			);
		} else {	
			$data = array(
				'id' => $this->_id,
				'username' => $this->_username,
				'firstname' => $this->_firstname,
				'lastname' => $this->_lastname,
				'active' => $this->_active			
			);
		}
		$this->db->where('id',$this->_id);
		$this->db->update($this->_table,$data);
		
		return true;
	}	
	
	/**
	 * Authenticate the user
	 *
	 * @param string $username The username to authenticate
	 * @param string $password The password for the selected user
	 * @return boolean $authenticated
	 */
	public function authenticate ($username,$password) {
		
		$authenticated = false;
		
		$query = $this->db->get_where($this->_table,array('username'=>$username,'password'=>$password,'active'=>true));
		foreach ($query->result() as $row) {
			$authenticated = $row->id;
		}
		
		return $authenticated;
		
	}
	
	/**
	 * Get the username for the user
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->_username;
	}
	
	/**
	 * Set the username for the user
	 *
	 * @param string $value The value of the username
	 */
	public function setUsername($value) {
		$this->_username = $value;
	}
	
	/**
	 * Get the first name for the user
	 *
	 * @return string
	 */
	public function getFirstname() {
		return $this->_firstname;
	}

	/**
	 * Set the first name for the user
	 *
	 * @param string $value The first name
	 */
	public function setFirstname($value) {
		$this->_firstname = $value;
	}
	
	/**
	 * Get the first name for the user
	 *
	 * @return string
	 */
	public function getLastname() {
		return $this->_lastname;
	}
	
	/**
	 * Set the last name for the user
	 *
	 * @param string $value The last name
	 */
	public function setLastname($value) {
		$this->_lastname = $value;
	}
	
	/**
	 * Set the password for the user
	 *
	 * @param string $value The password
	 */
	public function setPassword($value) {
		$this->_password = $value;
	}
	
	/**
	 * Set the active status for the user
	 *
	 * @param boolean $value The active status of the user
	 */
	public function setActive($value) {
		$this->_active = $value;
	}

}