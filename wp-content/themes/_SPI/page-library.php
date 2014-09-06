<?php
/*
 Template Name: Library Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render('library.twig', $context);

?>