<?php
/**
 * Template Name: Retail LP
 */

get_header();?>


    <div class="col-md-8">
                
	<div class="nadzhq-content-inner">
  <div id="main">
		<?php if ( have_posts() ) : ?>
	
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			
		

		<p style="font-size:20px;">
		
		<?php get_template_part( 'content', get_post_format() ); ?>
		</p>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		
	<?php endif; // end have_posts() check ?>

 <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>

</div><!--/main-->
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>