<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

  <div id="content" class="error-404">
    <h2>
      <span id="oops">Oops...</span>
       The page you are looking for is missing.
    </h2>
    <h3>Please try the navigation bar above or search this blog instead :)</h3>
    <div id="search">
      <?php get_search_form(); ?>
    </div>
  </div>

<div class="spliter"></div>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>