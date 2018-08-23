


<?php

//function getAlerts(){

  //wp_reset_postdata();
	wp_reset_query();


if($filter == ''){
  $args = array(
		 "post_type" => "nualerts",
		 'meta_query' => array(
			 'relation' => 'AND'
			,array("key"=>"active","value"=>"1",""=>"=")
		)
	);



	$alerts = query_posts($args);
	//print_r($alerts);
	//die();

	$response = "";	// an empty return will collapse the alert area to nothing
	//$campusgroup = "";



	if(count($alerts) > 0){	// we found a result, let's build out the list
		$response .= "<div><h2>University Alert!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>";



		// foreach($alerts as $g){
		// 	$location = get_fields($g->ID);
		// 	//print_r($location);
		//
		// 	$group = "";
		// 	foreach($location['affected_campus'] as $c){
		// 		$group .= ($group != ""?", ":"").$c->post_title;
		// 		//print_r($campus);
		//
		// 	}
		//
		// 	 echo $group;
		// }





    foreach($alerts as $a){

			$fields = get_fields($a->ID);
			//print_r($fields);



			// $campus = "";
			// 	$response .= "<h2>";
			// foreach($fields['affected_campus'] as $g){
			// 	$campus .= ($campus != ""?", ":"").$g->post_title;
			// 	$response .= "</h2>";
			//
			// }

			//$group = '<h2>%s</h2>';
			$guide = '<li><a href="%s" title="%s, read more">%s For: <span>%s</span> - %s - Read More</a></li>';


			$campus = "";
			foreach($fields['affected_campus'] as $c){
				$campus .= ($campus != ""?", ":"").$c->post_title;
				//print_r($campus);

			}

			//echo $campus;

			// echo $campus;

			// $campusgroup .= sprintf(
			// 	 $group
			// 	,$campus
			// );


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
		//END FOREACH



}
//echo $campusgroup;

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

	//echo 'fdasfasd';

	$response = "";	// an empty return will collapse the alert area to nothing

	if(count($res) > 0){

		echo '<div><h2>Northeastern University Campus: '.ucwords(strtolower($filter)).' Alert(s)!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>';

		//$response .= "<div><h2>Northeastern University Alert!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>";

	 $guide = '<li><a href="%s" title="%s, read more">%s For: <span>%s</span> - %s - Read More</a></li>';

			foreach($res as $r){
				$fields = get_fields($r->ID);


				$affected_campus = $fields['affected_campus'][0]->post_name;
				$campus = $affected_campus;

				//echo '<br>';
				//echo($filter);

				//$thisCampus = "";
				//TRYING TO SET UP AN ALERT IF A CAMPUS HAS NO ALERTS

				// print_r($filter);
				//
				// if($campus !==  $filter){
				// 	echo '<div><h2>There are no University Alerts for '.ucwords(strtolower($filter)).' at this time</h2></div>';
				//
				// }

				if($campus == $filter){


					$campus = "";
					foreach($fields['affected_campus'] as $c){
						$campus .= ($campus != ""?", ":"").$c->post_title;
						//print_r($campus);

					}

					$response .= sprintf(
						 $guide
						 ,$r->guid
						 ,$r->post_title
						 ,$r->post_title
						 ,$campus
						 ,$r->post_excerpt
					);
				}

			}

	}
	$response .= "</ul></div>";
	echo($response);
}

// wp_reset_postdata();
//wp_reset_query();


?>
