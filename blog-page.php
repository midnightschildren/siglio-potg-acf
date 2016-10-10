<?php 
/**
 * Template Name: Blog
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>
<?php
  global $LOOP_ROW_COUNT;
  $LOOP_ROW_COUNT = 4;
?>
<div class="grid_12 alpha">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <div class="entry">
      <?php the_content(); ?>
    
<div class="grid_12 alpha blog-section">
	<h1 style="text-transform:uppercase; margin-bottom: 16px;" >Affinities (The Siglio Blog)</h1>

<?php // Blog Featured
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 2,
		'paged' => get_query_var('paged'),
        'order' => 'DESC',
		'tag_id' => '12',
		'cat' => '10'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 2;
      get_template_part( 'loop', 'pageblogfeatured' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>

</div>   
     
<div class="grid_12 alpha">

<?php // Blog
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 4,
		'paged' => get_query_var('paged'),
        'order' => 'DESC',
		'tag__not_in' => '12',
		'cat' => '10'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 2;
      get_template_part( 'loop', 'categoryblog' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>

<div class="clear"></div>
</div>

    
    
   </div>
    
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar('posts'); ?>
<?php get_footer(); ?>
