<?
  $this->view->partial('common/_sub_nav', array(
    'sub_nav' => array(
      array('title' => lang('works.apps'), 'href' => 'apps'),
      array('title' => lang('works.open_source'), 'href' => 'open-source')
  )));

  $current_lang = lang('common.lang.current');
?>

<div id="content">
  <div id="apps">
    <h2><?=lang('works.apps.h')?></h2>
    <div class="spliter"></div>
    <ul class="list-block">
      <?
        $this->view->partial('works/_app', array(
          'heading' => 'ICEBERG',
          'name' => 'iceberg',
          'img' => 'http://farm7.static.flickr.com/6173/6213065213_0bb8419a81_o.png',
          'alt' => lang('works.iceberg.alt'),
          'thumbs' => array(
            array('title' => lang('works.iceberg.desc1'),
                  'href' => 'http://farm7.static.flickr.com/6093/6213309023_dbed3c9365',
                  'src' => 'http://farm7.static.flickr.com/6215/6213047873_1117b63a32'),
            array('title' => lang('works.iceberg.desc2'),
                  'href' => 'http://farm7.static.flickr.com/6042/6213823200_37cb3e2da7',
                  'src' => 'http://farm7.static.flickr.com/6154/6213047967_879616a20e'),
            array('title' => lang('works.iceberg.desc3'),
                  'href' => 'http://farm7.static.flickr.com/6102/6213823160_6b49a52129',
                  'src' => 'http://farm7.static.flickr.com/6105/6213562424_606b2d4e09'),
            array('title' => lang('works.iceberg.desc4'),
                  'href' => 'http://farm7.static.flickr.com/6159/6213308803_6635341e22',
                  'src' => 'http://farm7.static.flickr.com/6059/6213048027_b09cd67cd1'),
            array('title' => lang('works.iceberg.desc5'),
                  'href' => 'http://farm7.static.flickr.com/6052/6213823106_57044026e1',
                  'src' => 'http://farm7.static.flickr.com/6216/6213047925_9d1d3d2717')
          )
        ))->partial('works/_app', array(
          'heading' => 'MacFlickr',
          'name' => 'macflickr',
          'img' => 'http://farm6.static.flickr.com/5293/5491220890_055e8dc575_o.jpg',
          'alt' => lang('works.macflickr.alt'),
          'thumbs' => array(
            array('title' => lang('works.macflickr.desc1'),
                  'href' => 'http://farm5.static.flickr.com/4075/5487360781_8564761e8b',
                  'src' => 'http://farm5.static.flickr.com/4075/5487360781_8564761e8b'),
            array('title' => lang('works.macflickr.desc2'),
                  'href' => 'http://farm5.static.flickr.com/4135/5487361053_0031c64fe1',
                  'src' => 'http://farm5.static.flickr.com/4135/5487361053_0031c64fe1'),
            array('title' => lang('works.macflickr.desc3'),
                  'href' => 'http://farm6.static.flickr.com/5135/5487955934_c98693416d',
                  'src' => 'http://farm6.static.flickr.com/5135/5487955934_c98693416d'),
            array('title' => lang('works.macflickr.desc4'),
                  'href' => 'http://farm5.static.flickr.com/4078/5487361627_e3f9f5f37b',
                  'src' => 'http://farm5.static.flickr.com/4078/5487361627_e3f9f5f37b'),
            array('title' => lang('works.macflickr.desc5'),
                  'href' => 'http://farm6.static.flickr.com/5055/5487361929_393b5460c3',
                  'src' => 'http://farm6.static.flickr.com/5055/5487361929_393b5460c3')
           )
         ));
      ?>
    </ul>
  </div>
  <div id="open-source">
    <h2><?=lang('works.open_source.h')?></h2>
    <div class="spliter"></div>
    <ul class="list-block">
      <?
        $this->view->partial('works/_open_source', array(
          'heading' => 'jQuery Preload Plugin',
          'name' => 'jquery-preload',
          'img' => 'http://farm6.static.flickr.com/5296/5512158063_a484a43c90.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.preload'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.preload/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/preload-images-with-jquery-preload-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/preload-images-with-jquery-preload-plugin')
          )
        ))->partial('works/_open_source', array(
          'heading' => 'jQuery Actual Plugin',
          'name' => 'jquery-actual',
          'img' => 'http://farm6.static.flickr.com/5012/5512751028_c74b54fa43.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.actual'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.actual/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/get-hidden-elements-width-and-height-with-jquery/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/get-hidden-element-width-with-jquery-actual-plugin')
           )
         ))->partial('works/_open_source', array(
          'heading' => 'jQuery Secret Plugin',
          'name' => 'jquery-secret',
          'img' => 'http://farm6.static.flickr.com/5135/5508993731_d481acdb5c.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.secret'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.secret/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/hide-javascript-global-objects-with-jquery-secret-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/hide-global-objects-in-javascript')
           )
        ))->partial('works/_open_source', array(
          'heading' => 'jQuery Queue Plugin',
          'name' => 'jquery-queue',
          'img' => 'http://farm6.static.flickr.com/5176/5512226095_05b274383c.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.queue'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.queue/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/javascript-loose-coupling-with-jquery-queue-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/javascript-loose-coupling-with-jquery-queue-plugin')
           )
        ))->partial('works/_open_source', array(
          'heading' => 'jQuery Center Plugin',
          'name' => 'jquery-center',
          'img' => 'http://farm6.static.flickr.com/5256/5512155443_37ff5a1783.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.center'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.center/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/centralize-html-dom-element-with-jquery-center-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/centralize-html-dom-element-with-jquery-center-plugin')
           )
        ))->partial('works/_open_source', array(
          'heading' => 'jQuery MSG Plugin',
          'name' => 'jquery-msg',
          'img' => 'http://farm6.static.flickr.com/5295/5512310721_23a4f5c6fe.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.msg'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.msg/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/jquery-blockui-alternative-with-jquery-msg-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/jquery-blockui-alternative-with-jquery-msg-plugin')
           )
        ))->partial('works/_open_source', array(
          'heading' => 'jQuery Atteeeeention Plugin',
          'name' => 'jquery-atteeeeention',
          'img' => 'http://farm6.static.flickr.com/5294/5512226025_5b6b43a3f6.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/jquery.atteeeeention'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/jquery.atteeeeention/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/google-image-search-style-image-alignment-with-jquery-atteeeeention-plugin/"),
            array('class' => 'show-demo',
                  'title' => 'Demo',
                  'href' => '/demos/google-image-search-style-image-alignment-with-jquery-atteeeeention-plugin')
           )
//        ))->partial('works/_open_source', array(
//          'heading' => 'jQuery DateRoller Plugin',
//          'name' => 'jquery-dateRoller',
//          'img' => 'http://farm6.static.flickr.com/5133/5512272217_992c494438.jpg',
//          'more' => array(
//            array('class' => 'not-ready',
//                  'title' => 'Github',
//                  'href' => 'https://github.com/dreamerslab/jquery.dateRoller'),
//            array('class' => 'not-ready',
//                  'title' => 'Download',
//                  'href' => 'https://github.com/dreamerslab/jquery.queue/zipball/master'),
//            array('class' => 'not-ready',
//                  'title' => 'Documentation',
//                  'href' => "/blog/{$current_lang}/a-roller-style-date-picker-with-jquery-dateroller-plugin/"),
//            array('class' => 'not-ready',
//                  'title' => 'Demo',
//                  'href' => '')
//           )
        ))->partial('works/_open_source', array(
          'heading' => 'Codeigniter View Library',
          'name' => 'codeigniter-view',
          'img' => 'http://farm6.static.flickr.com/5099/5512940034_5b92d5c46f.jpg',
          'more' => array(
            array('class' => '',
                  'title' => 'Github',
                  'href' => 'https://github.com/dreamerslab/codeigniter.view'),
            array('class' => '',
                  'title' => 'Download',
                  'href' => 'https://github.com/dreamerslab/codeigniter.view/zipball/master'),
            array('class' => '',
                  'title' => 'Documentation',
                  'href' => "/blog/{$current_lang}/codeigniter-view-library/")
           )
        ));
      ?>
    </ul>
  </div>
</div>