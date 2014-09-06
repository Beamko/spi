<?php
/*
 Template Name: Cover Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// $context['featured_post'] = new TimberPost($post->get_field('featured_post')->ID);

Timber::render('cover.twig', $context);

?>