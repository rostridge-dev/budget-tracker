<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index() {
		
		$ci =& get_instance();
		$test_output = "";
		
		/********************************************************************/
		// Unit test an entry model, load the model and mock it up
		$test_alias = "unit_entries";
		$this->load->library('unit_test',null,$test_alias);
		$this->{$test_alias}->use_strict(TRUE);
		$test_output .= "<h2>Tests for Entries model</h2>";
		$alias = "entries";
		$ci->load->model('Entry_model',$alias);
		$entry_mock = $ci->{$alias};
		$entry_mock->setUserID(1);
		$entry_mock->setDate("2020-01-01");
		$entry_mock->setCategoryID(1);
		$entry_mock->setAmount(50.99);
		$entry_mock->setNotes("Kids programs");
		$entry_mock->setActive(1);
		
		// Test getting the userID
		$entry_test_name = "Get the entry user ID";
		$entry_test = $entry_mock->getUserID();
		$entry_result = 1;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the date
		$entry_test_name = "Get the entry date";
		$entry_test = $entry_mock->getDate();
		$entry_result = "2020-01-01";
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the category ID
		$entry_test_name = "Get the entry category ID";
		$entry_test = $entry_mock->getCategoryID();
		$entry_result = 1;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the amount
		$entry_test_name = "Get the entry amount";
		$entry_test = $entry_mock->getAmount();
		$entry_result = 50.99;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the notes
		$entry_test_name = "Get the entry notes";
		$entry_test = $entry_mock->getNotes();
		$entry_result = "Kids programs";
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the active status
		$entry_test_name = "Get the active status";
		$entry_test = $entry_mock->getActive();
		$entry_result = 1;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Run the Entries tests
		$test_output .= $this->{$test_alias}->report();
		
		/********************************************************************/
		// Unit test a category model, load the model and mock it up
		$test_alias = "unit_category";
		$this->load->library('unit_test',null,$test_alias);
		$this->{$test_alias}->use_strict(TRUE);
		$test_output .= "<h2>Tests for Category model</h2>";
		$alias = "category";
		$ci->load->model('Category_model',$alias);
		$entry_mock = $ci->{$alias};
		$entry_mock->setName("Grocery");
		$entry_mock->setValue(500.00);
		$entry_mock->setActive(1);
		
		// Test getting the name
		$entry_test_name = "Get the category name";
		$entry_test = $entry_mock->getName();
		$entry_result = "Grocery";
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the name
		$entry_test_name = "Get the category value";
		$entry_test = $entry_mock->getValue();
		$entry_result = 500.00;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the active status
		$entry_test_name = "Get the active status";
		$entry_test = $entry_mock->getActive();
		$entry_result = 1;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Run the Categories tests
		$test_output .= $this->{$test_alias}->report();
		
		/********************************************************************/
		// Unit test a category model, load the model and mock it up
		$test_alias = "unit_budget";
		$this->load->library('unit_test',null,$test_alias);
		$this->{$test_alias}->use_strict(TRUE);
		$test_output .= "<h2>Tests for Budget model</h2>";
		$alias = "budget";
		$ci->load->model('Budget_model',$alias);
		$entry_mock = $ci->{$alias};
		$entry_mock->setYear(2020);
		$entry_mock->setMonth(10);
		$entry_mock->setActive(1);
		
		// Test getting the year
		$entry_test_name = "Get the budget year";
		$entry_test = $entry_mock->getYear();
		$entry_result = 2020;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the month
		$entry_test_name = "Get the budget month";
		$entry_test = $entry_mock->getMonth();
		$entry_result = 10;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Test getting the active status
		$entry_test_name = "Get the active status";
		$entry_test = $entry_mock->getActive();
		$entry_result = 1;
		$this->{$test_alias}->run($entry_test,$entry_result,$entry_test_name);
		
		// Run the Categories tests
		$test_output .= $this->{$test_alias}->report();
		
		echo $test_output;
	}
}