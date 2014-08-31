<?php

$context = Timber::get_context();
$context['events'] = Timber::get_post(34);

$context['posts'] = Timber::get_posts();

foreach ($context['posts'] as $post){
	$date_only = 'yymmdd';
	$time_only = 'h:ia';
	$display_format = 'l, F j, Y h:ia';

	$start_date = $post->get_field('start_date');
	$context['start_date'] =  date_i18n( $display_format, $start_date );

	$end_date = $post->get_field('end_date');
	if (date_i18n( $date_only, $end_date ) ==  date_i18n( $date_only, $start_date )) {
	  $context['end_date'] = date_i18n( $time_only, $end_date );
	} else {
	  $context['end_date'] = date_i18n( $display_format, $end_date );
	}
}

Timber::render('events.twig', $context);

?>