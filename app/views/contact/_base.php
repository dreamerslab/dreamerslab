<?
  $this->view->partial('common/_sub_nav', array(
    'sub_nav' => array(
      array('title' => lang('contact.emailus'), 'href' => 'email'),
      array('title' => lang('contact.guestbook'), 'href' => 'guestbook')
  )));
?>

<div id="content">
  <div id="email" class="clearfix">
    <h2><?=$heading?></h2>
    <div class="spliter spacer40"></div>
    <div id="info" class="float-l">
      <div class="row">
        <span><?=lang('contact.email')?></span>
        hello@dreamerslab.com
      </div>
      <div class="row">
        <span><?=lang('contact.tel')?></span>
        +886-2-22250013
      </div>
      <div class="row">
        <span><?=lang('contact.location')?></span>
        <?=lang('contact.address')?>
      </div>
      <div class="row">
        <span>Twitter</span>
        http://twitter.com/dreamerslab
      </div>
    </div>
    <div id="form" class="float-r">
      <?=form_open('contact/send', array('id' => 'email-form'))?>
      <div class="row">
        <label for="contact-name"><?=lang('contact.name')?>:</label>
        <?=form_input(array('id' => 'contact-name', 'name' => 'name', 'value' => $name, 'class' => 'text'))?>
        <?=form_error('name', '<label class="error">', '</label>')?>
      </div>
      <div class="row">
        <label for="contact-email"><?=lang('contact.email')?>:</label>
        <?=form_input(array('id' => 'contact-email', 'name' => 'email', 'value' => $email, 'class' => 'text'))?>
        <?=form_error('email', '<label class="error">', '</label>')?>
      </div>
      <div class="row">
        <label for="contact-comments"><?=lang('contact.comments')?>:</label>
        <?=form_textarea(array('id' => 'contact-comments', 'name' => 'comments', 'value' => $comments, 'cols' => 24, 'rows' => 6 ))?>
        <?=form_error('comments', '<label class="error">', '</label>')?>
      </div>
      <?=form_submit(array('class' => 'btn', 'name' => 'submit', 'value' => lang('common.send')))?>
      <?=form_close()?>
    </div>
  </div>

  <div id="guestbook">
    <h2><?=lang('contact.guestbook.h')?></h2>
    <div class="spliter spacer40"></div>
    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/<?=lang('contact.lang')?>/all.js#appId=170365112989904&amp;xfbml=1"></script>
    <div id="fb-comments">
      <fb:comments href="dreamerslab.com/<?=lang('common.lang.current')?>/contact" num_posts="10" width="800"></fb:comments>
    </div>
  </div>
  <div class="spliter"></div>
</div>