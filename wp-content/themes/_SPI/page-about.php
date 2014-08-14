<?php
/*
 Template Name: About Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$about_section_fields =$post->get_field('about_sections');
$director_fields = $post->get_field('directors');
$member_fields = $post->get_field('members');

$about_sections = array();
$directors = array();
$members = array();

foreach ($about_section_fields as $section){
    $about_sections[] = new TimberPost($section['about_section']->ID);
}

foreach ($director_fields as $item) {
    $directors[] = new TimberPost($item['director']->ID);
}

foreach($member_fields as $item) {
    $members[] = new TimberPost($item['member']->ID);
}

$context['about_sections'] = $about_sections;
$context['directors'] = $directors;
$context['members'] = $members;

 Timber::render('about.twig', $context);
?>