<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demos extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
    // do not do $this->view->render(); here
    // otherwise the error_404 will never work
	}
  
	public function preload_images_with_jquery_preload_plugin()
	{
    $this->view->render();
	}

  public function get_hidden_element_width_with_jquery_actual_plugin()
	{
    $this->view->render();
	}

  public function get_hidden_element_width_with_jquery_actual_plugin_with_css3pie()
	{
    $this->view->render();
	}

  public function hide_global_objects_in_javascript()
  {
    $this->view->render();
  }

  public function javascript_loose_coupling_with_jquery_queue_plugin()
  {
    $this->view->render();
  }

  public function centralize_html_dom_element_with_jquery_center_plugin()
  {
    $this->view->render();
  }

  public function jquery_blockui_alternative_with_jquery_msg_plugin()
  {
    $this->view->render();
  }

  public function google_image_search_style_image_alignment_with_jquery_atteeeeention_plugin()
  {
    $this->view->render();
  }

}
// End of Demos class

/* End of file demos.php */
/* Location: ./app/controllers/demos.php */