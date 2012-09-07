<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
	}
  
	public function index()
	{
    $this->lang->load('works');

    $data['nav_selected'] = 'works';
    $this->view->render($data);
	}

}
// End of Works class

/* End of file works.php */
/* Location: ./app/controllers/works.php */