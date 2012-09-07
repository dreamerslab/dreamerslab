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
        <?$this->view->partial('common/_nav')?>
      </div><!-- #header -->

      <div id="main" class="tabs clearfix">
        <?=$yield?>
      </div><!-- #main -->

      <?$this->view->partial('common/_footer')?>

    </div><!-- #wrap -->

    <?$this->view->asset('js')?>

    <!--[if lt IE 7]>
    <script type="text/javascript" src="/js/ie6.js"></script>
    <![endif]-->
  </body>
</html>
