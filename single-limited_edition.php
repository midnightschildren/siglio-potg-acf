<?php
/**
 * Template for displaying Limited Editions.
 * 
 */

get_header(); ?>


<div class="grid_16 alpha single_book title_section">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
    // Storing this before we start mucking up the loop
    $postID = $post->ID; ?>
	
		
		<h1 class="book_title"> <?php the_field('book_title'); ?></h1>
        
        <?php // sub title
          $subTitle = get_field('sub_title');
          if( !empty($subTitle) ) :
        ?>
		<h1 class="sub_title"> <?php the_field('sub_title'); ?></h1>
        <?php endif; ?>
        
        <?php // book author
          $authorTitle = get_field('book_author');
          if( !empty($authorTitle) ) :
        ?>
		<h2 class="author_title"><?php the_field('book_author'); ?></h2>
        <?php endif; ?>

        <?php // book contributor
          $contributors = get_field('book_contributors');
          if( !empty($contributors) ) :
        ?>        
		<h3 class="contributor_title"> <?php the_field('book_contributors'); ?></h3>
        <?php endif; ?>
</div>

<div class="grid_4 alpha single_book">
    <?php // add to cart
          $carturl = get_field('cart_url');
          if( !empty($carturl) ) :
        ?>
		<a href="<?php the_field('cart_url'); ?>"><div class="add_to_cart"></div></a>
    <?php endif; ?>
    <?php // price
          $bprice = get_field('book_price');
          if( !empty($bprice) ) :
        ?>        
		<h3 class="price left-sidebar"><?php the_field('book_price'); ?></h3>
    <?php endif; ?>    
		<div class="footnote left-sidebar"><?php echo apply_filters('the_content', get_field('bookdetails')); ?></div>
        
        <?php // pdf press release
          $file = get_field('pdf_press_release');
          if( $file ) {
          $url = wp_get_attachment_url( $file );  
    ?>
    <p class="led left-sidebar"><a target="_blank" href="<?php echo $url; ?>" class="prospectus-link">Download Limited Edition PDF Prospectus</a>.</p>
    <?php } ?>
        
       
        
        <div class="book_blurb_box">
		<div class="book_blurb left-sidebar"><?php echo apply_filters('the_content', gcb(1)); ?></div>
        </div>
</div>
<div class="grid_8 single_book">         
		<?php the_content(); ?>
        <?php echo apply_filters('the_content', get_field('bookcontent')); ?><br />


<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>