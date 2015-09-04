<?php 
/**
 * category.php
 *
 * The template for displaying category pages.
 */
?>

<?php get_header(); ?>

	 <div class="col-md-8">
                
	<div class="nadzhq-content-inner">
  <div id="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1>
					<?php 
						printf( __( 'Category Archives for %s', 'nadzhq-minimal' ), single_cat_title( '', false ) );
					?>
				</h1>

				<?php 
					// Show an optional category description.
					if ( category_description() ) {
						echo '<p>' . category_description() . '</p>';
					}
				?>
			</header>

			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>