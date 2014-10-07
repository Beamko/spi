<?php


$context = Timber::get_context();
$posts = Timber::get_posts();
$context['posts'] = $posts;
$context['search_term'] = esc_attr(get_search_query());

 Timber::render('search.twig', $context);
?>