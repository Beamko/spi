<?php
	global $wp_query;

	//Get events
	$query_args = array(
		'posts_per_page' => -1,
		'meta_key' => 'start_date',
		'orderby'	=> 'meta_value_num',
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
	$display_format = 'F j, Y';

	$start_date = $post->get_field('start_date');
	$end_date = $post->get_field('end_date');
	$current_time = time();

	if (date_i18n( $date_only, $end_date ) ==  date_i18n( $date_only, $start_date )) {
		// If same date
	  $post->start_date =  date_i18n( $month_and_date_only, $start_date );
	  $post->end_date = date_i18n( $date_and_year_only, $end_date );
	} elseif (date_i18n( $year_month, $end_date ) ==  date_i18n( $year_month, $start_date )) {
		// If same month and year
	  $post->start_date =  date_i18n( $month_and_date_only, $start_date );
	  $post->end_date = date_i18n( $date_and_year_only, $end_date );
	} else {
	  $post->end_date = date_i18n( $display_format, $end_date );
	  $post->start_date =  date_i18n( $display_format, $start_date );
	}

	$post->status  = '';
	if ($post->get_field('repeat_event') === 'Yes'){
		$post->status .= 'js-ongoing '; 
	}

	if ($current_time < $end_date){
		$post->status .= 'js-upcoming '; 
	}

	if ($current_time > $end_date){
		$post->status .= 'js-past '; 
	}
}

Timber::render('events.twig', $context);

?>