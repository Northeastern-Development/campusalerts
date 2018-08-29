<?php
  /**
   * Template Name: Alerts

   * the default return will be XML

   * option to return: JSON or formatted HTML

   */



   // let's figure out if a specific campus has been requested, and set a filter accordingly
   $filter = '';
   if(isset($_GET['campus']) && $_GET['campus'] != ''){
     $filter = $_GET['campus'];
   }

   // set up some variables that will be used regardless of return type
   $blogName = get_bloginfo( 'name' );
   $blogURL = home_url().(isset($filter) && $filter != ""?'/campus/'.$filter:'');
   $buildDate = mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false);
   $updatePeriod = apply_filters( 'rss_update_period', 'hourly' );
   $updateFreq = apply_filters( 'rss_update_frequency', '1' );

   // set the default output error message
   $output = 'No current alerts.';

  // let's grab the data for any active alerts
  $args = array(
 		 "post_type" => "nualerts"
 		,'meta_query' => array(
 			 'relation' => 'AND'
 			,array("key"=>"active","value"=>"1",""=>"=")
 		)
 	);

 	$posts = query_posts($args);


  // this function will gather up all of the campuses for a specific alert and return a comma separated string
  function getCampuses($a){
    $return = "";
    foreach($a as $c){
      $return .= ($return != ""?", ":"").$c->post_title;
    }
    return $return;
  }


  // build the actual alerts records to be returned in the output
  function buildAlerts($a,$b){

    $i = 0;

    $return = '';

    while(have_posts()) : the_post();

      if($filter == '' || ($filter != '' && strpos(strtolower($campus),strtolower($filter)) !== false)){

        $fields = get_fields();

        if($a == 'xml'){ // XML
          $return .= sprintf(
            $b
            ,$i
            ,get_the_title()
            ,get_the_excerpt()
            ,$fields['effective_date']
            ,$campus
            ,get_permalink()
            ,$i
          );
        }else if($a == 'json'){ // JSON
          $return .= sprintf(
            $b
            ,($i > 0?',':'')
            ,$i
            ,get_the_title()
            ,addslashes(get_the_excerpt())
            ,$fields['effective_date']
            ,$campus
            ,get_permalink()
          );
        }

        $i++;
      }

    endwhile;

    return $return;
  }



  if(count($posts) > 0){

    if(!isset($_GET['type']) || $_GET['type'] == '' || $_GET['type'] == 'xml'){ // this will be the default XMl return type

      $xml = '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?><rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" '.do_action('rss2_ns').'>';

      $guide = '<channel><title>%sCampus Alerts Feed</title><atom:link href="%s" rel="self" type="application/rss+xml" /><link>%s</link><description>A feed of Northeastern University System %scampus alerts, managed and maintained by the Office of External Affairs - marketing@northeastern.edu</description><lastBuildDate>%s</lastBuildDate><language>US:EN</language><sy:updatePeriod>%s</sy:updatePeriod><sy:updateFrequency>%s</sy:updateFrequency><items>';

      $xml .= sprintf(
        $guide
        ,$blogName.' - '.(isset($filter) && $filter != ""?ucwords($filter).' ':'')
        ,$blogURL
        ,$blogURL
        ,(isset($filter) && $filter != ""?ucwords($filter).' ':'')
        ,$buildDate
        ,$updatePeriod
        ,$updateFreq
      );

      $guide = '<item-%s><title>%s</title><description>%s</description><effective>%s</effective><campuses>%s</campuses><link>%s</link></item-%s>';

      $xml .= buildAlerts('xml',$guide);

      $xml .= '</items></channel></rss>';

      $output = $xml;


    }else if(isset($_GET['type']) && $_GET['type'] == 'json'){

      $guide = '{"title":"%s","link":"%s","language":"US:EN","lastBuildDate":"%s","sy:updatePeriod":"%s","sy:updateFrequency":"%s","description":"A feed of Northeastern University System %scampus alerts, managed and maintained by the Office of External Affairs - marketing@northeastern.edu","items":{';

      $json = sprintf(
        $guide
        ,$blogName.' - '.(isset($filter) && $filter != ""?ucwords($filter).' ':'').'Campus Alerts Feed'
        ,$blogURL
        ,$buildDate
        ,$updatePeriod
        ,$updateFreq
        ,(isset($filter) && $filter != ""?ucwords($filter).' ':'')
      );

      $guide = '%s"%s":{"title":"%s","description":"%s","effective":"%s","campuses":"%s","link":"%s"}';

      $json .= buildAlerts('json',$guide);

      $json .= '}}';

      $output = $json;
    }else if(isset($_GET['type']) && $_GET['type'] == 'html'){
      $output = 'this will return full HTML';
    }
  }

  // echo the output that was requested, or the default error if there is no content
  echo $output;
?>
