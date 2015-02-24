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
			<li>Learning</li>
			<li>Discovery</li>
			<li>Service</li>
			<li>Integrity</li>
		</ul>
		<hr>
		<ul class="crimson-south">
			<li>Four Great Challenges	
				<ul>
					<li>Healthfulness</li>
					<li>Sustainability</li>
					<li>Equal Opportunity</li>
					<li>Infrastructure and Security</li>
				</ul>
			</li>
		</ul>
		<hr>
		<ul class="crimson-south">
			<li>Popular
				<ul>
					<li>Proposed WSU medical college attracts lead gift</li>
					<li>April 4: Free movie aims to inspire, recruit teachers of color</li>
				</ul>
			</li>
		</ul>
		<hr>
		<ul class="crimson-south">
			<li>Just In
				<ul>
					<li>Proposed WSU medical college attracts lead gift</li>
					<li>April 4: Free movie aims to inspire, recruit teachers of color</li>
				</ul>
			</li>
		</ul>
		
		</aside>
		
		<div class="articles column one">
	
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
	 
	 <section id="" class="today-tomorrow">
		 
		 <header>Today</header>
		 
		 <a href="#">
		 <dl class="cf">
			 <dt>
			 	Washington Policy Center’s Young Professionals minimum wage debate
			 	<address>Bryan Hall Theatre, WSU Campus, Pullman, WA</address>
			 </dt>
			 <dd>
			 	<time><span class="hour">8:45</span><span class="oclock">P.M.</span></time>
			 	
			 </dd>
		 </dl>
		 </a>
		 <a href="#">
		 <dl class="cf">
			 <dt>
			 	<span class="series">Lunch & Learn</span>
			 	<span class="title">Interviewing Basics for New Healthcare Professionals</span>
			 	<address>Bryan Hall Theatre, WSU Campus, Pullman, WA</address>
			 </dt>
			 <dd>
			 	<time><span class="hour">6:00</span><span class="oclock">P.M.</span></time>
			 	
			 </dd>
		 </dl>
		 </a>
		 <a href="#">
		 <dl class="cf">
			 <dt>
			 	<a href="">Washington Policy Center’s Young Professionals minimum wage debate</a>
			 	<address>Bryan Hall Theatre, WSU Campus, Pullman, WA</address>
			 </dt>
			 <dd>
			 	<time><span class="hour">2:30</span><span class="oclock">P.M.</span></time>
			 	
			 </dd>
		 </dl>
		 </a>
	 
	 </section>
	 
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