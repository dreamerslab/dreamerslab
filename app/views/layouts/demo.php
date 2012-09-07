<?=doctype('xhtml1-trans')?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?$this->view->metas()?>
    <?$this->view->title()?>
    <?$this->view->asset('css')?>
    <?=link_tag( base_url().'favicon.png', 'shortcut icon', 'image/ico')?>
  </head>
  <body>
    <div id="wrap">
      <ul id="share" class="clearfix">
        <li class="float-l">
          <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="dreamerslab">Tweet</a>
        </li>
        <li class="float-l">
          <div class="g-plusone" data-size="medium"></div>
        </li>
        <li class="float-l">
          <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fdreamerslab.com<?=str_replace('/', '%2F', $this->uri->uri_string)?>&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=lucida+grande&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
        </li>
      </ul>
      <?=$yield?>
      <?$this->view->partial('common/_footer')?>
    </div>
    
    <?$this->view->asset('js')?>
  </body>
</html>
