<div id="nav">
  <ul class="clearfix">
    <li>
      <h3>
        <a id="nav-about" class="<?selected('about', $nav_selected)?>" href="<?=site_url('about')?>" title="<?=lang('common.go_about')?>">
          <span><?=lang('common.about')?></span>
        </a>
      </h3>
    </li>
    <li>
      <h3>
        <a id="nav-works" class="<?selected('works', $nav_selected)?>" href="<?=site_url('works')?>" title="<?=lang('common.go_works')?>">
          <span><?=lang('common.works')?></span>
        </a>
      </h3>
    </li>
    <li>
      <h3>
        <a id="nav-contact" class="<?selected('contact', $nav_selected)?>" href="<?=site_url('contact')?>" title="<?=lang('common.go_contact')?>">
          <span><?=lang('common.contact')?></span>
        </a>
      </h3>
    </li>
    <li>
      <h3>
        <a id="nav-blog" href="<?=base_url().'blog/'.lang('common.lang.current')?>" title="<?=lang('common.go_blog')?>">
          <span><?=lang('common.blog')?></span>
        </a>
      </h3>
    </li>
  </ul>
</div>