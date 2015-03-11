
<?php 

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
); ?>

<nav class="paging">
	<?php echo paginate_links( $paging ); ?>
</nav>