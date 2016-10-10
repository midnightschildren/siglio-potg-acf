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
  <div class="grid_12 pull-left limited_edition <?php echo $oddClass ?>">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('limited'); ?></a>
   <div class="grid_6 pull-right limited-text">   
    <h2 class="rlink" id="post-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2> 
	  <?php the_excerpt(); ?> 
      <p class="caption"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">More Information &raquo;</a></p>
   </div>
  </div>
  <?php endwhile; ?>
  
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 