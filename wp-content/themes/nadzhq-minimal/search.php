<?php 
/**
 * search.php
 *
 * The template for displaying search results.
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
						printf( __( 'Search Results for %s', 'nadzhq-minimal' ), get_search_query() );
					?>
				</h1>
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