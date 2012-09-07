<div id="sub-nav">
  <ul class="clearfix">
    <?foreach($sub_nav as $list):?>
    <li>
      <h4>
        <a href="#<?=$list['href']?>" title="<?=$list['title']?>">
          <?=$list['title']?>
        </a>
      </h4>
    </li>
    <?endforeach?>
  </ul>
</div>