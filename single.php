<?php 
/**
 * The template for displaying Single Posts.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
get_header(); ?>
<div class="grid_12 alpha">
  <?php get_template_part('loop', 'single'); ?>
</div>
<?php get_sidebar('posts'); ?>
<?php get_footer(); ?>
