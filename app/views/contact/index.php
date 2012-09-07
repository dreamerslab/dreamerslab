<?
  $this->view->partial('contact/_base', array(
    'heading' => lang('contact.email.h'),
    'name' => set_value('name'),
    'email' => set_value('email'),
    'comments' => set_value('comments')
  ));
?>