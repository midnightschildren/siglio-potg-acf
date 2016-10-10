<?php 
/**
 * The template for displaying Single Page.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid_12 alpha">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <h1 class="pagetitle">
      <?php the_title(); ?>
    </h1>
    <div class="entry">
      <?php the_content(); ?>
      <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    </div>
    
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
