<?php 
/**
 * Template Name: Limited
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>
<?php
  global $LOOP_ROW_COUNT;
  $LOOP_ROW_COUNT = 1;
?>
<div class="grid_12 alpha">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <div class="entry">
    
<div style="margin-bottom: 40px;" class="grid_12 alpha book-page">
  <?php the_content(); ?>
	
    

<?php // Limited Editions
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'limited_edition',
        'post_status' => 'publish',
        'showposts' => -1,
        'order' => 'DESC'
        
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);?>
      <div class="limited_row">
	<?php // echo '<pre>';var_dump($wp_query); echo '</pre>';
      get_template_part( 'loop', 'limited' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>
 	    </div>
</div>   
     


    
    
    </div>
    
  </div>
</div>

<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
