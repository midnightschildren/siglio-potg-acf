<?php
/**
 * The template for Archive.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

get_header(); ?>

<div class="grid_12 alpha">
  <?php 
    // Ask for the category loop if we're in a single category view
    // this is so that we don't duplicate templates so that we can call
    // different loops
    $template = 'archives';
    $queryCats = get_query_var('cat');
    $queryCats = explode(',', $queryCats);
    $singleCategory = false;
    if ( count($queryCats) == 1 ) {
      $singleCategory = get_category(intval($queryCats[0]));
      $template = $singleCategory->slug;
    } 
  ?>
  <?php if($template != 'archives') : ?>
    <h1 style="text-transform:uppercase; margin-bottom: 8px;" >
      <?php echo $singleCategory->name;?> 
    </h1>
    <h3 class="page-subtitle">
      <?php if(isset($singleCategory->description)): ?>
      <span><?php echo $singleCategory->description?></span>
      <?php endif; ?>
    </h3>  
  <?php endif; ?>
  
  <?php // Category
      $temp_query = clone $wp_query;
   //   $cat_obj = $wp_query->get_queried_object();
	//  $querycatID = $cat_obj->term_id;          
      $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        
		'paged' => get_query_var('paged'),
        'order' => 'DESC',
		'cat' => get_query_var('cat')
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 2;
      get_template_part( 'loop', 'categoryblog' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>
  
</div>
<?php get_sidebar('posts'); ?>
<?php get_footer(); ?>
