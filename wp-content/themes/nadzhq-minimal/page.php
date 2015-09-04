<?php

/**
 * The default page.php
 */

get_header();?>



    <div class="col-md-8 ">
     <div class="nadzhq-content-inner">           

  <div id="main">

	


			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="page-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="page-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="page-content">
						<?php the_content(); ?>
						
						<?php//dynamic_sidebar( 'sidebar-1' ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'nadzhq-minimal' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<?php do_action('comment_form', $post->ID); ?>
						
<?php

					
						 comments_template();
					
						 ?>
					</div><!-- .entry-content -->

				
				</article><!-- #post -->

			
			<?php endwhile; ?>

</div><!--/main-->
</div>
</div>
<?php get_sidebar();?>
<?php get_footer();?>