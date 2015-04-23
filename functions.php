<?php

if ( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG )) {

	add_action( 'wp_enqueue_scripts', 'spine_dev_wp_enqueue_scripts' );
		
	function spine_dev_wp_enqueue_scripts() {
	    wp_dequeue_style( 'wsu-spine' );
		wp_enqueue_style( 'wsu-spine', '//spine.dev/build/spine.min.css', array(), spine_get_script_version() );
		wp_dequeue_script( 'wsu-spine' );
		wp_enqueue_script( 'wsu-spine', '//spine.dev/build/spine.min.js', array( 'wsu-jquery-ui-full' ), spine_get_script_version() );
	}

}

add_action( 'wp_enqueue_scripts', 'news_scripts_styles' );
/**
 * Enqueue child theme Javascript files.
 */
function news_scripts_styles() {
	wp_enqueue_script( 'news-scripts', get_stylesheet_directory_uri() . '/scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-mobile', get_stylesheet_directory_uri() . '/scripts/touch/jquery.touchSwipe.min.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'weather-styles', get_stylesheet_directory_uri() . '/scripts/weather/css/weather-icons.css' );
	wp_enqueue_script( 'weather-simple', get_stylesheet_directory_uri() . '/scripts/weather/jquery.simpleWeather.min.js' );
	wp_enqueue_script( 'weather-scripts', get_stylesheet_directory_uri() . '/scripts/weather/weather.js', array( 'jquery' ), false, true );
	//wp_enqueue_style( 'colorbox-styles', get_stylesheet_directory_uri() . '/scripts/colorbox/colorbox.css' );
	//wp_enqueue_script( 'colorbox-scripts', get_stylesheet_directory_uri() . '/scripts/colorbox/jquery.colorbox.js' );
}

add_action( 'admin_enqueue_scripts', 'news_admin_enqueue_scripts' );
/**
 * Enqueue styles required for admin pageviews.
 */
function news_admin_enqueue_scripts() {
	wp_enqueue_style( 'admin-interface-styles', get_stylesheet_directory_uri() . '/includes/theme-admin.css' );
	wp_enqueue_script( 'admin-interface-scripts', get_stylesheet_directory_uri() . '/includes/theme-admin.js' );
	add_editor_style( 'includes/theme-editor.css' );
}

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio' ) );

/**
 * Exclude Photo Features
 */
add_filter('pre_get_posts', 'exclude_photo_features');
function exclude_photo_features($query) {
	if ( !is_category() || !is_page() ) {
	$query->set('cat', '-493,-13004');
	}
	return $query;
	}

/**
 * Before or after 125th refresh
 */

add_filter( 'body_class', 'epoch_class' );
function epoch_class( $classes ) {
	
	$epoch = ( get_the_date('Ymd') > 20150301 ? "epoch-after125" : "epoch-before125" );
	
	if ( is_singular() ) {
	$classes[] = $epoch;
	}
	return $classes;
}

/**
 * Return section
 */
function wsunews_get_section() {
	
	if ( is_front_page() ) {
		
		$section = "cover";
		
	}
	
	else if ( is_page() ) {
		
		global $post;
		$parents = get_post_ancestors( $post->ID );
		$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
	    $parent = get_post( $id );
		$section = $parent->post_name;
		
	} else {
		
		$path = str_replace( get_home_url(), '', get_permalink() );
		$path = trim( $path, '/' );
		$path = explode( '/', $path );
		$section = $path[0];
		
	}
	
	return $section;
	
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function wsunews_sides() {

	register_sidebar( array(
		'name'          => 'Cover Sidebar',
		'id'            => 'side-cover',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));
	
	register_sidebar( array(
		'name'          => 'Local Sidebar',
		'id'            => 'side-local',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));
	
	register_sidebar( array(
		'name'          => 'Events Sidebar',
		'id'            => 'side-events',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));
	
	register_sidebar( array(
		'name'          => 'Athletics Sidebar',
		'id'            => 'side-athletics',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));
	
	register_sidebar( array(
		'name'          => 'Athletics Section',
		'id'            => 'section-athletics',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));
	
	register_sidebar( array(
		'name'          => 'People Sidebar',
		'id'            => 'side-people',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<header>',
		'after_title'   => '</header>',
	));

}
add_action( 'widgets_init', 'wsunews_sides' );

/**
 * Enable shortcodes in text widget
 */
add_filter( 'widget_text', 'do_shortcode');

/**
 * Include media tweaks
 */
include_once( 'includes/media-admin.php' ); // Alter media insertion and settings

/**
 * Add byline field
 * 
 * @param WP_Post $post The object for the current post/page.
 */

function add_byline_to_user($profile_fields) {

	// Add new fields
	$profile_fields['affiliation'] = 'Author Affiliation <br>(for byline)';
	// $profile_fields['byline'] = 'Author Byline';

	return $profile_fields;
}
add_filter('user_contactmethods', 'add_byline_to_user');


function notes_add_meta_box() {

	$details = array( 'post' );

	foreach ( $details as $detail ) {

		add_meta_box(
			'notes_sectionid',
			__( 'Story Details', 'notes_textdomain' ),
			'notes_meta_box_callback',
			$detail
		);
	}
}
add_action( 'add_meta_boxes', 'notes_add_meta_box' );


add_filter('mce_css', 'news_mcekit_editor_style');
function news_mcekit_editor_style($url) {
 
    if ( !empty($url) )
        $url .= ',';
 
    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= get_stylesheet_directory_uri(). '/styles/editor-styles.css';
 
    return $url;
}
 
/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'news_mce_editor_buttons' );
 
function news_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
 
/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'news_mce_before_init' );
 
function news_mce_before_init( $settings ) {
 
    $style_formats = array(
        array(
            'title' => 'Download Link',
            'selector' => 'a',
            'classes' => 'download',
            ),
        array(
            'title' => 'Location',
            'inline' => 'b',
            'classes' => 'location',
            ),
        array(
            'title' => 'Testimonial',
            'selector' => 'p',
            'classes' => 'testimonial',
        ),
        array(
            'title' => 'Data',
            'block' => 'dl',
            'wrapper' => true,
        ),
        array(
            'title' => 'Data Title',
            'block' => 'dt',
        ),
        array(
            'title' => 'Datum',
            'block' => 'dd',
        ),
		array(  
			'title' => 'Aside',  
			'block' => 'aside',  
			'classes' => 'aside',
			'wrapper' => true,
		),
		array(  
			'title' => 'Pullquote',  
			'block' => 'blockquote',  
			'classes' => 'pullquote',
			'wrapper' => true,
		),
        array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )
    );
 
    $settings['style_formats'] = json_encode( $style_formats );
 
    return $settings;
 
}
 
/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
/* Hattip: http://code.tutsplus.com/tutorials/adding-custom-styles-in-wordpress-tinymce-editor--wp-24980 */
 
/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'news_mcekit_editor_enqueue');
 
/*
 * Enqueue stylesheet, if it exists.
 */
function news_mcekit_editor_enqueue() {
  $StyleUrl = get_stylesheet_directory_uri().'/styles/editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}


/* function news_insert_image( $html, $id, $caption, $title, $align, $url  ) {
	
	//$image_tag = get_image_tag($id, '', $title, $align, $size);
	//$img_classes = apply_filters('get_image_tag_class', $class, $id, $align, $size);
  
  	//$img_classes = wp_get_attachment_image_attributes( $id );
  	//$img_classes = get_image_tag_class($id);
  	//$img_classes = "unknown";
  	
  	//$image_specs = wp_get_attachment_image_src( $id );
  	$image_url = wp_get_attachment_image_src( $id, $size, $icon ); 
  	$image_url = $image_url[0]; 
  	//$image_attributes = wp_get_attachment_image_attributes( $id );
  
	$html5 = "<figure id='post-$id media-$id' class='align-$align'>";
	$html5 .= "<img src='$image_url' alt='$title' />";
	//$html5 .= $image_url;
	//$html5 .= $image_attributes[0];
	//$html5 .= $image_specs[0];
	if ($caption) {
    	$html5 .= "<figcaption>$caption</figcaption>";
	}
	$html5 .= "</figure>";
	
	return $html5;
	
	}
	
add_filter( 'image_send_to_editor', 'news_insert_image', 10, 9 ); */


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function notes_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'notes_meta_box', 'notes_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="notes_new_field">';
	_e( 'Description for this field', 'notes_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="notes_new_field" name="notes_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function notes_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['notes_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['notes_meta_box_nonce'], 'notes_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['notes_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['notes_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'notes_save_meta_box_data' );