<?php

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;
$context['comment_count'] = get_comments_number();
$context['wp_title'] .= ' - ' . $post->title();
$context['categories'] = get_the_category();

$context['comment_form'] = TimberHelper::get_comment_form();

if (post_password_required($post->ID)){
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
}

?>