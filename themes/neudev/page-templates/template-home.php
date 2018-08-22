<?php /* Template Name: Home Page Template */ get_header();

wp_reset_query();

$fChk = $wp_query->query_vars['hptesting'];
$filter = (isset($fChk) && $fChk != ''?$fChk:'');
//die('FILTER = '.$filter);


 ?>
	<main role="main" aria-label="Content">
		<!-- section -->
		<section>
			<?php include(locate_template('loops/loop-campus.php')); ?>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
