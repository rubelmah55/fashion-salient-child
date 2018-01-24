<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    //wp_enqueue_style( 'colorbox', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array('font-awesome'));
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    if ( is_rtl() ) {
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
    }

   	wp_enqueue_script( 'masonry_js', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js', array(), '1.0.0', true );
	//wp_enqueue_script( 'magnific-popup', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'settings', get_stylesheet_directory_uri() . '/js/settings.js', array('jquery'), '1.0.0', true );
}

add_action( 'init', 'homefashion_post_types' );
function homefashion_post_types() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'homefashion' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'homefashion' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'homefashion' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'homefashion' ),
		'add_new'            => _x( 'Add New Testimonial', 'Testimonial', 'homefashion' ),
		'add_new_item'       => __( 'Add New Testimonial', 'homefashion' ),
		'new_item'           => __( 'New Testimonial', 'homefashion' ),
		'edit_item'          => __( 'Edit Testimonial', 'homefashion' ),
		'view_item'          => __( 'View Testimonial', 'homefashion' ),
		'all_items'          => __( 'All Testimonials', 'homefashion' ),
		'search_items'       => __( 'Search Testimonials', 'homefashion' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'homefashion' ),
		'not_found'          => __( 'No Testimonials found.', 'homefashion' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'homefashion' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'homefashion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_icon'			 => 'dashicons-editor-kitchensink',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','thumbnail','editor')
	);
	register_post_type( 'testimonial', $args );
}





//register meta box

//register meta box using admin_init action
add_action('admin_init', 'hf_metabox_admin_init');
function hf_metabox_admin_init(){
 add_meta_box( 'testi_metaboxes', 'Testimonial Meta Boxes', 'testi_metaboxes_display', 'testimonial', 'normal', 'high' );
}

function testi_metaboxes_display( $testimonial ) {
	// Retrieve current author and rating based on review ID
	$position = esc_html( get_post_meta( $testimonial->ID, 'testimonial_posittion', true ) );
	?>
	<table>
		<tr>
			<td style="width: 100%">Position</td>
			<td><input type="text" size="80" name="testimonial_posittion" value="<?php echo $position; ?>" /></td>
		</tr>
	</table>


<?php }


add_action( 'save_post', 'hf_testimonial_save_post', 10, 2 );
function hf_testimonial_save_post( $testimonial_id, $testimonial ) {
	// Check post type for book reviews
	if ( $testimonial->post_type == 'testimonial' ) {
		// Store data in post meta table if present in post data
		if ( isset( $_POST['testimonial_posittion'] ) && $_POST['testimonial_posittion'] != '' ) {
		update_post_meta( $testimonial_id, 'testimonial_posittion', $_POST['testimonial_posittion'] );
		}
	}
}



//Add Visual Composer Elements Files
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
     
    require_once( get_stylesheet_directory().'/vc-elements/vc-child-testimonial.php' );  
     
}

/* customize login screen */
function charity_images_custom_login_page() {
    echo '<style type="text/css">
        .login h1 a { background-image:url("'. get_stylesheet_directory_uri().'/images/logo.png") !important; height: 100px !important; width: 100% !important; margin: 0 auto !important; background-size: contain !important; }
		h1 a:focus { outline: 0 !important; box-shadow: none; }
        body.login { background-image:url("'. get_stylesheet_directory_uri().'/images/banner.jpg") !important; background-repeat: no-repeat !important; background-attachment: fixed !important; background-position: center !important; background-size: cover !important; position: relative; z-index: 999;}
  		body.login:before {background-color: #42b1e67a; position: absolute; width: 100%; height: 100%; left: 0; top: 0; content: ""; z-index: -1; }
  		.login form {
  			background: rgba(255,255,255, 0.2) !important;
  		}
		.login form .input, .login form input[type=checkbox], .login input[type=text] {
			background: transparent !important;
			color: #ddd;
		}
		.login label {
			color: #DDD !important;
		}
		.login #login_error, .login .message {
			color: #ddd;
			margin-top: 20px;
			background: rgba(255,255,255, 0.2) !important;
		}
		#login {
		    padding: 7% 0 0;
		}
		
		.login #nav a, .login #backtoblog a, .login label, .login .message{
			color:#000 !important;
		}
    </style>';
}
add_action('login_head', 'charity_images_custom_login_page', 99);
function cabinet_login_logo_url_title() {
 	return 'Business Simple';
}
add_filter( 'login_headertitle', 'cabinet_login_logo_url_title' );
function cabinet_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'cabinet_login_logo_url' );


