


<?php

//function getAlerts(){

  //wp_reset_postdata();
	wp_reset_query();


if($filter == ''){
  $args = array(
		 "post_type" => "nualerts"
		,'meta_query' => array(
			 'relation' => 'AND'
			,array("key"=>"active","value"=>"1",""=>"=")
		)
	);



	$alerts = query_posts($args);
	//print_r($alerts);
	//die();

	$response = "";	// an empty return will collapse the alert area to nothing

	if(count($alerts) > 0){	// we found a result, let's build out the list
		$response .= "<div><h2>University Alert!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>";

    foreach($alerts as $a){

			$fields = get_fields($a->ID);

			$guide = '<li><a href="%s" title="%s, read more">%s For: <span>%s</span> - %s - Read More</a></li>';


			$campus = "";
			foreach($fields['affected_campus'] as $c){
				$campus .= ($campus != ""?", ":"").$c->post_title;
			}


      $response .= sprintf(
				 $guide
				 ,$a->guid
				,$a->post_title
				,$a->post_title
				,$campus
				,$a->post_excerpt

			);

  }

		$response .= "</ul></div>";
}
echo $response;

}else {

	$args = array(
		 "post_type" => "nualerts",
		 'meta_query' => array(
			 'relation' => 'AND',
			 array("key"=>"active","value"=>"1","compare"=>"=")
		)
	);

	$res = query_posts($args);
	//print_r($res);



	$response = "";	// an empty return will collapse the alert area to nothing

	if(count($res) > 0){

			foreach($res as $r){
				$fields = get_fields($r->ID);
				//print_r($fields);

				$affected_campus = $fields['affected_campus'][0]->post_name;
				$campus = $affected_campus;
				//echo($campus);
				//echo '<br>';
				//echo($filter);

				$thisCampus = "";
				//TRYING TO SET UP AN ALERT IF A CAMPUS HAS NO ALERTS
				
				// print_r($filter);
				//
				// if(count($filter) > 1){
				// 	echo '<div><h2>There are no University Alerts for '.ucwords(strtolower($filter)).' at this time</h2></div>';
				//
				// }

				if($campus == $filter){

					$response .= "<div><h2>University Alert!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>";

					$guide = '<li><a href="%s" title="%s, read more">%s For: <span>%s</span> - %s - Read More</a></li>';

					foreach($fields['affected_campus'] as $c){
						$thisCampus .= ($thisCampus != ""?", ":"").$c->post_title;
					}

					$response .= sprintf(
						 $guide
						 ,$r->guid
						 ,$r->post_title
						 ,$r->post_title
						 ,$thisCampus
						 ,$r->post_excerpt
					);
				}
				$response .= "</ul></div>";
			}
			echo($response);
	}


}



?>
