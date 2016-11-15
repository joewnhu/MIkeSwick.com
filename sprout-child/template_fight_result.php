<?php
/*
Template Name: Fight Results
*/
 ?>

<?php
		 

	$paged = vw_get_paged();

	$args = array(

	    'post_type' 		=> 'fight_events',
	    'meta_sort_key' 	=> 'event_date',
	    'orderby'			=> 'meta_sort_key',
		'meta_query'		=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'event_results_completed',
				'value'		=> true,
				'compare'	=> 'LIKE'
			)/*,
			//hides non major orginizations
			array(
				'key'		=> 'event_organization',
				'value'		=> 'other',
				'compare'	=> 'NOT LIKE'
			)*/
		),
		
		'order' => 'ASC',		    
	    'post_status' => 'publish',
	    'posts_per_page' => 10,
	    'paged' => $paged

	);

  $result_loop = new WP_Query( $args );
  do_action( 'vw_action_before_single_post' ); 

      // Output

      require_once get_stylesheet_directory().'/templates/content-events.php';
      
?>
