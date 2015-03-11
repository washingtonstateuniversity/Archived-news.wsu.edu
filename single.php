<?php

get_header();

// If a featured image is assigned to the post, display as a background image.
if ( spine_has_background_image() ) {
	$background_image_src = spine_get_background_image_src();
	?><style> html { background-image: url(<?php echo esc_url( $background_image_src ); ?>); }</style><?php
}
?>

<main>

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

<section class="story row margin-right pad wide">

	<div class="column one">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'articles/post', get_post_type() ) ?>

		<?php endwhile; ?>

	</div><!--/column-->

</section>

<footer class="main-footer">
	
	<section class="row single pad wide">
	
		<div class="column one">
			
		<ul class="footer-sections padless">
			<li class="news crimson"><a href="">Topics</a></li>
			<li class="local yellow">
				<a href="">Local</a>
				<ul>
					<li><a href="">Pullman</a></li>
					<li><a href="">Vancouver</a></li>
					<li><a href="">Spokane</a></li>
					<li><a href="">Tri-Cities</a></li>
					<li><a href="">Global Campus</a></li>
				</ul>
			</li>
			<li class="press blue">
				<a href="">Press</a>
				<ul>
					<li><a href="">Press Releases</a></li>
					<li><a href="">In the News</a></li>
				</ul>
			</li>
			<li class="events orange">
				<a href="">Events</a>
				<ul>
					<li><a href="">Resource Nights: "Capital Ideas"</a></li>
					<li><a href="">Graduate research Seminar Presentation</a></li>
					<li><a href="">Student Recital: Kathy Perng, violin</a></li>
				</ul>
			</li>
			<li class="staff green">
				<a href="">Staff</a>
				<ul>
					<li><a href="">Announcements</a></li>
				</ul>
			</li>
		</ul>
		
		</div><!--/column one-->
	
	</section>
	
	<section class="row halves pager prevnext gutter pad-ends">
		<div class="column one">
			<?php previous_post_link(); ?>
		</div>
		<div class="column two">
			<?php next_post_link(); ?>
		</div>
	</section><!--pager-->

</footer>

</main><!--/#page-->

<?php get_footer(); ?>