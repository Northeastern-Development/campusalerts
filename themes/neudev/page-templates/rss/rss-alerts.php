<?php
  /**
   * Template Name: Alerts
   */

   // are we looking for a specific campus worth of alerts?
   $filter = (isset($_GET['campus']) && $_GET['campus'] != ''?strtolower($_GET['campus']):'');

   $args = array(
 		 "post_type" => "nualerts"
 		,'meta_query' => array(
 			 'relation' => 'AND'
 			,array("key"=>"active","value"=>"1",""=>"=")
      ,'campus_clause' => (isset($filter) && $filter != ''?array("key"=>"affected_campus","value"=>ucwords(str_replace('-',' ',$filter)),"compare"=>"="):array("key"=>"affected_campus","compare"=>"EXISTS"))
 		)
    ,
    'orderby' => array(
      'campus_clause' => 'ASC',
    )
 	);

 	$posts = query_posts($args);

  echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" <?php do_action('rss2_ns'); ?>>
  <channel>
    <title><?php bloginfo_rss('name'); ?></title>
    <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
    <link><?php bloginfo_rss('url'); ?></link>
    <description>A feed of Northeastern University System campus alerts, managed and maintained by the Office of External Affairs - marketing@northeastern.edu</description>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <language>en-us</language>
    <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
    <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
    <items>
    <?php $i = 0; while(have_posts()) : the_post(); $fields = get_fields(); ?>
    <item-<?=$i?>>
          <title><?=get_the_title()?></title>
          <description><?=get_the_excerpt()?></description>
          <effective><?=$fields['effective_date']?></effective>
          <campus><?=$fields['affected_campus']?></campus>
          <link><?=get_permalink()?></link>
        </item-<?=$i?>>
    <?php $i++;  endwhile; ?>
  </items>
</channel>
</rss>
