<?php
/*
Element Description: Home Slider
*/

// Element Class 
class vcTestimonial extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_testimonial_mapping' ) );
        add_shortcode( 'vc_testimonial', array( $this, 'vc_testimonial_html' ) );
    }
     
    // Element Mapping
	public function vc_testimonial_mapping() {
	         
	    // Stop all if VC is not enabled
	    if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	    }
	         
	    // Map the block with vc_map()
	    vc_map( 
	  
	        array(
	            'name' => __('Testimonials', 'salient-child'),
	            'base' => 'vc_testimonial',
	            'description' => __('My theme custom testimonial', 'salient-child'), 
	            'category' => __('Salient Element', 'salient-child'),   
	            'icon' => 'icon-wpb-recent-posts',            
	            'params' => array( 
                
	                     
	            )
	        )
	    );                                
	        
	}
     
     
	// Element HTML
	public function vc_testimonial_html( $atts ) {
	     
	    // Params extraction
	    extract(
	        shortcode_atts(
	            array(

	            ), 
	            $atts
	        )
	    );
	     
	    //Get all post from this category
		$args = array(
			'post_type' => 'testimonial', 
			'posts_per_page' => -1,
		);
		$loop = new WP_Query( $args );

		$output = '<div class="testimonial"  style="background-color: #fff; padding: 50px 0;"><div class="container"><div class="row grid">';
			
		while($loop->have_posts()) : $loop->the_post();
		$output .= '
			<div class="col span_4 thumbnail">
				<div class="testimonial-item">
					<div class="testimonial-author">
						<div class="testimonial-avatar">
							<span class="testimonial-thumb" style="padding-bottom: 100%; height: 0px; display: block;">'. get_the_post_thumbnail() .'</span>
						</div>
						<div class="testimonial-vcard">
							<div class="testimonial-name">
								<span class="text-primary">'. get_the_title() .'</span><br>
							</div>
							<div class="testimonial-position">
								<span class="text-secondary color-secondary">'. get_post_meta( get_the_ID(), 'testimonial_posittion', true ) .'</span>
							</div>
						</div>
					</div>
					<div class="testimonial-content">
						<p>'. get_the_content() .'</p>
					</div>
				</div>
			</div>	
		';

		endwhile;
		$output .= '</div></div></div>';

	    return $output;
	}
     
} // End Element Class
 
// Element Class Init
new vcTestimonial();