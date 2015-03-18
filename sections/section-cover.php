<?php
	
	$news_section = wsunews_get_section();
	$news_section_link = '<a href="/'.$news_section.'/">View all stories in '.ucfirst($news_section).'</a>';
	
?>


<div class="articles-continued">
		 <header>Headlines</header>
	 
	 <?php
	
		$posts_featured = array(
			'posts_per_page'   		=> 10,
			'category__not_in' 		=> array(473),
			'category_name'	   		=> 'top-stories',
			'category__not_in'		=> $exclude_photos,
			'offset'				=> 1,
		);
		
		$articles = new WP_Query( $posts_featured );
		
		while ( $articles->have_posts() ) : $articles->the_post();
	
			get_template_part( 'articles/post', get_post_type() );
	
		endwhile;
		
		wp_reset_postdata();
		
	 ?>
	 
	 </div>