<?php 
/**
 * Template Name: Book
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
    
      <?php the_content(); ?>
    
<div class="grid_12 alpha book-section book-page">
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
      <div class="book_row_bp">
	<?php // echo '<pre>';var_dump($wp_query); echo '</pre>';
      get_template_part( 'loop', 'bookwprice' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>
      </div>
</div>   
     
<div class="grid_12 alpha">
<?php $sort= $_GET['sort']; if($sort == "title") { $order= 'book_title'; } if($sort == "author") { $order= 'author_last'; } ?>

<p class="rlink2" style="margin-bottom: 6px;">ALL BOOKS, alphabetical by <a href="?sort=author" <?php if ($sort == "author"){ echo 'style="color:#cc0000"'; } ?>>AUTHOR</a> / <a href="?sort=title" <?php if ($sort == "title"){ echo 'style="color:#cc0000"'; } ?>>TITLE</a></p>


<?php // books by apha
      $temp_query = clone $wp_query;
      $args=array(
        'post_type' => 'book',
        'post_status' => 'publish',
        'showposts' => 200,
		    'posts_per_page' => 100,
		    'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => $order 
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);?>
      <div class="book_row2">
	<?php // echo '<pre>';var_dump($wp_query); echo '</pre>';
      get_template_part( 'loop', 'book' );
      
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
