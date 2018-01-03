<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 */
class MY_Model extends CI_Model {
	
	/**
	 * The table name for this model
	 *
	 * @var string
	 */
	protected $_table = "";
	
	/**
	 * The id for this model
	 *
	 * @var string
	 */
	protected $_id;

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Set the ID for this model
	 *
	 * @param string $id The ID to be used by this model
	 * @return string
	 */
	public function setID($id) {
		$this->_id = $id;
	}
	
	/**
	 * Get the ID for this model
	 *
	 * @return string
	 */
	public function getID() {
		return $this->_id;
	}

}