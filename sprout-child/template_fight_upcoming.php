<?php
/*
Template Name: Up Coming Fights
*/

$paged = vw_get_paged();
$currentDate = date('Ymd');
$args = array(

    'post_type' 		=> 'fight_events',
    'meta_key' 	=> 'event_date',
    'orderby'			=> 'meta_value',
	'meta_query'		=> array(
		'relation'		=> 'AND',
		array(
			'key'		=> 'event_results_completed',
			'value'		=> true,
			'compare'	=> 'NOT LIKE'
		),
		//hides non major orginizations
		array(
			'key'		=> 'event_organization',
			'value'		=> 'other',
			'compare'	=> 'NOT LIKE'
		),
		array(
			'key'		=> 'event_date',
			'value'		=> $currentDate,
			'compare'	=> '>',
			'type'		=> 'NUMERIC'
		),
	),
	
	'order' 			=> 'ASC',		    
    'post_status' 		=> 'publish',
    'posts_per_page'	=> 10,
	'paged' 			=> $paged

  );

	$result_loop = new WP_Query( $args );
	do_action( 'vw_action_before_single_post' ); 

      // Output

       require_once get_stylesheet_directory().'/templates/content-events.php';

?>
