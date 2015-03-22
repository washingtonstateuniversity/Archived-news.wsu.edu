<?php
	
	$articles_press = array(
		'posts_per_page'   		=> 10,
		'category_name'         => 'wsu-press-releases',
		//'tag'			   		=> 'featured',
		'suppress_filters' 		=> true
	);
	
	$articles = new WP_Query( $articles_press );
	
	while ( $articles->have_posts() ) : $articles->the_post();
	
		get_template_part( 'articles/story-before', get_post_type() );
	
	endwhile;
	
	wp_reset_postdata();
	
	if ( $news_section == "press" ) { 
		
		echo '<nav class="paging">';
		echo paginate_links( $paging );
		echo '</nav>';
		
	} else {
		
		echo section_link("press");
	
	}

?>