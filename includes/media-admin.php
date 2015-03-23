<?php
	
function wsunews_default_image_size() {
    return 'spine-medium_size';
}
add_filter( 'pre_option_image_default_size', 'wsunews_default_image_size' );
	
update_option( 'image_default_size', 'spine-medium_size' );
	
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
