<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

			<div id="content" class="search">

<?php if ( have_posts() ) : ?>
				<h2 class="page-title"><?php printf( __( 'Search: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
        <div class="spliter"></div>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
          <div class="spliter"></div>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
            <div id="search">
              <?php get_search_form(); ?>
            </div>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
        <div class="spliter"></div>
<?php endif; ?>
			</div><!-- #content -->

<?php get_footer(); ?>
