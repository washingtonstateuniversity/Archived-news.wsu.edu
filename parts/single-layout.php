<section class="story row margin-right pad wide">

	<div class="column one">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'articles/post', get_post_type() ) ?>

		<?php endwhile; ?>

	</div><!--/column-->

</section>

<section class="row single pad wide">

	<div class="column one">
		
		<ul class="footer-sections padless">
	<li class="news crimson"><a href="">Topics</a></li>
	<li class="local yellow"><a href="">Local</a>
		<ul>
			<li><a href="">Pullman</a></li>
			<li><a href="">Vancouver</a></li>
			<li><a href="">Spokane</a></li>
			<li><a href="">Tri-Cities</a></li>
			<li><a href="">Global Campus</a></li>
		</ul>
	</li>
	<li class="press blue"><a href="">Press</a>
		<ul>
			<li><a href="">Press Releases</a></li>
			<li><a href="">In the News</a></li>
		</ul>
	</li>
	<li class="events orange"><a href="">Events</a>
		<ul>
			<li><a href="">Resource Nights: "Capital Ideas"</a></li>
			<li><a href="">Graduate research Seminar Presentation</a></li>
			<li><a href="">Student Recital: Kathy Perng, violin</a></li>
		</ul>
	</li>
	<li class="staff green"><a href="">Staff</a>
		<ul>
			<li><a href="">Announcements</a></li>
		</ul>
	</li>
</ul>

		<?php get_sidebar(); ?>

	</div><!--/column one-->

</section>