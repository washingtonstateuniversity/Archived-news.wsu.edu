<?php /* Template Name: Categorical for Spine */ ?>

<?php get_header(); ?>

<?php foreach( get_the_category() as $category ) {
			$categories[] = $category->cat_ID;
		}
		$categories = implode(", ", $categories);
?>

<main class="<?php // echo $categories; ?>">

<?php get_template_part('parts/headers'); ?>
<?php get_template_part('parts/featured-images'); ?>

<section class="row margin-right gutter pad-ends">

	<div class="column one">
		
		<?php 
		
			$articles_filter = array(
				'nopaging'			=> false,
				'paged'				=> '1',
				'posts_per_page'	=> 20,
				'cat'				=> $categories,
				'post_status'		=> 'publish',
			);
				
			$articles = new WP_Query( $articles_filter );
			
			// echo $categories;
			
			while ( $articles->have_posts() ) : $articles->the_post();
		
				get_template_part( 'articles/post', get_post_type() );
		
			endwhile;
			
			?>

	</div><!--/column-->

	<div class="column two">


	</div>

</section>

<footer>
	<?php

// next_posts_link() usage with max_num_pages
next_posts_link( 'Older Entries', $articles->max_num_pages );
previous_posts_link( 'Newer Entries' );
?>
</footer>

</main>

<?php get_footer(); ?>