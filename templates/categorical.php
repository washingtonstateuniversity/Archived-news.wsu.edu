<?php /* Template Name: Categorical */ ?>

<?php get_header(); ?>

<?php foreach( get_the_category() as $category ) {
			$categories[] = $category->slug;
		}
		$page_categories = implode(", ", $categories);
		
		$page_slug = $post->post_name;
		$page_section = wsunews_get_section();
?>

<main class="categorical">

	<div class="main-body">
	
		<?php include(locate_template('/sections/sections.php')); ?>
		
	</div>

</main>

<?php get_footer(); ?>