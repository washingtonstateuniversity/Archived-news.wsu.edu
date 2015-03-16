<?php

add_action( 'wp_enqueue_scripts', 'news_scripts' );
/**
 * Enqueue child theme Javascript files.
 */
function news_scripts() {
	wp_enqueue_script( 'brand.js', get_stylesheet_directory_uri() . '/scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'brand.js', get_stylesheet_directory_uri() . '/scripts/jquery.mobile.custom.min.js', array( 'jquery' ), false, true );
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
 * Before or after 125th refresh
 */

add_filter( 'body_class', 'epoch_class' );
function epoch_class( $classes ) {
	
	$epoch = ( get_the_date('Ymd') > 20150301 ? "epoch-after125" : "epoch-before125" );
	
	if ( is_singular() ) {
	$classes[] = $epoch;
	// return the $classes array
	return $classes;
	}
}

/**
 * Return section
 */
function get_section() {
	
	// Paths may be polluted with additional site information, so we
	// compare the post/page permalink with the home URL.
/*
	$path = str_replace( get_home_url(), '', get_permalink() );
	$path = trim( $path, '/' );
	$path = explode( '/', $path );
*/
	
/*
	if ( is_front_page() ) {
		$section = "cover";
	} else {
		$section = $path[0];
	}
*/
/*
	global $post;
	
	if ( is_front_page() ) {
		$section = "cover";
	} else if ($post->post_parent)	{
		$ancestors=get_post_ancestors($post->ID);
		$root=count($ancestors)-1;
		$section = $ancestors[$root];
		$section = $section->post_name;
	} else {
		$section = $post->post_name;
	}
*/

	$section = "no section";
	
	if( is_page() ) { 
		global $post;
	        /* Get an array of Ancestors and Parents if they exist */
		$parents = get_post_ancestors( $post->ID );
	        /* Get the top Level page->ID count base 1, array base 0 so -1 */ 
		$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
		/* Get the parent and set the $class with the page slug (post_name) */
	    $parent = get_post( $id );
		$section = $parent->post_name;
		
	}
	
	return $section;
	
}


/**
 * Add imagery options to settings panes.
 */
add_action('print_media_templates', 'wsunews_extend_image_settings');

function wsunews_extend_image_settings() {
	
if ( is_admin() ) {
  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>
<!--
 <script type="text/html" id="tmpl-my-custom-gallery-setting">
   <label class="setting">
   <span><?php _e('My setting'); ?></span>
   <select data-setting="my_custom_attr">
     <option value="foo"> Foo </option>
     <option value="bar"> Bar </option>
     <option value="default_val"> Default Value </option>
    </select>
  </label>
</script>
-->

<script type="text/html" id="tmpl-gallery-caption">
   <label class="setting">
   <span><?php _e('Caption'); ?></span>
   <textarea data-setting="gallery_caption"></textarea>
  </label>
</script>

<script type="text/html" id="tmpl-gallery-credit">
   <label class="setting">
   <span><?php _e('Credit'); ?></span>
   <input type="test" data-setting="gallery_credit">
  </label>
</script>

<script type="text/html" id="tmpl-gallery-display">
   <label class="setting">
   <span><?php _e('Display'); ?></span>
   <select data-setting="gallery-display">
	 <option value="block" selected> Block </option>
     <option value="aside"> Aside </option>
     <option value="inline"> Inline </option>
    </select>
  </label>
</script>

<script>
	
	jQuery(document).ready(function(){

  // add your shortcode attribute and its default value to the
  // gallery settings list; $.extend should work as well...
  _.extend(wp.media.gallery.defaults, {
    gallery_caption: '',
    gallery_display: '',
    gallery_credit: ''
  });

  // merge default gallery settings template with yours
  wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
    template: function(view){
      return wp.media.template('gallery-settings')(view)
      	   + wp.media.template('gallery-display')(view)
      	   + wp.media.template('gallery-credit')(view)
           + wp.media.template('gallery-caption')(view);
    }
  });

});

</script>

 <?php
	 
	}

}

add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => $html5 ? 'figure'     : 'dl',
        'icontag'    => $html5 ? 'div'        : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'gallery_caption' => '',
        'gallery_display' => '',
        'gallery_credit' => '',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery' );
 
    $id = intval( $atts['id'] );
 
    if ( ! empty( $atts['include'] ) ) {
        $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
 
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $atts['exclude'] ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }
 
    if ( empty( $attachments ) ) {
        return '';
    }
 
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
        }
        return $output;
    }
 
    $itemtag = tag_escape( $atts['itemtag'] );
    $captiontag = tag_escape( $atts['captiontag'] );
    $gallery_caption = $atts['gallery_caption'];
    $gallery_display = tag_escape( $atts['gallery_display'] );
    $gallery_credit = $atts['gallery_credit'];
    $icontag = tag_escape( $atts['icontag'] );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) ) {
        $itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[ $captiontag ] ) ) {
        $captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[ $icontag ] ) ) {
        $icontag = 'dt';
    }
 
    $columns = intval( $atts['columns'] );
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';
 
    $selector = "gallery-{$instance}";
 
    $gallery_style = '';
 
    /**
     * Filter whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
            /* see gallery_shortcode() in wp-includes/media.php */
        </style>\n\t\t";
    }
 
    $size_class = sanitize_html_class( $atts['size'] );
    $gallery_div = "<figure id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} gallery-display-{$gallery_display}'>";
 
    /**
     * Filter the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );
 
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
 
        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
            $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
            $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        } else {
            $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
        }
        $image_meta  = wp_get_attachment_metadata( $id );
 
        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        }
        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text figure-caption' id='$selector-$id'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
            $output .= '<br style="clear: both" />';
        }
    }
 
    if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
        $output .= "
            <br style='clear: both' />";
    }
 
    $output .= "
    	<footer class=\"gallery-footer\">
	    	<figcaption class=\"gallery-caption\">{$gallery_caption}</figcaption>
	    	<cite class=\"gallery-credit\">{$gallery_credit}</cite>
	    </footer>
        </figure>\n";
 
    return $output;
}

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