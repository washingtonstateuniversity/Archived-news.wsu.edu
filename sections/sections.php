<div class="section-tabs">	
	<div class="section-tab green" data-sec="5"><span class="section-title">Staff</span></div>
	<div class="section-tab orange" data-sec="4"><span class="section-title">Events</span></div>
	<div class="section-tab blue" data-sec="3"><span class="section-title">Press</span></div>
	<div class="section-tab yellow" data-sec="2"><span class="section-title">Local</span></div>
	<div class="section-tab crimson" data-sec="1"><span class="section-title">Front</span></div>
</div>

<div class="sections column ten-twelfths equalize">

	<section id="crimson" class="section sec-1 crimson featured column one news-section opened clear-none" data-sec="1">
		
		<header class="section-header"><span class="section-title">News</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
		
		<aside class="section-side column two">
		
		<ul>
		<?php 
			
			( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG )) ? $child_of = "479" : $child_of = "12986";
			
		    $args = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			//'order'              => 'ASC',
			//'style'              => 'list',
			//'show_count'         => 0,
			'hide_empty'         => 0,
			'use_desc_for_title' => 1,
			'child_of'           => $child_of,
			'feed'               => '',
			//'feed_type'          => '',
			//'feed_image'         => '',
			//'exclude'            => '',
			//'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 0,
			'title_li'           => __( '' ),
			//'show_option_none'   => __( '' ),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 1,
			'current_category'   => 0,
			//'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'walker'             => null
		    );
		    wp_list_categories( $args ); 
		?>
		</ul>

		<hr>
		
		<ul>
		<?php 
			
			( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG )) ? $child_of = "478" : $child_of = "12982";
			
		    $args = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'hide_empty'         => 0,
			'use_desc_for_title' => 1,
			'child_of'           => $child_of,
			'feed'               => '',
			'include'            => '',
			'hierarchical'       => 0,
			'title_li'           => __( '<span>Challenges</span>' ),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 1,
			'current_category'   => 0,
			'taxonomy'           => 'category',
			'walker'             => null
		    );
		    wp_list_categories( $args ); 
		?>
		</ul>
		
		<hr>
		
		<ul>
			<header>Just In</header>
			<?php $args = array(
			    'numberposts' => 5,
			    'offset' => 0,
			    'category' => 0,
			    'orderby' => 'post_date',
			    'order' => 'DESC',
			    //'include' => ,
			    //'exclude' => ,
			    //'meta_key' => ,
			    //'meta_value' =>,
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'suppress_filters' => true );
			
			    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
			    foreach( $recent_posts as $recent ){
					echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a> </li> ';
				}
			?>
		</ul>
		
		<hr>
		
		<ul>
			<header>Popular</header>
			<?php $args = array(
				'posts_per_page'   => 5,
				'offset'           => 0,
				'category'         => '',
				'category_name'    => '',
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'tag'				=> 'popular',
				'include'          => '',
				'exclude'          => '',
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'post',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts = get_posts( $args );
			
			foreach ( $posts as $post ) : setup_postdata( $post );
				echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			endforeach;
			wp_reset_postdata();
			?>
			
		</ul>
		
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
	 
	 <div id="" class="today-tomorrow">
		 
		 <dl class="tab">
				 	<dt class="today" tab="1">Today</dt>
				 	<dt class="tomorrow" tab="2">Tomorrow</dt>
				 	<dd class="today">
		 
					 <a href="#">
					 <dl class="event cf">
						 <dt>
						 	<span class="event-title">Washington Policy Center’s Young Professionals minimum wage debate</span>
						 	<address>Bryan Hall Theatre, WSU Campus, Pullman, WA</address>
						 </dt>
						 <dd>
						 	<time><span class="hour">8:45</span><span class="meridiem">AM</span></time>
						 	
						 </dd>
					 </dl>
					 </a>
					 <a href="#">
					 <dl class="event cf">
						 <dt>
						 	<span class="series">Lunch & Learn</span>
						 	<span class="event-title">Interviewing Basics for New Healthcare Professionals</span>
						 	<address>Bryan Hall Theatre, WSU Campus, Pullman, WA</address>
						 </dt>
						 <dd>
						 	<time><span class="hour">6:00</span><span class="meridiem">PM</span></time>
						 	
						 </dd>
					 </dl>
					 </a>
					 <a href="#">
					 <dl class="event cf">
						 <dt>
						 	<span class="event-title">Resource Nights: “Capital Ideas”</span>
						 	<address>Todd Addition, Room 268, Pullman</address>
						 </dt>
						 <dd>
						 	<time><span class="hour">8:30</span><span class="meridiem">PM</span></time>
						 	
						 </dd>
					 </dl>
					 </a>
		 
				</dd>
				
				<dd class="tomorrow" tab="2">
				</dd>

		</dl>
	 
	 </div>
	 
	 <div class="articles-continued">
		 <header>Headlines</header>
	 
	 <?php
	
	$posts_featured = array(
		'posts_per_page'   => 5,
		'category__not_in' => array(473),
		'category_name'	   => 'top-stories',
		'offset'			=> 1,
	);
	
		$articles = new WP_Query( $posts_featured );
		
		while ( $articles->have_posts() ) : $articles->the_post();
	
			get_template_part( 'articles/post', get_post_type() );
	
		endwhile;
		
		wp_reset_postdata();
		
	 ?>
	 
	 </div>
	 
	 
		</div><!--/ articles -->
		
		</div><!--/ nest -->
		
	</section>
	
	<section id="yellow" class="section sec-2 yellow local column two news-section clear-none" data-sec="2">
		
		<header class="section-header"><span class="section-title">Local</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
		
			<aside class="section-side column two">
				
			<ul>
				<li>Pullman</li>
				<li>Vancouver</li>
				<li>Spokane</li>
				<li>Tricities</li>
				<li>Everett</li>
				<hr>
				<li>Extension</li>
				<li>Global Campus</li>
				<hr>
				<li>Hometown</li>
			</ul>
			
			</aside>
			
			<div class="articles column one">
		
		<?php
		
			$articles_campuses = array(
				'posts_per_page'   => 5,
				'category_name'         => 'wsu-spokane-news, wsu-tri-cities-news, wsu-vancouver-news, wsu-everett-news, wsu-extension-news',
				//'tag'			   => 'featured',
				'post_status'      => 'publish',
			);
				
			$articles = new WP_Query( $articles_campuses );
			
			while ( $articles->have_posts() ) : $articles->the_post();
		
				get_template_part( 'articles/post', get_post_type() );
		
			endwhile;
			
			wp_reset_postdata();
		?>
		
		</div><!--/ articles -->
		
		</div><!--/ nest -->
	
	</section>
	
	<section id="blue" class="section sec-3 blue students column three news-section clear-none" data-sec="3">
		
		<header class="section-header"><span class="section-title">Press</span></header>
		
		<div class="enclosure row margin-right equalize reverse">
			
		
		<aside class="section-side column two">
			
		<ul>
			<li>WSU In the Media</li>
			<li>Press Releases</li>
		</ul>
		
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
		
		wp_reset_postdata();?>
		
		</div><!--/ articles -->
		
		</div><!--/ nest -->
	
	</section>
	
	<section id="orange" class="section sec-4 orange alumni column four news-section clear-none" data-sec="4">
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
	
	<section id="staff" class="section sec-5 green staff column five news-section clear-none" data-sec="5">
	
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
	
	<section id="photo" class="section sec-6 gray-darkest photo gray-darkest-back photo column five news-section clear-none unbound recto unequaled" data-sec="6">
	
		<header class="section-header"><span class="section-title">Photo</span></header>
		
		<div class="enclosure row margin-right equalize xreverse">
		
		<div class="articles column one">
	
		<?php
		
		$posts_staff = array(
			'posts_per_page'   => 1,
			'category_name'         => 'photo',
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

</div><!-- /sections -->