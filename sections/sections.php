<?php
	
	$news_section = wsunews_get_section();
	$news_section_link = '<a href="/'.$news_section.'/">View all stories in '.ucfirst($news_section).'</a>';
	$exclude_photos = ( ( defined( 'WSU_LOCAL_CONFIG' ) && true === WSU_LOCAL_CONFIG ) ) ? "499" : "13026";
	//if ( !is_single() ) { $story = "articles/story-before"; } else { $story = "articles/story"; }  
	if ( !is_single() ) { $layout = "margin-right"; } else { $layout = "single"; }
	
	function section_link($section) {
		if ( $section == "" ) { $section = "cover"; }
		echo '<a href="/'.$section.'/" class="section-link">Go to '.ucfirst($section).' Section</a>';
		} 
	
?>

<div class="sections row <?php echo $layout; ?>">
	
	<div class="column one fluid equalize">

	<section id="crimson" class="section crimson featured news-section nested <?php echo ( $news_section == "cover" ? "opened current" : "not-current" ); ?>" data-sec="1">
		
		<header class="section-header"><span class="rotate"><span class="section-title">Featured</span></span></header>
		
		<div class="enclosure row <?php echo $layout; ?> equalize equalize-medium">
		
		<?php if ( !is_single() ) : ?>
		<aside class="section-side column two">
		
			<?php if ( is_active_sidebar( 'side-cover' ) ) { dynamic_sidebar( 'side-cover' ); } ?>
		
		</aside>
		<?php endif; ?>
		
		<div class="articles lead column one">
			
			<?php if ( !is_paged() ) : ?>
			
			<?php if ( !is_single() ) : ?>
			
				<?php
				
				$posts_featured = array(
					'posts_per_page'   => 1,
					'category__not_in' => array(473),
					'category_name'	   => 'top-stories',
					'tag__not_in'		=> array($exclude_photos),
				);
			
				$articles = new WP_Query( $posts_featured );
				
				while ( $articles->have_posts() ) : $articles->the_post();
			
					get_template_part( 'articles/story-before', get_post_type() );
			
				endwhile;
				
				wp_reset_postdata();
					
				?>
			 
			<?php include(locate_template('sections/section-cover-today.php')); ?>
			
			<?php endif; ?>
			
			<?php endif; ?>
			
			<?php include(locate_template('sections/section-cover.php')); ?>
	 
		</div><!--/ articles -->
		
		</div><!--/ enclosure -->
		
	</section>
	
	<section id="yellow" class="section yellow local news-section <?php echo ( $news_section == "campuses" ? "opened current" : "not-current" ); ?>" data-sec="2">
		
		<header class="section-header"><span class="rotate"><span class="section-title">Local</span></span></header>
		
		<div class="enclosure row <?php echo $layout; ?> equalize equalize-medium">
		
			<?php if ( !is_single() ) : ?>
			<aside class="section-side column two">
				
				<?php if ( is_active_sidebar( 'side-local' ) ) { dynamic_sidebar( 'side-local' ); } ?>
			
			</aside>
			<?php endif; ?>
			
			<div class="articles column one">

				<?php include(locate_template('sections/section-local.php')); ?>

			</div><!--/ .column.one articles -->
		
		</div><!--/ nest -->
		
	</section>
	
	<section id="people" class="section green people news-section <?php echo ( $news_section == "people" ? "opened current" : "not-current" ); ?>" data-sec="3">
	
		<header class="section-header"><span class="rotate"><span class="section-title">People</span></span></header>
		
		<div class="enclosure row <?php echo $layout; ?> equalize equalize-medium">
		
		<?php if ( !is_single() ) : ?>
		<aside class="section-side column two">
			
			<?php if ( is_active_sidebar( 'side-people' ) ) { dynamic_sidebar( 'side-people' ); } ?>
		
		</aside>
		<?php endif; ?>
		
		<div class="articles column one">
	
			<?php include(locate_template('sections/section-people.php')); ?>
	 
		</div>
		
		</div><!--/ nest -->
	
	</section>
	
	<section class="section orange athletics news-section <?php echo ( $news_section == "athletics" ? "opened current" : "not-current" ); ?>" data-sec="4">
		
		<header class="section-header"><span class="rotate"><span class="section-title">Athletics</span></span></header>
		
		<div class="enclosure row <?php echo $layout; ?> equalize equalize-medium">
			
		<?php if ( !is_single() ) : ?>
		<aside class="section-side column two">
			
			<?php if ( is_active_sidebar( 'side-athletics' ) ) { dynamic_sidebar( 'side-athletics' ); } ?>
		
		</aside>
		<?php endif; ?>
		
		<div class="articles column one">
			
			<?php include(locate_template('sections/section-athletics.php')); ?>
		
		</div><!--/ articles -->
		
		</div><!--/ nest -->
	
	</section>
	
	<section class="section column blue events news-section <?php echo ( $news_section == "events" ? "opened current" : "not-current" ); ?>" data-sec="5">
		<header class="section-header"><span class="rotate"><span class="section-title">Events</span></span></header>
		
		<div class="enclosure row <?php echo $layout; ?> equalize equalize-medium">
		
		<?php if ( !is_single() ) : ?>
		<aside class="section-side column two">
			
			<?php if ( is_active_sidebar( 'side-events' ) ) { dynamic_sidebar( 'side-events' ); } ?>
			<?php include(locate_template('sections/side-events.php')); ?>
		
		</aside>
		<?php endif; ?>
		
		<div class="column one articles">
		
			<?php include(locate_template('sections/section-events.php')); ?>
	
		</div>
		
		</div><!-- /encolure -->
	
	</section>
	
	<?php if ( !is_single() ) : ?>
	<section id="photo" class="section gray-darkest photo gray-darkest-back photo column news-section unbound recto" data-sec="6">
	
		<header class="section-header"><span class="position"><span class="rotate"><span class="section-title">Photo</span></span></span></header>
	
		<?php include(locate_template('sections/section-photo.php')); ?>
	 
	</section>
	<?php endif; ?>
	
	</div><!-- /.column.one -->

	<div class="section-tabs">	
		<div class="section-tab blue" data-sec="5"><span class="rotate"><span class="section-title">Events</span></span></div>
		<div class="section-tab orange" data-sec="4"><span class="rotate"><span class="section-title">Athletics</span></span></div>
		<div class="section-tab green" data-sec="3"><span class="rotate"><span class="section-title">People</span></span></div>
		<div class="section-tab yellow" data-sec="2"><span class="rotate"><span class="section-title">Locales</span></span></div>
		<div class="section-tab crimson" data-sec="1"><span class="rotate"><span class="section-title">Featured</span></span></div>
	</div>
	
</div><!-- /sections -->



