<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->
  <div id="footer" >
<?get_sidebar( 'footer' )?>
    Copyright&nbsp;&copy;&nbsp;2011
    <span id="logo-s"></span>
    <a href="<?=dreamerslab_uri('about')?>" title="<?=esc_attr( get_bloginfo( 'name', 'display' ))?>" rel="home">
      <?bloginfo( 'name' )?>
    </a>&nbsp;|&nbsp;All rights reserved.
  </div><!-- #footer -->

</div><!-- #wrap -->

<?wp_footer()?>
<script type="text/javascript" src="/js/lib/jquery.fancybox.js"></script>
<script type="text/javascript" src="/js/common/show_demo.js?20110902"></script>
<script type="text/javascript" src="/js/blog.js?20110902"></script>
<!--[if lt IE 7]>
<script type="text/javascript" src="/js/ie6.js"></script>
<![endif]-->
</body>
</html>
