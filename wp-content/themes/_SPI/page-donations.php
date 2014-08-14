<?php
/*
 Template Name: Donations Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render('donations.twig', $context);

?>