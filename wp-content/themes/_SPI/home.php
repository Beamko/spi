<?php
/*
 Template Name: Blog Posts
*/

$context = array();
$context['blog'] = Timber::get_post(527);

$posts = Timber::get_posts();

$posts['author'] = get_the_author();



$context['posts'] = $posts;

Timber::render('blog-listing.twig', $context);


?>