<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_Model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function validate()
	{
    $this->load->library('form_validation');

    $config = array(
      array(
        'field'   => 'name',
        'label'   => lang('contact.name'),
        'rules'   => 'required'
      ),
      array(
        'field'   => 'email',
        'label'   => lang('contact.email'),
        'rules'   => 'required|valid_email'
      ),
      array(
        'field'   => 'comments',
        'label'   => lang('contact.comments'),
        'rules'   => 'required'
      )
    );

    $this->form_validation->set_rules($config);

    return $this->form_validation->run();
	}
	
	public function send()
	{
    $ip = $this->input->ip_address();
    $name = $this->input->post('name', TRUE);
    $email = $this->input->post('email', TRUE);
    $comments = "IP: {$ip}\n\n{$this->input->post('comments', TRUE)}";

    $this->load->library('email');

    $this->email->from($email, $name);
    $this->email->to('site@dreamerslab.com');
    $this->email->subject("Comments on DreamersLab");
    $this->email->message($comments);

    return $this->email->send();
	}
}