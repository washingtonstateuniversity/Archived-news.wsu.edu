<?php

get_header();

// If a featured image is assigned to the post, display as a background image.
if ( spine_has_background_image() ) {
	$background_image_src = spine_get_background_image_src();
	?><style> html { background-image: url(<?php echo esc_url( $background_image_src ); ?>); }</style><?php
}
?>

<main class="story fluid">

<?php get_template_part('parts/headers');

	$featured_image = get_post( get_post_thumbnail_id() );
	$featured_image_title = $featured_image->post_title;
	$featured_image_caption = $featured_image->post_excerpt;
	$featured_image_description = $featured_image->post_content;
	
	if ( spine_has_featured_image() ) {
		$featured_image_src = spine_get_featured_image_src();
		?>
		<figure class="featured-image" style="background-image: url('<?php echo $featured_image_src ?>');">
		<?php
				
			spine_the_featured_image();
			
			if ( $featured_image_description !== "" ) {
				
				echo '<cite class="attribution"><span class="citation-text"><span class="image-title">'.$featured_image_title.' </span><span class="credit">'.$featured_image_description.'</span></cite>';
				
			}
			
			if ( $featured_image_caption !== "" ) {
				
				echo '<figcaption class="caption">'.$featured_image_caption.'</figcaption>';
				
			} 
	}
		?>
		</figure>

<div class="main-body">

	<div class="row margin-right">
	
		<div class="column one padded">
	
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'articles/post', get_post_type() ) ?>
	
			<?php endwhile; ?>
	
		</div><!--/column-->
	
	</div>

</div>

<footer class="main-footer">
		
	<section class="row halves pager prevnext gutter pad-ends">
		<div class="column one next-post">
			
			<?php 
				
			$next_post = get_next_post();
			
			if ( is_a( $next_post , 'WP_Post' ) ) : ?>
			
			<span class="section"><header class="section-header"><span class="rotate"><span class="section-title">Next</span></span></header></span>
			
			<?php
				
			$next_filter = array(
				'posts_per_page'		=> 1,
				'p'						=> $next_post->ID, 
			);
				
			$article = new WP_Query( $next_filter );
			
			while ( $article->have_posts() ) : $article->the_post();
			
				get_template_part( 'articles/story-before', get_post_type() );
			
			endwhile;
				
			wp_reset_query();
			
			endif;
			
			?>

		</div>
		<div class="column two">
			<?php previous_post_link('%link'); ?>
		</div>
	</section><!--pager-->
	
	<?php include(locate_template('sections/sections.php')); ?>

</footer>

</main><!--/#page-->

<?php get_footer(); ?>