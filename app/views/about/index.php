<?
  $this->view->partial('common/_sub_nav', array(
    'sub_nav' => array(
      array('title' => lang('about.lab'), 'href' => 'lab'),
      array('title' => lang('about.ben'), 'href' => 'ben'),
      array('title' => lang('about.fred'), 'href' => 'fred'),
      array('title' => lang('about.mason'), 'href' => 'mason')
  )));
?>

<div id="content">
  <div id="lab">
    <h2><?=lang('about.lab.h')?></h2>
    <div class="spliter spacer40"></div>
    <p id="map" class="float-r">
      <iframe width="500" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?=lang('about.maps.src')?>"></iframe>
      <br />
      <?=lang('about.maps.link')?>
    </p>
    <?=lang('about.lab.content')?>
  </div>
  <div id="ben">
    <h2><?=lang('about.ben.h')?></h2>
    <div class="spliter spacer40"></div>
    <div id="ben-pic"></div>
    <?=lang('about.ben.content')?>
  </div>
  <div id="fred">
    <h2><?=lang('about.fred.h')?></h2>
    <div class="spliter spacer40"></div>
    <div id="fred-pic"></div>
    <?=lang('about.fred.content')?>
  </div>
  <div id="mason">
    <h2><?=lang('about.mason.h')?></h2>
    <div class="spliter spacer40"></div>
    <div id="mason-pic"></div>
    <?=lang('about.mason.content')?>
  </div>
  <div class="spliter"></div>
</div>