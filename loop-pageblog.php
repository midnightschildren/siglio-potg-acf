<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 2
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 2;
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
  <div class="grid_6 pull-left general-blog <?php echo $oddClass ?>">
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('blog-standard'); ?></a>
      
    <h2 class="rlink" id="post-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
    <p class="cath5"><?php the_category(', '); ?></p> 
	  <?php the_excerpt(); ?> 
      <p class="caption"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Continue Reading &raquo;</a></p>
  </div>
  <?php endwhile; ?>
<?php get_template_part( '/inc/nav' );?>  
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 