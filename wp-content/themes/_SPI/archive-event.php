<?php

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
}

Timber::render('events.twig', $context);

?>