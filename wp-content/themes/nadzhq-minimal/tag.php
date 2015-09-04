<?php 
/**
 * tag.php
 *
 * The template for displaying tag pages.
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
						printf( __( 'Tag Archives for %s', 'nadzhq-minimal' ), single_tag_title( '', false ) );
					?>
				</h1>

				<?php 
					// Show an optional tag description.
					if ( tag_description() ) {
						echo '<p>' . tag_description() . '</p>';
					}
				?>
			</header>

			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php nadzhq_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>