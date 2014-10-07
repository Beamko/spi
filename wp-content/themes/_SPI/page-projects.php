<?php
/*
 Template Name: Projects Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$project_section_fields = $post->get_field('projects_sections');

$project_sections = array();

foreach ($project_section_fields as $section) {
  $project_sections[] = new TimberPost($section['project_section']->ID);
}

$context['project_sections'] = $project_sections;

Timber::render('projects.twig', $context);

?>