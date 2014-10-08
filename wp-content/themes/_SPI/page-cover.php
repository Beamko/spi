<?php
/*
 Template Name: Cover Page
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['featured_item'] = $post->get_field('featured_item');

$user_id = $context['featured_item']->post_author;

if ( get_userdata(1)->display_name ) {
	$context['author_name'] = 'by ' . get_userdata($user_id)->display_name;
}

$context['post'] = $post;

Timber::render('cover.twig', $context);

?>