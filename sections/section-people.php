<?php
		
	$posts_people = array(
	'posts_per_page'   => 10,
	'category_name'    => 'wsu-alumni-features, student-news, employee-news',
	//'tag'			   => 'featured',
	);
	
	$articles = new WP_Query( $posts_people );
	
	while ( $articles->have_posts() ) : $articles->the_post();
	
		get_template_part( 'articles/story-before', get_post_type() );
	
	endwhile;
	
	wp_reset_postdata();
	
	if ( $news_section == "people" ) { 
	
		echo '<nav class="paging">';
		echo paginate_links( $paging );
		echo '</nav>';
	
	} else {
	
		echo section_link("people");
	
	}

?>