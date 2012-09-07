<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    $this->lang->load('about');

    $data['nav_selected'] = 'about';
    $this->view->render($data);
  }
  
}
// End of About class

/* End of file about.php */
/* Location: ./app/controllers/about.php */