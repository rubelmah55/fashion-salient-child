<?php
/*
Template Name: Testimonial
*/
?>
<?php get_header(); ?>
	<div class="testimonial"  style="background-color: #fff; padding: 50px 0;">
		<div class="container">
			<div class="row grid">


	<?php 
		$args = array( 
			'post_type' => 'testimonial', 
			'posts_per_page' => -1 
		);
		$loop = new WP_Query( $args );
		
		while($loop->have_posts()) : $loop->the_post();
?>

				<div class="col span_4 thumbnail">
					<div class="testimonial-item">
						<div class="testimonial-author">
							<div class="testimonial-avatar">
								<span class="testimonial-thumb" style="padding-bottom: 100%; height: 0px; display: block;"><?php the_post_thumbnail(); ?></span>
							</div>
							<div class="testimonial-vcard">
								<div class="testimonial-name">
									<span class="text-primary"><?php the_title(); ?></span><br>
								</div>
								<div class="testimonial-position">
									<span class="text-secondary color-secondary"><?php echo get_post_meta( get_the_ID(), 'testimonial_posittion', true ); ?></span>
								</div>
							</div>
						</div>
						<div class="testimonial-content">
							<p><?php the_content(); ?></p>
						</div>
					</div>
				</div>	
			<?php endwhile; ?>




			</div><!--/row-->
		</div>
	</div>
<?php get_footer(); ?>