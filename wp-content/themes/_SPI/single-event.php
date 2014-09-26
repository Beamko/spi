<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;


// Format ticket cost
$ticket_cost = $post->get_field('ticket_cost');

if ($ticket_cost) {
	$post->ticket_cost = number_format((float)$ticket_cost, 2, '.', '');
}


// Date Format
$date_only = 'yymmdd';
$year_month = 'yymm';
$year_only = 'Y';
$month_and_date_only = 'M. j';
$date_and_year_only = 'j, Y';
$time_only = 'h:ia';
$display_format = 'M. j, Y';

$post->one_day = false;
$post->reoccurs = false;
$post->all_day_event = true;

if (!eo_is_all_day()) {
	$post->all_day_event = false;
	$post->start_time = eo_get_the_start($time_only);
	$post->end_time = eo_get_the_end($time_only);
}

if (eo_reoccurs()) {
	// If recurring event
	$post->reoccurs = true;
	if (eo_get_schedule_start($year_only) == eo_get_schedule_end($year_only)) {
		$post->start_date =  eo_get_schedule_start($month_and_date_only);
  	$post->end_date = eo_get_schedule_last($display_format);
	} else {
		$post->start_date =  eo_get_schedule_start($display_format);
  	$post->end_date = eo_get_schedule_last($display_format);
	}

} else if (eo_get_the_end($date_only) ==  eo_get_the_start($date_only)) {
	// If one-day event
  $post->one_day = true;
  $post->event_date =  eo_get_the_start($display_format);

} else if (eo_get_the_end($year_month) == eo_get_the_start($year_month)) {
	// If same month and year
  $post->start_date =  eo_get_the_start($month_and_date_only);
  $post->end_date = eo_get_the_end($date_and_year_only);

} else if (eo_get_the_end($year_only) == eo_get_the_start($year_only)) {
	// If same year
  $post->start_date =  eo_get_the_start($month_and_date_only);
  $post->end_date = eo_get_the_end($display_format);

} else {
  $post->start_date = eo_get_the_start($display_format);
  $post->end_date = eo_get_the_end($display_format);
}


Timber::render('event.twig', $context);

?>