<li id="<?=$name?>" class="list-item clearfix">
  <div class="description">
    <h3><?=$heading?></h3>
    <h4><?=lang("works.{$name}.h")?></h4>
    <?=lang("works.{$name}.content")?>
    <div class="more clearfix">

      <?foreach($more as $list):?>
      <a class="<?=$list['class']?>" href="<?=$list['href']?>"><?=$list['title']?></a>
      <?endforeach?>

    </div>
  </div>
  <div class="gallery">
    <img class="plugin-logo" src="<?=$img?>" alt="<?=$name?>-logo"/>
  </div>
</li>
<li class="spliter"></li>