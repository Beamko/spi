<?php
/*
 Template Name: Library Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$library_section_fields = $post->get_field('library_sections');

$library_sections = array();

foreach ($library_section_fields as $section){
    $library_sections[] = new TimberPost($section['library_section']->ID);
}

$context['library_sections'] = $library_sections;

Timber::render('library.twig', $context);


?>