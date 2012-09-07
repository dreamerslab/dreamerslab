<?=doctype('xhtml1-trans')?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?$this->view->metas()?>
    <?$this->view->title()?>
    <?$this->view->asset('css')?>
    <?=link_tag( base_url().'favicon.png', 'shortcut icon', 'image/ico')?>
  </head>
  <body class="<?=lang('common.lang.current')?>">
    <div id="bg-wrap"><div id="bg"></div></div>
    
    <div id="wrap">
      
      <div id="header">
        <h1><span class="hidden"><?=$title?></span></h1>
        <a id="home" href="<?=site_url('about')?>" title="<?=lang('common.go_home')?>" rel="home">
          Home
        </a>
        <?$this->view->partial('common/_lang')?>
        <?$this->view->partial('common/_nav')?>
      </div><!-- #header -->

      <div id="main" class="tabs clearfix">
        <?=$yield?>
        <div id="fb">
          <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fdreamerslab.com<?=str_replace('/', '%2F', $this->uri->uri_string)?>&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
        </div>
        <div class="spliter"></div>
      </div><!-- #main -->

      <?$this->view->partial('common/_footer')?>
      
    </div><!-- #wrap -->
    
    <?$this->view->asset('js')?>
    
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/js/ie6.js"></script>
    <![endif]-->
  </body>
</html>
