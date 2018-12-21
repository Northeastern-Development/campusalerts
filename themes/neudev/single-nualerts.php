<?php

/*
	Template Name: NUAlerts
	Template Post Type: nualerts
*/

	get_header();

	$post = get_post();

	$fields = get_fields($post->ID);

?>

	<main id="nu__static" role="main" aria-label="content">

		<section class="intro">
			<button onclick="goBack()" title="Click here to return to the previous page">Go Back</button><br>

			<h1><?=$post->post_title?>: <?=$fields['effective_date']?></h1>
		</section>
		<section>

			<?=$post->post_content?>

		</section>

		<section class="last">
			<a href="http://www.northeastern.edu/emergency-information" target="_blank" rel="noopener" title="Click here for more emergency information">Click here for more emergency information</a>
		</section>

	</main>
<?php get_footer(); ?>
