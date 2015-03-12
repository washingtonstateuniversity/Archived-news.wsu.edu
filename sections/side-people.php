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