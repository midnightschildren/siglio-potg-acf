<?php 
/**
 * The template for displaying Search.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid_12 alpha">
  <h1 style="padding-top: 0px; text-transform:uppercase; margin-left: -2px;" >Search results for "<?php the_search_query(); ?>"</h1>
  <?php 
    // attempt to guess the loop type we want to use
    // post_type > category > default
    $template = "search";
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
