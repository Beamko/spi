<?php


$context = Timber::get_context();
$posts = Timber::get_posts();
$context['posts'] = $posts;

 Timber::render('search.twig', $context);
?>