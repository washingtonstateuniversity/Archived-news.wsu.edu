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
		
		<?php /*
			
			echo "<ul>";
			
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
		    
		    echo "</ul>";
		*/ ?>
		
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
				'tag'				=> 'popular, popular-story',
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