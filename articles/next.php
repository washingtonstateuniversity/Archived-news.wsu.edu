 <?php /* Template Name: Next Posts */ ?>
 
 <?php

// Our variables
$load_number = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$load_page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
$load_section = (isset($_GET['category'])) ? $_GET['category'] : 'top-stories';
	
 	$offset = ( !is_paged() ) ? 1 : "";
 	
	$posts_featured = array(
		'nopaging'				=> false,
		'paged'					=> $load_page,
		'posts_per_page'   		=> $load_number,
		'category__not_in' 		=> array(473),
		'category_name'	   		=> $load_section,
		'tag__not_in'			=> array(499,13026),
		//'offset'				=> $offset
	);
	
	$cover_articles = new WP_Query( $posts_featured );
	
	while ( $cover_articles->have_posts() ) : $cover_articles->the_post();

		get_template_part( 'articles/story-before', get_post_type() );

	endwhile;
	
?>