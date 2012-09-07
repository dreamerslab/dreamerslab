<?
  $href = $this->lang->switch_uri(lang('common.lang.alt'));

  if( lang('common.lang.current') == 'en' ){
    $en = '<span>English</span>';
    $tw = anchor($href, '繁體中文', array('title' => '前往繁體中文頁面', 'class' => 'chinese'));
  }else{
    $en = anchor($href, 'English', array('title' => 'Go to English page'));
    $tw = '<span class="chinese">繁體中文</span>';
  }
?>
<div id="lang" lang="<?=lang('common.lang.current')?>">
  <?=$en?> | <?=$tw?>
</div><!-- #lang -->