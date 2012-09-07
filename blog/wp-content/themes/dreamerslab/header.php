<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?bloginfo( 'charset' )?>" />
<meta http-equiv="content-language" content="en-US" />
<meta name="google-site-verification" content="gJ03bx5CirK3eKJJR0Rsco_9lczerTcW9DRzL_lZ-bU" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="stylesheet" type="text/css" media="all" href="/blog/wp-content/themes/dreamerslab/style.css?20110906" />
<link rel="stylesheet" type="text/css" media="all" href="/css/lib/jquery.fancybox.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?wp_head()?>
<link href="http://dreamerslab.com/favicon.png" rel="shortcut icon" type="image/ico" />
</head>

<body <?php body_class(); ?>>
  <div id="bg-wrap">
    <div id="bg"></div>
  </div>

  <div id="wrap" class="<?=dreamerslab_lang_short()?>">
    <div id="header">
      <h1><span class="hidden"><?the_title()?></span></h1>
      <a id="home" href="<?=dreamerslab_uri('about')?>" title="<?= esc_attr( get_bloginfo( 'name', 'display' ))?>" rel="home">
      </a>
      <?dreamerslab_lang()?>
      <div id="nav">
        <ul class="clearfix">
          <li>
            <h3>
              <a id="nav-about" href="<?=dreamerslab_uri('about')?>">
                <span><?dreamerslab_nav('about')?></span>
              </a>
            </h3>
          </li>
          <li>
            <h3>
              <a id="nav-works" href="<?=dreamerslab_uri('works')?>">
                <span><?=dreamerslab_nav('works')?></span>
              </a>
            </h3>
          </li>
          <li>
            <h3>
              <a id="nav-contact" href="<?=dreamerslab_uri('contact')?>">
                <span><?=dreamerslab_nav('contact')?></span>
              </a>
            </h3>
          </li>
          <li>
            <h3>
              <a id="nav-blog" class="selected" href="<?=dreamerslab_blog()?>">
                <span><?=dreamerslab_nav('blog')?></span>
              </a>
            </h3>
          </li>
        </ul>
      </div>
    </div><!-- End of header -->

    <div id="main">

