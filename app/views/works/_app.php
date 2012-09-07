<li id="<?=$name?>" class="list-item clearfix">
  <div class="description">
    <h3><?=$heading?></h3>
    <h4><?=lang("works.{$name}.h")?></h4>
    <?=lang("works.{$name}.content")?>
  </div>
  <div class="gallery">
    <img class="app-logo" src="<?=$img?>" alt="<?=$name?>-logo"/>
    <div class="thumbnails">
      <?foreach($thumbs as $list):?>
      <a title="<?=$list['title']?>" rel="<?=$name?>" href="<?=$list['href']?>_b.jpg">
        <img src="<?=$list['src']?>_s.jpg" alt="<?=$alt?>"/>
      </a>
      <?endforeach?>
    </div>
  </div>
</li>
<li class="spliter"></li>