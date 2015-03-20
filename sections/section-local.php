<?php
	
	$news_section = wsunews_get_section();
	$news_section_link = '<a href="/'.$news_section.'/">View all stories in '.ucfirst($news_section).'</a>';
	$exclude_photos = ( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG ) ) ? "493" : "13004";
	
?>

<?php
			
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$local_categories = "wsu-spokane-news, wsu-tri-cities-news, wsu-vancouver-news, wsu-everett-news, wsu-extension-news";
		
			$articles_filter = array(
				'nopaging'				=> false,
				'paged'					=> $paged,
				'posts_per_page'		=> 10,
				'cat'					=> $local_categories,
				'tag_slug__not_in'		=> 'photo-feature',
				'post_status'			=> 'publish',
			);
				
			$articles = new WP_Query( $articles_filter );
			
			// echo $categories;
			
			while ( $articles->have_posts() ) : $articles->the_post();
		
				get_template_part( 'articles/post', get_post_type() );
		
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
				'prev_text'    => __('« Previous'),
				'next_text'    => __('Next »'),
				'type'         => 'plain',
				'add_args'     => False,
				'add_fragment' => ''
			); 

			
			wp_reset_postdata();
			
			?>
			
			
		
			<?php 
				if ( $news_section == "locales" ) { 
					
					echo '<nav class="paging">';
					echo paginate_links( $paging );
					echo '</nav>';
					
				} else {
					
					echo $news_section_link;
				
				}
				
				//get_template_part( 'parts/pager', '' );
			?>