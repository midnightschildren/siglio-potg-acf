<?php
/**
 * The template for displaying Index.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

get_header(); ?>

<div class="alpha grid_12">

  <?php 
    // attempt to guess the loop type we want to use
    // post_type > category > default
    $template = '';
    if( $_GET['post_type']) {
      $template = $_GET['post_type'];
    } else if ( $_GET['category_name'] ) {
      $template = $_GET['category_name'];
    } 
    echo get_template_part('loop', $template); 
  ?>
</div>
<?php get_sidebar($template); ?>
<?php get_footer(); ?>
