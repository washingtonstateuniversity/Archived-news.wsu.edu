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

	if ( spine_has_featured_image() ) {
		$featured_image_src = spine_get_featured_image_src();
		?>
		<figure class="featured-image" style="background-image: url('<?php echo $featured_image_src ?>');">
			<?php spine_the_featured_image(); ?>
		</figure>
		<?php
	}
	
?>

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
		<div class="column one">
			<?php previous_post_link('%link'); ?>
		</div>
		<div class="column two">
			<?php next_post_link('%link'); ?>
		</div>
	</section><!--pager-->
	
	<?php include(locate_template('sections/sections.php')); ?>

</footer>

</main><!--/#page-->

<?php get_footer(); ?>