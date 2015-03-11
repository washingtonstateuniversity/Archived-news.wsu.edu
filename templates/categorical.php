<?php /* Template Name: Categorical */ ?>

<?php get_header(); ?>

<?php foreach( get_the_category() as $category ) {
			$categories[] = $category->cat_ID;
		}
		$categories = implode(", ", $categories);
?>

<main class="<?php // echo $categories; ?>">

<?php get_template_part( 'sections/sections' ); ?>

<section class="row margin-right gutter pad-ends">

	<div class="column one">
		
		<?php $section = get_section(); ?>
		
		<?php
			
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		
			$articles_filter = array(
				'nopaging'			=> false,
				'paged'				=> $paged,
				'posts_per_page'	=> 10,
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
		
	<?php //get_template_part( 'parts/pager', '' ); ?>
		
<?php

$big = 999999999; // need an unlikely integer

$paging = array(
	'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format'       => '/page/%#%',
	'total'        => $articles->max_num_pages,
	'current'      => max( 1, get_query_var('paged') ),
	'show_all'     => False,
	'end_size'     => 3,
	'mid_size'     => 3,
	'prev_next'    => True,
	'prev_text'    => __('« '),
	'next_text'    => __(' »'),
	'type'         => 'plain',
	'add_args'     => False,
	'add_fragment' => ''
); ?>

<nav class="paging">
	<?php echo paginate_links( $paging ); ?>
</nav>
	

<?php
// next_posts_link() usage with max_num_pages
next_posts_link( 'Older Entries', $articles->max_num_pages );
previous_posts_link( 'Newer Entries' );
?>
</footer>




</main>

<?php get_footer(); ?>