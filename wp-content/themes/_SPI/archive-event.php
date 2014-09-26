<?php
	global $wp_query;

	//Get events
	$query_args = array(
		'posts_per_page' => -1,
		'orderby'	=> 'eventend',
		'order' => 'DESC',
		'post_type' => 'event'
	);

$wp_query = new WP_Query($query_args);

$context = Timber::get_context();
$context['events'] = Timber::get_post(34);

$context['posts'] = Timber::get_posts();

foreach ($context['posts'] as $post){
	$date_only = 'yymmdd';
	$year_month = 'yymm';
	$month_and_date_only = 'F j';
	$date_and_year_only = 'j, Y';
	$year_only = 'Y';
	$display_format = 'F j, Y';

	$current_time = time();

	$post->one_day = false;
	$post->reoccurs = false;

	if (eo_reoccurs()) {
		$post->reoccurs = true;

	} else if ( eo_get_the_end($date_only) ==  eo_get_the_start($date_only) ) {
		// If one-day event
	  $post->one_day = true;
	  $post->start_date =  eo_get_the_start($display_format);

	} elseif (eo_get_the_end($year_month) == eo_get_the_start($year_month)) {
		// If same month and year
	  $post->start_date =  eo_get_the_start($month_and_date_only);
	  $post->end_date = eo_get_the_end($date_and_year_only);

	} elseif (eo_get_the_end($year_only) == eo_get_the_start($year_only)) {
		// If same year
	  $post->start_date =  eo_get_the_start($month_and_date_only);
	  $post->end_date = eo_get_the_end($display_format);

	} else {
	  $post->start_date =  eo_get_the_start($display_format);
	  $post->end_date = eo_get_the_end($display_format);
	}


// Set Classes for filtering events
	$post->status  = '';
	if ( $current_time > eo_get_the_start('U') and  $current_time < eo_get_the_end('U')){
		$post->status .= 'js-ongoing '; 
	}

	if ($current_time < eo_get_the_end('U')){
		$post->status .= 'js-upcoming '; 
	}

	if ($current_time > eo_get_the_end('U')){
		$post->status .= 'js-past '; 
	}
}

Timber::render('events.twig', $context);

?>