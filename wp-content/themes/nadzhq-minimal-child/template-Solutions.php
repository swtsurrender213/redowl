<?php
/**
 * Template Name: Solutions
 */

get_header();?>


    <div class="col-md-8">
                
	<div class="nadzhq-content-inner">
  <div id="main">
		<?php if ( have_posts() ) : ?>
	
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		
	<?php endif; // end have_posts() check ?>

 

</div><!--/main-->
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>