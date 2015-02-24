<?php

add_action( 'wp_enqueue_scripts', 'news_scripts' );
/**
 * Enqueue child theme Javascript files.
 */
function news_scripts() {
	wp_enqueue_script( 'brand.js', get_stylesheet_directory_uri() . '/scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'brand.js', get_stylesheet_directory_uri() . '/scripts/jquery.mobile.custom.min.js', array( 'jquery' ), false, true );
}

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio' ) );

function byline_add_meta_box() {

	$details = array( 'post' );

	foreach ( $details as $detail ) {

		add_meta_box(
			'byline_sectionid',
			__( 'Story Details', 'byline_textdomain' ),
			'byline_meta_box_callback',
			$detail
		);
	}
}
add_action( 'add_meta_boxes', 'byline_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function byline_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'byline_meta_box', 'byline_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="byline_new_field">';
	_e( 'Description for this field', 'byline_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="byline_new_field" name="byline_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function byline_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['byline_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['byline_meta_box_nonce'], 'byline_meta_box' ) ) {
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
	if ( ! isset( $_POST['byline_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['byline_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'byline_save_meta_box_data' );