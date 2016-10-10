<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 2
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 4;
    $count = 0; ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php 
    $count++;
    $oddClass = '';
    if( $rowCount == 1
        || $count == 1
        || $count % 4 == 1 ) {
      $oddClass = ' alpha'; 
    } 
  ?>
  <div <?php post_class('grid_3'.$oddClass) ?>>
    
      <?php
        $authorData = get_field('book_author:to_array', 'get_post'); 
        $author = isset($authorData[0]) ? ' by ' . $authorData[0] : false;
        $authorName = isset($author) ? $author['name'] : '';
		    $authorName2 = get_field('book_author');
        $title = get_field('book_title');
        $imgTitle = $title . $authorName;
      ?>

      <div class="post-thumb-cover"><?php the_post_thumbnail('book-thumb'); ?></div>
      <a class="post-thumb" href="<?php the_permalink() ?>" title="<?php echo $imgTitle ?> <?php echo $authorName2 ?>">
      <h2><?php echo $title ?></h2><h3><?php echo $authorName2 ?></h3></a>
      
    
    
  </div>
  <?php endwhile; ?>
  <?php get_template_part( '/inc/nav' );?>
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 