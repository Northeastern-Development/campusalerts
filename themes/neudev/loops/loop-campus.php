


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

			$guide = '<li><a href="%s" title="%s, read more">%s For: %s - %s - Read More</a></li>';


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

	// echo($filter);
	// echo '<br>';

	$args = array(
		 "post_type" => "nualerts",
		 'meta_query' => array(
			 'relation' => 'AND',
			 array("key"=>"active","value"=>"1","compare"=>"=")
		)
	);

	$res = query_posts($args);
	//print_r($res);

	$affected_campus = get_fields($res[0]->ID)['affected_campus'];


	$response = "";	// an empty return will collapse the alert area to nothing

	//$campus = ;



	if(count($res) > 0){
		// echo($filter);
		// echo '<br>';
			$response .= "<div><h2>University Alert!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><ul>";


		foreach($res as $r){
			$fields = get_fields($r->ID);
			print_r($fields);

			// $guide = '<li><a href="%s" title="%s, read more">%s For: %s - %s - Read More</a></li>';

			$campus = "";
			//$affected_campus = "";
			//echo($response);

			//echo $fields['affected_campus'][0]->post_name;

			if($fields['affected_campus'] == $affected_campus){
				$affected_campus = $fields['affected_campus'][0]->post_name;
				$campuses = $affected_campus;
				print_r($campuses);



				$guide = '<li><a href="%s" title="%s, read more">%s For: %s - %s - Read More</a></li>';

				foreach($fields['affected_campus'] as $c){
					$campus .= ($campus != ""?", ":"").$c->post_name;
					//print_r($campus);
				}
				//print_r($filter);
				//print_r($affected_campus);

				$response .= sprintf(
					 $guide
					 ,$r->guid
					,$r->post_title
					,$r->post_title
					,$campus
					,$r->post_excerpt

				);

				if($campus == $filter){
					echo($response);
				}


			}

		$response .= "</ul></div>";
		}

	}

	// $thisCampus = query_posts($args);
	// $thisCampusFields = get_fields($thisCampus[0]->ID);

	//print_r($thisCampus);





}


?>
