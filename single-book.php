<?php
/**
 * Template for displaying single book posts.
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
        
		<h3 class="contributor_title"> <?php the_field('book_contributors'); ?></h3>
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
        
        <?php // Limited Edition
          $limited = get_field('limited_edition_link:to_link_href');
          if( !empty($limited) ) :
        ?>
        
		<p class="led left-sidebar"><a href="<?php the_field('limited_edition_link:to_link_href','http://yoursite.com/default/page/');?>">There's also a Limited Edition</a></p>
        
        <?php endif; ?>

        <?php // Blurb box
          $featuredblurb = get_field('bookfeaturedblurb');
          if( !empty($featuredblurb) ) :
        ?>        
        <div class="book_blurb_box">
		<p class="book_blurb left-sidebar"><?php echo apply_filters('the_content', get_field('bookfeaturedblurb')); ?></p>
        </div>
        <?php endif; ?>

        <?php // Book Links
          $blinks = get_field('booklinks');
          if( !empty($blinks) ) :
        ?>         
		<div class="book_links"><?php echo apply_filters('the_content', get_field('booklinks')); ?></div>
        <?php endif; ?>
</div>         

<div class="grid_8 single_book">         
		<?php the_content(); ?>
        
		<?php // pdf press release
          $pdfpressrelease = get_field('pdf_press_release');
          $image_id = get_field('pdf_press_release:raw');
          if( !empty($pdfpressrelease) ) :
		?>
		<div class="pdf-press-release">
		<a target="_blank" href="<?php echo wp_get_attachment_url($image_id); ?>" class="press-release-link">Read the complete PDF Press Release</a>.
		</div>
		<?php endif; ?>

		<?php echo apply_filters('the_content', get_field('bookcontent')); ?>

<div class="related-posts grid_8 alpha">
      
      <?php // related posts 
        // Query for matching tag | exclude this id
        
    	global $post;
    	$post_slug=$post->post_name;
		
        
          $temp_query = clone $wp_query;
          $args=array(
		    'tax_query' => array(
            'relation' => 'AND',
             array( 'taxonomy' => 'category', 'field' => 'id', 'terms' => 10),
             array( 'taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => $post_slug)
             ),
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'order' => 'DESC'
          );
          $wp_query = null;
          $wp_query = new WP_Query($args);
		  
      ?>
        
      <?php   
          get_template_part( 'loop', 'singlebookblog' );
          
          // now back to our regularly scheduled programming
          $wp_query = $temp_query;
        
      ?>
    </div>

<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>