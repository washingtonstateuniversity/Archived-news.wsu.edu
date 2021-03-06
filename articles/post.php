<?php if ( spine_has_featured_image() ) {
		$featured_image_src = spine_get_featured_image_src();
		$featured_image_bg = "style=\"background-image: url('".esc_url($featured_image_src)."');\"";
		$featured_image_img = "<figure style=\"background-image: url('".esc_url($featured_image_src)."');\"><img src=\"".esc_url($featured_image_src)."\"></figure>";
	} else {
		$featured_image_bg = "";
		$featured_image_img = "";
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php //echo $featured_image_bg; ?>>

	<?php //echo $featured_image_img; ?>
	
	<?php
		
		if ( spine_has_thumbnail_image() ) {
				?><figure class="article-thumbnail"><?php spine_the_thumbnail_image(); ?></figure><?php
			} elseif ( spine_has_featured_image() ) {
				?><figure class="article-thumbnail"><?php the_post_thumbnail( 'spine-thumbnail_size' ); ?></figure><?php
			}
		
	?>
				
	<header class="article-header" <?php echo $featured_image_bg; ?>>
		<hgroup class="article-meta">
			<?php
				$story_referenced_date = get_post_meta( get_the_ID(), 'story_referenced_date', true );
				if( ! empty( $story_referenced_date ) ) : ?>
			
			<time class="referenced-date">
				<?php echo $story_referenced_date; ?>
			</time>
			<?php else : ?>
			<time class="article-date" hour="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date( 'c' ); ?>">
				<span class="default"><?php echo get_the_date(); ?></span>
				<span class="year-four"><?php echo get_the_date( 'Y' ); ?></span>
				<span class="year-two"><?php echo get_the_date( 'y' ); ?></span>
				<span class="oclock"><?php echo get_the_date( 'g' ); ?></span>
				<span class="oclock-zeros"><?php echo get_the_date( 'h' ); ?></span>
				<span class="hours"><?php echo get_the_date( 'G' ); ?></span>
				<span class="hours-zeros"><?php echo get_the_date( 'H' ); ?></span>
				<span class="minutes"><?php echo get_the_date( 'i' ); ?></span>
				<span class="timezone"><?php echo get_the_date( 'T' ); ?></span>
				<?php // echo get_the_date( 'c' ); ?>
			</time>
			<?php endif; ?>
		</hgroup>
		
		<hgroup class="article-title">
		<?php if ( is_single() ) : ?>
			<?php if ( spine_get_option( 'articletitle_show' ) == 'true' ) : ?>
				<h1 class="serif"><?php the_title(); ?></h1>
			<?php endif; ?>
		<?php else : ?>
			<h2>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php endif; // is_single() or in_a_relationship() ?>
		</hgroup>
		
		<hgroup class="article-byline">
			<cite class="article-author">
				<?php
				$author_byline = get_post_meta( get_the_ID(), 'story_author_byline', true );
				$author_byline_title = get_post_meta( get_the_ID(), 'story_author_byline_title', true );
				?>
				<b class="author" role="author"><?php if( ! empty( $author_byline ) &&  $author_byline !== "uncredited" ) { echo $author_byline; } else { the_author_posts_link(); } ?></b>
				<i class="affiliation"><?php if( ! empty( $author_byline_title ) && $author_byline_title !== "untitled" ) { echo $author_byline_title; } else { echo get_the_author_meta('author_title'); } ?></i>
			</cite>
		</hgroup>
		
	</header>

	<?php if ( ! is_singular() ) : ?>
			
		<div class="article-summary">
			<?php

			// If a manual excerpt is available, default to that. If `<!--more-->` exists in content, default
			// to that. If an option is set specifically to display excerpts, default to that. Otherwise show
			// full content.
			if ( $post->post_excerpt ) {
				echo get_the_excerpt() . ' <a href="' . get_permalink() . '"><span class="excerpt-more-default">Read Story</span></a>';
			} elseif ( strstr( $post->post_content, '<!--more-->' ) ) {
				the_content( '<span class="content-more-default">Read Story</span>' );
			} elseif ( 'excerpt' === spine_get_option( 'archive_content_display' ) ) {
				the_excerpt();
			} else {
				the_content();
			}

			?>
		</div><!-- .article-summary -->
	
	<?php else : ?>
		<div class="article-body">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'spine' ), 'after' => '</div>' ) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( comments_open() && is_singular() ) : ?>
	<blockquote class="comments">

	</blockquote>
	<?php endif; // comments_open() ?>

	<footer class="article-footer">
	<?php
	// Display site level categories attached to the post.
	if ( has_category() ) {
		echo '<dl class="categorized">';
		echo '<dt><span class="categorized-default">Categorized</span></dt>';
		foreach( get_the_category() as $category ) {
			echo '<dd><a href="' . get_category_link( $category->cat_ID ) . '">' . $category->cat_name . '</a></dd>';
		}
		echo '</dl>';
	}

	// Display University categories attached to the post.
	if ( has_term( '', 'wsuwp_university_category' ) ) {
		$university_category_terms = get_the_terms( get_the_ID(), 'wsuwp_university_category' );
		if ( ! is_wp_error( $university_category_terms ) ) {
			echo '<dl class="university-categorized">';
			echo '<dt><span class="university-categorized-default">Categorized</span></dt>';

			foreach ( $university_category_terms as $term ) {
				$term_link = get_term_link( $term->term_id, 'wsuwp_university_category' );
				if ( ! is_wp_error( $term_link ) ) {
					echo '<dd><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></dd>';
				}
			}
			echo '</dl>';
		}
	}

	// Display University tags attached to the post.
	if ( has_tag() ) {
		echo '<dl class="tagged">';
		echo '<dt><span class="tagged-default">Tagged</span></dt>';
		foreach( get_the_tags() as $tag ) {
			echo '<dd><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></dd>';
		}
		echo '</dl>';
	}

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
	
	

	// Comments Allowed
	// if ( comments_open()) {}

	// If the user viewing the post can edit it, show an edit link.
	if ( current_user_can( 'edit_post', $post->ID ) && ! is_singular() ) {
		?><dl class="editors"><?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></dl><?php
	}

	// If a user has filled out their description and this is a multi-author blog, show a bio on their entries.
	if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php
				/** This filter is documented in author.php */
				$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
				echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
				?>
			</div><!-- .author-avatar -->
			<div class="author-description">
				<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
				<p><?php the_author_meta( 'description' ); ?></p>
				<div class="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
					</a>
				</div><!-- .author-link	-->
			</div><!-- .author-description -->
		</div><!-- .author-info -->
	<?php endif; ?>
	</footer><!-- .entry-meta -->	
		
</article>