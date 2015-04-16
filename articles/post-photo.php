<?php 
	if ( spine_has_featured_image() ) {
		$featured_image_src = spine_get_featured_image_src();
		$featured_image_bg = "style=\"background-image: url('".esc_url($featured_image_src)."');\"";
		$featured_image_img = "<figure style=\"background-image: url('".esc_url($featured_image_src)."');\"><img src=\"".esc_url($featured_image_src)."\"></figure>";
	} else {
		$featured_image_bg = "";
		$featured_image_img = "";
	}
	
	$featured_image = get_post( get_post_thumbnail_id() );
	$featured_image_title = $featured_image->post_title;
	$featured_image_caption = $featured_image->post_excerpt;
	$featured_image_description = $featured_image->post_content;
	
?>

<figure id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php echo $featured_image_bg; ?>>

	<?php //echo $featured_image_img; ?>
	
	<div class="flip next" role="next"><span></span></div>
	<div class="flip previous" role="previous"><span></span></div>
	
	<?php
	
		if ( $featured_image_description !== "" ) {
			
			echo '<cite class="attribution"><span class="citation-text"><span class="image-title">'.$featured_image_title.' </span><span class="credit">'.$featured_image_description.'</span></cite>';
			
		}
		
		if ( $featured_image_caption !== "" ) {
			
			echo '<figcaption class="caption">'.$featured_image_caption.'</figcaption>';
			
		}

	?>
	
	<header class="photo-header">
		<hgroup class="photo-meta">
			<time class="photo-date" hour="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date( 'c' ); ?>">
				<span class="default"><?php echo get_the_date(); ?></span>
				<span class="month"><?php echo get_the_date( 'M' ); ?></span>
				<span class="day"><?php echo get_the_date( 'd' ); ?></span>
				<span class="year-four"><?php echo get_the_date( 'Y' ); ?></span>
				<span class="year-two"><?php echo get_the_date( 'y' ); ?></span>
				<span class="oclock"><?php echo get_the_date( 'g' ); ?></span>
				<span class="oclock-zeros"><?php echo get_the_date( 'h' ); ?></span>
				<span class="hours"><?php echo get_the_date( 'G' ); ?></span>
				<span class="hours-zeros"><?php echo get_the_date( 'H' ); ?></span>
				<?php // echo get_the_date( 'c' ); ?>
			</time>
		</hgroup>
		<hgroup class="photo-byline">
			<cite class="photo-author">
				<span class="author" role="author"><?php the_author_posts_link(); ?></span>
				<span class="affiliation"><?php echo get_the_author_meta('affiliation'); ?></span>
			</cite>
		</hgroup>
		<hgroup class="photo-title">
			<?php if($post->post_content != "") : ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?>
				<?php
					
					if ( $featured_image_caption !== "" ) {
			
						echo $featured_image_caption;
							
					} else {
					
						the_title(); 
					 
					}
					 
				?>
			<?php if($post->post_content != "") : ?></a><?php endif; ?>
		</hgroup>
		
	</header>

	<footer class="article-footer">
	<?php

	// Display University locations attached to the post.
	if ( has_term( '', 'wsuwp_university_location' ) ) {
		$university_location_terms = get_the_terms( get_the_ID(), 'wsuwp_university_location' );
		if ( ! is_wp_error( $university_location_terms ) ) {
			echo '<dl class="university-location">';
			echo '<dt><span class="university-location-default">Location</span></dt>';

			foreach ( $university_location_terms as $term ) {
				$term_link = get_term_link( $term->term_id, 'wsuwp_university_location' );
				if ( ! is_wp_error( $term_link ) ) {
					echo '<dd><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></dd>';
				}
			}
			echo '</dl>';
		}
	}
	?>
	</footer><!-- .entry-meta -->
	
</figure>