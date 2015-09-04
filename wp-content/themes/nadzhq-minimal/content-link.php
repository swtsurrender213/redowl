<?php 
/**
 * content-link.php
 *
 * The default template for displaying posts with the Link post format.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inner-content">
	<!-- Article content -->
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading &rarr;', 'nadzhq-minimal' ) );

			wp_link_pages();
		?>
	</div> <!-- end entry-content -->

	<!-- Article footer -->
	<footer class="entry-footer">
		
			<?php 
				// Display the meta information
				nadzhq_minimal_post_meta();
			?>
	

		<?php 
			// If we have a single page and the author bio exists, display it
			if ( is_single() && get_the_author_meta( 'description' ) ) {
				echo '<h2>' . __( 'Written by ', 'nadzhq-minimal' ) . get_the_author() . '</h2>';
				echo '<p>' . the_author_meta( 'description' ) . '</p>';
			}
		?>
	</footer> <!-- end entry-footer -->
</div>	
</article>