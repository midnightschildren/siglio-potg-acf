
<?php if (function_exists('relevanssi_didyoumean')) { relevanssi_didyoumean(get_search_query(), "<p>Did you mean: ", "</p>", 5);
}?>
<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 2
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 1;
    $count = 0;
  ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php 
    $count++;
    $oddClass = '';
    if( $rowCount == 1
        || $count == 1
        || $count % $rowCount == 1 ) { 
      $oddClass = ' alpha'; 
    } 
  ?>
  <div class="grid_12 pull-left general-events <?php echo $oddClass ?>">
  
      
    <h2 id="post-<?php the_ID(); ?>" class="rlink">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
    
	  <?php relevanssi_the_excerpt(); ?> 
      <p class="caption" style="font-weight:bold"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Continue Reading &raquo;</a></p>
  </div>
  <?php endwhile; ?>
<?php get_template_part( '/inc/nav' );?>  
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 