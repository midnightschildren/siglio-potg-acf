<?php
/**
 * The template for book search
 */
?>
<h3>Find a book</h3>
<form action="<?php echo site_url(); ?>" id="searchform" method="get">
  <input type="hidden" name="post_type" value="book" />
  <div id="searching">
    <input type="text" id="s" name="s" value="" />
    <input type="submit" value="Search" id="searchsubmit" />
   </div>
</form>

<form action="<?php echo site_url(); ?>" id="booksearch" method="get">
  <div class="searching">
  	<input type="hidden" name="booksearch" value="1" />
    <input type="hidden" name="post_type" value="book" />
    
    <?php 
      // Authors 
      // -----------------------------------------------------------------------
      $authors = clean_cctm_fields(get_meta_values('author_last', 'book'));
      if( $authors ) :
    ?>
	<div class="styled-selectauthor">
	<input type="hidden" name="meta_key[]" value="author_last" />
	<select name="author_last" onchange="this.form.submit();">
	<option value=""></option>
	<?php foreach( $authors as $author ) : ?>
	<option value="<?php echo $author ?>">&nbsp;<?php echo $author ?></option>
	<?php endforeach; ?>
	</select>
	<?php endif; ?>
	</div>
	<div>&nbsp;</div>
    <?php  
      // Titles 
      // -----------------------------------------------------------------------
      $books = get_simple_posts('book');

      if( !empty($books) ) :
    ?>
    <div class="styled-selecttitle">
    <select name="p" onchange="this.form.submit();">
      <option value=""></option>
      <?php foreach( $books as $book ) : ?>
      <option value="<?php echo $book->ID; ?>">&nbsp;<?php echo $book->post_title; ?></option>
      <?php endforeach; ?>
    </select>   
    <?php endif; ?>
 
	</div>
  </div>
</form>
  