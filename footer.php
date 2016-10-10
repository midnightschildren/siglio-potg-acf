<?php
/**
 * The template for Footer.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>

<div style="clear: both"></div>
<div id="footer">

<a href="<?php echo home_url(); ?>"><div class="siglio_footer_logo"></div></a>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer1") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer2") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer3") ) : ?>
    <?php endif; ?>
<div style="clear: both"></div>
  	&copy; <?php bloginfo('name'); echo " "; echo date("Y"); ?> Designed by <a href="http://putontheglasses.com" target="_new">POTG Design</a>.</div>
</div>
<?php wp_footer(); ?>
</div>
</body>
</html>