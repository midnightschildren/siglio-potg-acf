<?php
/**
 * The template for Pagination.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
 ?>
 <div class="navigation alpha grid_12">
    <div class="nav-previous pull-left"><?php next_posts_link( __( '<span class="meta-nav">&#8592;</span> Older posts', 'twentyeleven' ) ); ?></div>
    <div class="nav-next pull-right"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&#8594;</span>', 'twentyeleven' ) ); ?></div>
    <?php //if(function_exists('pagenavi')) { pagenavi(); } ?>
 </div> 