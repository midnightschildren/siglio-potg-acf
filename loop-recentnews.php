<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 3
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 3;
    $count = 0;
  ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php 
    $count++;
    $oddClass = '';
    if( $rowCount == 2
        || $count == 2
        || $count % $rowCount == 2 ) { 
      $oddClass = ' alpha'; 
    } 
  ?>
  <div class="grid_6 pull-left news-home <?php echo $oddClass ?>">
    <h3 class="rlink" id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h3>    
      
     <p class="caption"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Continue Reading &raquo;</a></p>
  </div>
  <?php endwhile; ?>
  
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 