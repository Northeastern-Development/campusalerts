<?php

  wp_reset_query(); // clear any existing query to make sure we are getting what we really want

  $args = array(
		 "post_type" => "nualerts",
		 'meta_query' => array(
			 'relation' => 'AND'
			,array("key"=>"active","value"=>"1",""=>"=")
      ,'campus_clause' => (isset($filter) && $filter != ''?array("key"=>"affected_campus","value"=>ucwords(str_replace('-',' ',$filter)),"compare"=>"="):array("key"=>"affected_campus","compare"=>"EXISTS"))
		),
    'orderby' => array(
      'campus_clause' => 'ASC',
    )
	);
	$res = query_posts($args);

  // set the default content that there are no alerts
	$response = '<div><h2>No Active Alerts</h2><p>The Northeastern University'.(isset($filter) && $filter != ''?' '.ucwords(strtolower(str_replace('-',' ',$filter))).' campus':' System').' has issued no alerts.</p><hr>';

  if(count($res) > 0){	// we found one or more active alerts

		$response = '<div><h2>University Alerts'.(isset($filter) && $filter != ''?' - '.ucwords(strtolower(str_replace('-',' ',$filter))):'').'</h2><p>The Northeastern University'.(isset($filter) && $filter != ''?' '.ucwords(strtolower(str_replace('-',' ',$filter))).' campus':' System').' has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><hr>';

    $guide = '<li><a href="%s" title="%s, read more">%s - Read More </a></li>';

    // no filter was passed, show alerts from all campuses
      if($filter == ''){

        $fields = get_fields($res[0]->ID);
        $cCampus = $fields['affected_campus'];
        $response .= '<h3>'.$cCampus.'</h3>';

      }

      $response .= '<ul>';

      // loop through each result
      foreach($res as $a){

  			$fields = get_fields($a->ID);

        if($filter == '' && $fields['affected_campus'] != $cCampus){
          $cCampus = $fields['affected_campus'];
          $response .= '</ul><h3>'.$cCampus.'</h3><ul>';
        }

        $response .= sprintf(
  				 $guide
  				 ,$a->guid
  				 ,$a->post_title
  				 ,$a->post_title
  				 ,$a->post_excerpt
  			);
    	}
  }

  $response .= "</ul></div>";
  echo($response);

?>
