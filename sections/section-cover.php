<?php
	
	$cover_categories = 'top-stories';

 	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
 	$offset = ( !is_paged() ) ? 1 : "";
 	
	$posts_featured = array(
		'nopaging'				=> false,
		'paged'					=> $paged,
		'posts_per_page'   		=> 10,
		'category__not_in' 		=> array(473),
		'category_name'	   		=> $cover_categories,
		'tag__not_in'			=> array($exclude_photos),
		'offset'				=> $offset
	);
	
	$cover_articles = new WP_Query( $posts_featured );
	
	while ( $cover_articles->have_posts() ) : $cover_articles->the_post();

		get_template_part( 'articles/story-before', get_post_type() );

	endwhile;
	
	$big = 999999999; // need an unlikely integer

	$paging = array(
		'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'       => '/page/%#%',
		'total'        => $cover_articles->max_num_pages,
		'current'      => max( 1, $paged ),
		'show_all'     => False,
		'end_size'     => 3,
		'mid_size'     => 3,
		'prev_next'    => True,
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
		'type'         => 'plain',
		'add_args'     => False,
		'add_fragment' => ''
	); 

	wp_reset_postdata();
	
	if ( $news_section == "cover" ) { 
		
		echo '<nav class="paging">';
		echo paginate_links( $paging );
		echo '</nav>';
		
	} else {
		
		echo '<a href="/category/top-stories/" class="section-link">View all featured stories</a>';
	
	}
	
?>
	 
