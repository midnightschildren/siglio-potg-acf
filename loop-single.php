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
  <div <?php post_class($oddClass) ?>>
    
    <h1 id="post-<?php the_ID(); ?>">
      <?php the_title(); ?></h1>
      <p class="cath5 catsinglespacer"><?php the_category(', '); ?></p>
      <?php the_date('F jS, Y', '<h5 class="dateblog">', '</h5>'); ?>
    <div class="entry">
      <?php the_content(); ?>
      <?php the_social_widgets(); ?>
      <div class="clear"></div>
    </div>
      <?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' .
                '<label for="author">' . __( 'Name (required)' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="40"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email">' .
                '<label for="email">' . __( 'Email (will not be published)(required)' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="40"' . $aria_req . ' />' .
		'</p><!-- #form-section-email .form-section -->',
    'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /></p>') ),
    'comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">' . __( 'Comment' ) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
    'comment_notes_after' => '',
	'comment_notes_before' => '',
	'label_submit' => ('Submit Comment'),
);
comment_form($comment_args); ?>
  </div>
  <?php endwhile; ?>
  <?php get_template_part( '/inc/nav' );?>
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 