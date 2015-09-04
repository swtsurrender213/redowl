<?php
/**
 * Template Name: Solutions
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
		<h2><strong>Solutions</strong></h2>
		<span class="sub_title" style="font-size: 20px;"><strong>Some of the factors that make Red Owl the most
successful loss prevention firm and what sets us apart:</strong></span>

&nbsp;
<ul>
	<li style="font-size: 20px;"><strong>Loss Training Standards and Procedures</strong>
<p style="font-size: 16px;">Help us indemnify our clients from potential liability. In an industry fraught with potential
liability due to mishandling of suspects, our clients have never incurred a loss due to our actions at
their premises -a testament to the professionalism of our personnel.</p>
</li>
	<li style="font-size: 20px;"><strong>Red Owl leverages technology</strong>
<p style="font-size: 16px;">We use technology to compile and analyze apprehensions, identifying trends and providing
our investigators with updated information on known shoplifters and organized crime rings operating in their area.
LPS has compiled a database, which is used to send our clients the StopCrime Bulletin, an electronic email alert with
recent profiles of known shoplifters operating in their area.</p>
&nbsp;</li>
	<li style="font-size: 20px;"><strong>Licensed Investigators and Guards</strong>
<p style="font-size: 16px;">All our investigators and security guards are licensed by the Ministry of Community Safety and
Correctional Services under the Private Investigators and Security Guards Act as required by law. We carefully comply with
all federal, provincial and local laws relating to privacy and security.</p>
</li>
	<li style="font-size: 20px;"><strong>An Unwavering Commitment to Clients</strong>
<p style="font-size: 16px;">Red Owl investigators and security personnel approach loss prevention and security with the view of
helping client organizations achieve its objectives. We have a strong employee support network that provides advice and insight
to ensure clients remain confident and achieve better results. Loss Prevention Services are committed to long-term relationships
with its customer first philosophy.</p>
</li>
</ul>
&nbsp;
<p style="font-size: 16px;">Our clients expect that their investments in loss prevention is money is well spent and that they're getting
a return on their investment. This is what Loss Prevention strives to achieve.Discover how successful an outsourced loss prevention relationship
with Red Owl can be, contact us to learn more.</p>
		

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		
	<?php endif; // end have_posts() check ?>

 

</div><!--/main-->
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>