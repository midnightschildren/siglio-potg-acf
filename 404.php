<?php
/**
 * The template for 404.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0 this is a tst
 */

get_header(); ?>

	<div class="grid_12 alpha">
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<h1>Oops! Something’s supposed to be here that isn’t. Let us know: <a href="mailto:websitemgmt@sigliopress.com">websitemgmt@sigliopress.com</a>. Thanks!</h1>
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>