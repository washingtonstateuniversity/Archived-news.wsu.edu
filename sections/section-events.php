
<?php
	
	$events_categories = 'events-and-exhibits, events-and-exhibit';
	
	if ( isset($page_section) && $news_section != "cover" ) {
		if ( $page_section == "events" && $page_categories != "" ) {
			$events_categories = $page_categories;
		}
	}
			
	$paged = ( $news_section == "events" && get_query_var('paged') ) ? get_query_var('paged') : 1; 
	
	$articles_filter = array(
		'nopaging'				=> false,
		'paged'					=> $paged,
		'posts_per_page'		=> 10,
		'category_name'			=> $events_categories,
		'tag__not_in'			=> array($exclude_photos),
		'post_status'			=> 'publish',
	);
		
	$articles = new WP_Query( $articles_filter );
	
	while ( $articles->have_posts() ) : $articles->the_post();
	
		get_template_part( 'articles/story-before', get_post_type() );
	
	endwhile;
	
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
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
		'type'         => 'plain',
		'add_args'     => False,
		'add_fragment' => ''
	); 
	
	wp_reset_postdata();
	
	if ( $news_section == "events" ) { 
		
		echo '<nav class="paging">';
		echo paginate_links( $paging );
		echo '</nav>';
		
	} else {
		
		echo section_link("events");
	
	}
		
?>