<?php 
/**
 * author.php
 *
 * The template for displaying author archive pages.
 */
?>

<?php get_header(); ?>

	 <div class="col-md-8">
                
	<div class="nadzhq-content-inner">
  <div id="main">
		<?php if ( have_posts() ) : the_post(); ?>
			<header class="page-header">
				<h1>
					<?php printf( __( 'All posts by %s.', 'nadzhq-minimal' ), get_the_author() ); ?>
				</h1>

				<?php 
					// If the author bio exists, display it.
					if ( get_the_author_meta( 'description' ) ) {
						echo '<p>' . the_author_meta( 'description' ) . '</p>';
					}
				?>

				<?php rewind_posts(); ?>
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