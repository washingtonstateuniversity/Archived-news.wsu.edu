<?php
	
	$news_section = get_section();
	$news_section_link = '<a href="/'.$news_section.'/">View all stories in '.ucfirst($news_section).'</a>';
	$exclude_photos = ( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG ) ) ? "493" : "13004";
	
?>

<div class="section-tabs">	
	<div class="section-tab green" data-sec="5"><span class="section-title">People</span></div>
	<div class="section-tab orange" data-sec="4"><span class="section-title">Events</span></div>
	<div class="section-tab blue" data-sec="3"><span class="section-title">Press</span></div>
	<div class="section-tab yellow" data-sec="2"><span class="section-title">Local</span></div>
	<div class="section-tab crimson" data-sec="1"><span class="section-title">Front</span></div>
</div>

<div class="sections column ten-twelfths equalize">

	<section id="crimson" class="section sec-1 crimson featured column one news-section <?php echo ( $news_section == "cover" ? "opened current" : "closed" ); ?>" data-sec="1">
		
		<header class="section-header"><span class="section-title">News</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
		
		<aside class="section-side column two">
		<?php get_template_part( 'sections/side', 'cover' ); ?>
		
		</aside>
		
		<div class="articles lead column one">
	
		<div class="article-featured">
		
		<?php
		
		$posts_featured = array(
			'posts_per_page'   => 1,
			'category__not_in' => array(473),
			'category_name'	   => 'top-stories',
		);
		
			$articles = new WP_Query( $posts_featured );
			
			while ( $articles->have_posts() ) : $articles->the_post();
		
				get_template_part( 'articles/post', get_post_type() );
		
			endwhile;
			
			wp_reset_postdata();
			
		 ?>
		 
		</div>
	
		<?php get_template_part( 'sections/today', '' ); ?>
	 
		<?php get_template_part( 'sections/section', 'cover' ); ?>
	 
	 
		</div><!--/ articles -->
		
		</div><!--/ nest -->
		
	</section>
	
	<section id="yellow" class="section sec-2 yellow local column two news-section <?php echo ( $news_section == "local" ? "opened current" : "" ); ?>" data-sec="2">
		
		<header class="section-header"><span class="section-title">Local</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
		
			<aside class="section-side column two">
				
				<?php get_template_part( 'sections/side', 'local' ); ?>
			
			</aside>
			
			<div class="articles column one">

				<?php get_template_part( 'sections/section', 'local' ); ?>

		</div><!--/ .column.one articles -->
		
		</div><!--/ nest -->
		
	</section>
	
	<section id="blue" class="section sec-3 blue students column three news-section <?php echo ( $news_section == "press" ? "opened current" : "" ); ?>" data-sec="3">
		
		<header class="section-header"><span class="section-title">Press</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
			
		
		<aside class="section-side column two">
			
			<?php get_template_part( 'sections/side', 'press' ); ?>
		
		</aside>
		
		<div class="articles column one">
			
	<?php
	
		$articles_press = array(
			'posts_per_page'   => 5,
			'category_name'         => 'wsu-press-releases',
			//'tag'			   => 'featured',
			'suppress_filters' => true
		);
		
		$articles = new WP_Query( $articles_press );
		
		while ( $articles->have_posts() ) : $articles->the_post();
	
			get_template_part( 'articles/post', get_post_type() );
	
		endwhile;
		
		wp_reset_postdata();
		
		?>
		
		<?php if ( $news_section == "press" ) { echo $news_section_link; } ?>
		
		</div><!--/ articles -->
		
		</div><!--/ nest -->
	
	</section>
	
	<section id="orange" class="section sec-4 orange events column four news-section <?php echo ( $news_section == "events" ? "opened current" : "" ); ?>" data-sec="4">
		<header class="section-header"><span class="section-title">Events</span></header>
		
		<div class="enclosure row margin-right equalize">
		
		<aside class="section-side column two">
			
		<ul>
			<li>WSU In the Media</li>
			<li>Press Releases</li>
		</ul>
		
		</aside>
		
		<div class="column one articles">
		
		<?php
		
			$articles_alumni = array(
				'posts_per_page'   => 5,
				'category_name'         => 'events-and-exhibit',
				//'tag'			   => 'featured',
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_status'      => 'publish',
				'suppress_filters' => true,
			);
		
			$articles = new WP_Query( $articles_alumni );
			
			while ( $articles->have_posts() ) : $articles->the_post();
		
				get_template_part( 'articles/post', get_post_type() );
		
			endwhile;
			
			wp_reset_postdata();
		
		?>
	
		</div>
		
		</div><!-- /encolure -->
	
	</section>
	
	<section id="staff" class="section sec-5 green people column five news-section <?php echo ( $news_section == "people" ? "opened current" : "closed" ); ?>" data-sec="5">
	
		<header class="section-header"><span class="section-title">Staff</span></header>
		
		<div class="enclosure row margin-right equalize xreverse">
			
		<aside class="section-side column two">
			
		<ul>
			<li>Announcements</li>
			<li>Obituaries</li>
		</ul>
		
		</aside>
		
		<div class="articles column one">
	
		<?php
		
		$posts_staff = array(
			'posts_per_page'   => 5,
			'category_name'         => 'wsu-alumni-features',
			//'tag'			   => 'featured',
		);
	
		$articles = new WP_Query( $posts_staff );
		
		while ( $articles->have_posts() ) : $articles->the_post();
	
			get_template_part( 'articles/post', get_post_type() );
	
		endwhile;
		
		wp_reset_postdata();
		
	 	?>
	 
		</div>
		
		</div><!--/ nest -->
	
	</section>
	
	<section id="photo" class="section section-photo sec-6 gray-darkest photo gray-darkest-back photo column five news-section clear-none unbound recto unequaled" data-sec="6">
	
		<header class="section-header"><span class="section-title">Photo</span></header>

	
		<?php
		
		$posts_photos = array(
			'posts_per_page'   => 5,
			'category_name'         => 'seen',
		);
	
		$articles = new WP_Query( $posts_photos );
		
		while ( $articles->have_posts() ) : $articles->the_post();
	
			get_template_part( 'articles/post', 'image' );
	
		endwhile;
		
		wp_reset_postdata();
		
	 	?>
	 

	
	</section>

</div><!-- /sections -->