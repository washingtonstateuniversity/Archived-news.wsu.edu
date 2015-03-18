<?php
	
	$posts_photos = array(
		'posts_per_page'   => 5,
		'tag_slug__in'    => 'photo-feature',
		'order'				=>	'ASC'
	);

	$articles = new WP_Query( $posts_photos );
	
	while ( $articles->have_posts() ) : $articles->the_post();

		get_template_part( 'articles/post', 'image' );

	endwhile;
	
	wp_reset_postdata();
	
	
	
 	?>
 	
 	go to photos