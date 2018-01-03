<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	
	
	/**
	* Default header view
	*
	* @var string
	*/
	protected $_header = 'header';
	
	/**
	* Default footer view
	*
	* @var string
	*/
	protected $_footer = 'footer';
	
	/**
	* Default data variables
	*
	* @var array
	*/
	protected $_data = array();	

	/**
	 * Display a page
	 *
	 * @param string $view The name of the view file to be used
 	 * @param array $vars Any data that should be passed to the view
	 * @param boolean $return Returns the view result as a string
	 * @param boolean $include_header Include the header file in the string result
	 * @param boolean $include_footer Include the footer file in the string result
	 * @return string $content Prints the view result
	 */
    public function view($view, $vars = array(), $return = TRUE, $include_header = TRUE, $include_footer = TRUE)
    {
    	//get the current instantiated instance of the Code Ignitor class
    	$this->CI = &get_instance();
    	
    	//add the $vars data to the data variable
    	$data = array_merge($this->_data, $vars);   	
    	
        $content = '';

        if ($include_header)
        {
            $content .= $this->CI->load->view($this->_header, $data, $return);
        }

        $content .= $this->CI->load->view($view, $data, $return);

        if ($include_footer)
        {
            $content .= $this->CI->load->view($this->_footer, $data, $return);
        }

        echo $content;
    }
	
	/**
	 * Set the header file
	 *
	 * @param string $value The name of the header file to be used
	 */
	public function setHeader($value){
		$this->_header = $value;
	}
	
	/**
	 * Set the footer file
	 *
	 * @param string $value The name of the footer file to be used
	 */
	public function setFooter($value){
		$this->_footer = $value;
	}
}