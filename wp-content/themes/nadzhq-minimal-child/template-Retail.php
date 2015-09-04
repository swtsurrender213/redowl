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
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<h2><strong>Retail Loss Prevention</strong></h2>
		<p style="font-size:20px;">Retail loss prevention is a set of practices employed by retail companies to preserve profit.
		Profit preservation is any business activity specifically designed to reduce preventable losses. 
		A preventable loss is any business cost caused by deliberate or inadvertent human actions, colloquially known as "shrinkage".
		Deliberate human actions that cause loss to a retail company can be theft, fraud, vandalism, waste, abuse, or misconduct. 
		Inadvertent human actions attributable to loss are purely poorly executed business processes, where employees fail to follow 
		existing policies or procedures - or cases in which business polices and procedures are lacking. Loss prevention is mainly found 
		within the retail sector but also can be found within other business environments.

		Since retail loss prevention is geared towards the elimination of preventable loss and the bulk of preventable loss in retail is caused 
		by deliberate human activity, traditional approaches to retail loss prevention have been through visible security measures matched with
		technology such as CCTV and electronic sensor barriers. Most companies take this traditional approach by either having their own in house 
		loss prevention team or they use external security agencies. Charles A. Sennewald and John H. Christman state "Four elements are necessary 
		for a successful loss prevention plan: 1) Total support from top management, 2) A positive employee attitude, 3) Maximum use of all available
		resources, 4) A system which establishes both responsibility and accountability for loss prevention through evaluations that are consistent 
		and progressive.".</p>
		

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		
	<?php endif; // end have_posts() check ?>

 

</div><!--/main-->
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>