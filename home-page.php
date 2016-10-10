<?php 
/**
 * Template Name: Home
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

 <div class="grid_12 news-section alpha">

<?php // Featured News
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'order' => 'DESC',
    'tag_id' => '12',
    'cat' => '5'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 1;
      get_template_part( 'loop', 'featured' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>



<?php // Recent News
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'order' => 'DESC',
    'cat' => '5',
    'tag__not_in' => '12'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 3;
      get_template_part( 'loop', 'recentnews' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>

<div class="clear"></div>
</div>     
<div class="grid_12 alpha book-section">
<?php // Recommendations and best sellers
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'book',
        'post_status' => 'publish',
        'showposts' => 4,
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'book_featured',
            'value' => '1',
          )
        )
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);?>
      <div class="book_row">
	<?php // echo '<pre>';var_dump($wp_query); echo '</pre>';
      get_template_part( 'loop', 'book' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>
      </div>
    </div>     
    
<div class="grid_12 alpha blog-section">
	<h3 style="text-transform:uppercase" >Affinities (The Siglio Blog): Featured Posts</h3>

<?php // Blog Featured
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'order' => 'DESC',
		'tag_id' => '12',
		'cat' => '10'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 2;
      get_template_part( 'loop', 'blogfeatured' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>

</div>   
     


    
    
   </div>
    
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
