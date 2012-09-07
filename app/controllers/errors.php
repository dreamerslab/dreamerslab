<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends MY_Controller{

  private $_data;

	public function __construct()
	{
		parent::__construct();

    $this->_data['nav_selected'] = 'none';
	}
  
	public function error_404()
	{
    $this->view->render($this->_data);
	}

}
// End of Errors class

/* End of file errors.php */
/* Location: ./app/controllers/errors.php */