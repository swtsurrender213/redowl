<?php get_header(); ?>

<!-- Row for main content area -->

	 <div class="col-md-8 ">
	 	<div class="nadzhq-content-inner">
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('default-post'); ?>  >
			<div class="inner-content">
	<header class="page-header">
		<h1 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		
	</header>
	<div class="page-content">
		<figure><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) {the_post_thumbnail('large img-thumbnail'); } ?></a></figure> <?php the_content(); ?>
	<span class="the-tags"><?php the_tags('<i class="fa fa-tags"></i>&nbsp;' . __('Tags: ','nadzhq-minimal'), ', ' );?></span>
	<?php comments_template(); ?>
	</div>
	</div>
</article>
		
		
	<?php endwhile; // End the loop ?>
</div>
	</div>
	
<?php get_sidebar(); ?>		
<?php get_footer(); ?>