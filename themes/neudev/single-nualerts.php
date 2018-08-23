<?php

/*
	Template Name: NUAlerts
	Template Post Type: nualerts
*/

	get_header();



?>

	<main id="nu__static" role="main" aria-label="content">

		<!-- <section class="hero">
			<div>
				<h2>University Updates</h2>

			</div>
		</section> -->


		<section class="intro">
			<button onclick="goBack()" title="Click here to return to the previous page">Go Back</button><br>

			<h1><?php the_title(); ?>: <?php the_date(); ?> <?php the_time(); ?></h1>
		</section>
		<section>

			<?php the_content(); ?>

		</section>

		<section class="last">
			<a href="http://www.northeastern.edu/emergency-information" target="_blank" rel="noopener" title="Click here for more emergency information">Click here for more emergency information</a>
		</section>

	</main>
<?php get_footer(); ?>
