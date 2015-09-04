<?php 
/**
 * archive.php
 *
 * The template for displaying archive pages.
 */
?>

<?php get_header(); ?>

	<div class="col-md-8 ">
     <div class="nadzhq-content-inner">           

  <div id="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1>
					<?php 
						if ( is_day() ) {
							printf( __( 'Daily Archives for %s', 'nadzhq-minimal' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives for %s', 'nadzhq-minimal' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'nadzhq-minimal' ) ) );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives for %s', 'nadzhq-minimal' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'nadzhq-minimal' ) ) );
						} else {
							_e( 'Archives', 'nadzhq-minimal' );
						}
					?>
				</h1>
			</header>

			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php nadzhq_minimal_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>