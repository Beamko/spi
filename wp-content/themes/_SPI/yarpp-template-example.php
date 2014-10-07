<?php 
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>
<?php if (have_posts()):?>
<h3 class="h2">Related Posts</h3>
<ol>
	<?php while (have_posts()) : the_post(); ?>
	<li>
		<span><?php the_author(); ?></span>
		<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
		<span><?php the_date(); ?></span>
	</li>
	<?php endwhile; ?>
</ol>
<?php endif; ?>
