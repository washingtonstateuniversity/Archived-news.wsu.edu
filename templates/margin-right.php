<?php /* Template Name: Side - Right */ ?>

<?php get_header(); ?>

<main class="spine-margin-right-template">

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/headers'); ?>
<?php get_template_part('parts/featured-images'); ?>

<div class="main-body">

<section class="row margin-right pad">

	<div class="column one">

		<?php get_template_part('articles/article'); ?>

	</div><!--/column-->

	<div class="column two">

		<?php
		$column = get_post_meta( get_the_ID(), 'column-two', true );
		if( ! empty( $column ) ) { echo $column; }
		?>

	</div>

</section>

</div>

<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>