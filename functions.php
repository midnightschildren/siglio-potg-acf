<?php
/**
 * The template for Function. Make changes at your own risk.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

// Includes
// -----------------------------------------------------------------------------
require_once locate_template('config.php');
require_once locate_template('/inc/nav-walker.php');

// Theme Options
if ( !function_exists( 'optionsframework_init' ) ) {

// define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
// define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');

// require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

// Register Styles
// -----------------------------------------------------------------------------

add_action('get_header', 'registerstyles');
function registerstyles() {
	$theme  = get_theme( get_current_theme());
	$version = $theme['Version'];
    if(ENV_DEVELOPMENT) {
      $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/css/less.php?file=custom', 'skeleton', $version, 'screen, projection');
    } else {
      $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/style.css', 'skeleton', $version, 'screen, projection');
    }
		echo apply_filters ('child_add_stylesheets',$stylesheets);
}

// Register Scripts
// -----------------------------------------------------------------------------
// Load jQuery 
    if ( !is_admin() ) {
       wp_deregister_script('jquery');
       wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
       wp_enqueue_script('jquery');
    }


// Set Content Width
	$content_width = 728;
	
// Add RSS links to <head> section
    add_theme_support( 'automatic-feed-links' );
	
// Add Custom BG Support
    add_custom_background();
	
// Enable post thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(200, 200, true);

// ADD POST FORMATS
//	add_theme_support( 'post-formats', array( 'book') );
//
// Editor Support
	add_editor_style();
	
// Add Thumnail Support
	add_theme_support( 'post-thumbnails' );
	

// Custom Image Sizes
// -----------------------------------------------------------------------------
    // Books
    add_image_size( "book-large", 372, 558, true );
add_image_size( "book-thumb", 160, 220, true );
    add_image_size( "book-small", 100, 150, true );
	add_image_size( "limited", 700, 225, true );
    // Blog / Posts
    add_image_size( "blog-standard", 340, 225, true );
    add_image_size( "blog-small", 220, 146, true );

	
// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
	
// Add Bread Crumbs
function the_breadcrumb() {
	echo bloginfo('name');
	if (!is_front_page()) {
		echo ' <a href="';
		echo home_url();
		echo '">Home';
		echo "</a> / ";
		if (is_category() || is_single()) {
			the_category(' ');
			if (is_single()) {
				echo " / ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
	else {
		echo 'Home';
	}
}

// WIdgets
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div class="sidebaritem %2$s %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Posts',
		'before_widget' => '<div class="sidebaritem %2$s %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer1',
		'before_widget' => '<div id="navigation" class="grid_14 siglio_footer_nav">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer2',
		'before_widget' => '<div class="grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer3',
		'before_widget' => '<div class="grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

//Relevanssi Modification

add_filter('relevanssi_excerpt_content', 'my_relevanssi_excerpt_content', 10, 3);
function my_relevanssi_excerpt_content($content, $post = '', $query = ''){
  //Uncomment the following line if the custom fields belong to a single post-type. Increases performance!
  //if ( $post->post_type != 'my_post-type' ) return $content;
  
  //Fill in your custom field names here:
  $fields = array('book_title', 'sub_title', 'book_author', 'book_contributors', 'bookdetails', 'bookfeaturedblurb', 'booklinks', 'bookcontent'); 
  foreach($fields as $field){
    //pay attention to $single (http://codex.wordpress.org/Function_Reference/get_post_meta)
    $field_value = get_post_meta($post->ID, $field, TRUE);
    $content .= ' '. ( is_array($field_value) ? implode(' ', $field_value) : $field_value );
  } 
  return $content;
}

// Add Custom HTML to Images
function filter_images($content){
    return preg_replace('/<img (.*) \/>\s*/iU', '<div class="swpf-img"><img \1 /></div>', $content);
}
//add_filter('the_content', 'filter_images');


// Template for comments and pingbacks.

	if ( ! function_exists( 'swpf_comment' ) ) :

function simonwordpressframework_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard"> <?php echo get_avatar( $comment, 40 ); ?> <?php printf( __( '%s <span class="says">says:</span>', 'simonwordpressframework' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
    <!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation">
    <?php _e( 'Your comment is awaiting moderation.', 'simonwordpressframework' ); ?>
    </em> <br />
    <?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'simonwordpressframework' ), get_comment_date(),  get_comment_time() ); ?>
      </a>
      <?php edit_comment_link( __( '(Edit)', 'simonwordpressframework' ), ' ' );
			?>
    </div>
    <!-- .comment-meta .commentmetadata -->
    
    <div class="comment-body">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </div>
  <!-- #comment-##  -->
  
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'simonwordpressframework' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'simonwordpressframework' ), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;

/**
* Custom search modifications
* execute php in widget
*/
	

add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}




/**
* Custom search modifications
* @param Object $query wp_query object
*/
function booksearch_query( $query ) {
    if( isset($_GET['booksearch']) 
	&& $query->is_main_query()
	) {
        $metaKeys = $_GET['meta_key'];
        if( !empty($metaKeys) ) {
            $metaQuery = array();
            foreach( $metaKeys as $metaKey ) {
                $metaValue = $_GET[$metaKey];
                if( !empty($metaValue) ) {
                    $metaQuery[] = array(
                        'key' => $metaKey,
                        'value' => strval($metaValue),
                        'compare' => 'LIKE'
                    );
                }
            }
			
            $query->set('meta_query', $metaQuery);
			
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'booksearch_query' );




// More efficient way of querying for ALL values of meta_keys (across all posts)
// lifted from: http://wordpress.stackexchange.com/questions/9394/getting-all-values-for-a-custom-field-key-cross-post
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_col( $wpdb->prepare( "
SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
WHERE pm.meta_key = '%s'
AND p.post_status = '%s'
AND p.post_type = '%s'
ORDER BY pm.meta_value ASC
", $key, $status, $type ) );
    return $r;
}

// Doing it dirty, but slightly less dirty than calling get_posts for ALL books
function get_simple_posts( $type = 'post', $status = 'publish' ) {
    global $wpdb;
    $r = $wpdb->get_results( $wpdb->prepare( "
SELECT DISTINCT p.ID, p.post_title
FROM {$wpdb->posts} p
WHERE p.post_type = '%s'
AND p.post_status = '%s'
ORDER BY TRIM(LEADING 'A ' FROM TRIM(LEADING 'An ' FROM TRIM(LEADING 'The ' FROM p.post_title)))
", $type, $status ) );
    return $r;
}


// because CCTM returns values as '["0"]' :(
function clean_cctm_fields($fields) {
    return $fields;
    // $cleanedFields = array();
    // var_dump($fields); die();
    // foreach( $fields as $field ) {
    //     $cleanedFields = array_merge($cleanedFields, extract_cctm_values($field));
    // }
    // $cleanedFields = array_unique($cleanedFields);
    // return $cleanedFields;
}
function extract_cctm_values($field) {
    return json_decode($field);
    // $trimmedField = $field;
    // $trimmedField = str_replace('[','',$trimmedField);
    // $trimmedField = str_replace(']','',$trimmedField);
    // $trimmedField = str_replace('"','',$trimmedField);
    // return explode(',', $trimmedField);
}

// excerpt length

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }



// Pagination
 
/* Function that Rounds To The Nearest Value.
   Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}
 
function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('First');
    $pagenavi_options['last_text'] = ('Last');
    $pagenavi_options['next_text'] = '&raquo;';
    $pagenavi_options['prev_text'] = '&laquo;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
 
    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        //empty - Determine whether a variable is empty
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
 
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil - Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
 
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
 
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
 
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            previous_posts_link($pagenavi_options['prev_text']);
 
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
 
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);
 
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}


?>
