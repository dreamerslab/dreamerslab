<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  
  public function __construct()
	{
		parent::__construct();
      $this->lang->load('common');
      // cache output for an year
      $this->output->cache(3628800);
	}

}
// End of MY_Controller class
// End of file MY_Controller.php
// Location: ./app/libraries/MY_Controller.php