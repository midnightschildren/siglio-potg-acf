<?php
/**
 * The template for Header.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="google-site-verification" content="piKTf-gKLBDpvmsysedUCDWYNvoeXkHfcZvMe2Q9x3k" />
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head><body <?php body_class(); ?>>
<div id="options-wrapper"> 
<div id="padeq" class="container">
<div id="header" class="container">
<div id="search" class="grid_3">
    <?php get_search_form(); ?>
</div>

<ul id="social">
    <li id="panel1b"><a href="http://www.facebook.com/pages/Siglio-Press/248492603178"></a></li>
    <li id="panel2b"><a href="https://twitter.com/sigliopress"></a></li>
    <li id="panel3b"><a href="http://pinterest.com/sigliopress/"></a></li>
    <li id="panel4b"><a href="<?php echo home_url(); ?>/faq/"></a></li>
</ul>

<ul id="yourcart">
    <li id="panel1c"><a href="http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=74DDCB7F-434C-4C12-B350-ABE5A19D774A"></a></li>
</ul>

  <h1><a href="<?php echo home_url(); ?>/">
    <div class="siglio_header_logo"></div></a></h1>
  <div class="description">
    <?php bloginfo('description'); ?>
  </div>

<div id="navigation" class="pull-right siglio_nav">

  <?php wp_nav_menu(array('menu' => 'Top Nav' )); ?>
</div>  
</div>
