<!-- Build out the loop for alerts. If we dont enter a campus into the url then it defualts to all (if), (else) contains if campus name is entered into url-->
<?php


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

		$response .= "<div><h2>University Alert(s)!</h2><p>The Northeastern University System has issued the following alert(s).  Please be sure to read any associated information and contact your campus emergency services with any questions.</p><hr><ul>";
    //$campusgroup = '<h2>%s</h2';
		$guide = '<li><a href="%s" title="%s, read more">%s For: <span>%s</span> - %s - Read More</a></li>';


    foreach($alerts as $a){

			$fields = get_fields($a->ID);


			$campus = "";
			foreach($fields['affected_campus'] as $c){
        //$campus .= ($campus != ""?", ":"").$campus;
				$campus .= ($campus != ""?", ":"").$c->post_title;

				print_r($campus);
			}//END FOREACH $FIELDS

      $response .= sprintf(
				 $guide
         //,$campus
				 ,$a->guid
				 ,$a->post_title
				 ,$a->post_title
				 ,$campus
				 ,$a->post_excerpt
			);

  	}//END FOREACH $ALERTS AS $A

	}//END IF COUNT ALERTS > 0

	$response .= "</ul></div>";
	echo($response);

}//END IF FILTER == ''
else {

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
					}//END FOREACH FIELDS

					$response .= sprintf(
						 $guide
						 ,$r->guid
						 ,$r->post_title
						 ,$r->post_title
						 ,$campus
						 ,$r->post_excerpt
					);

				}//END IF $CAMPUS == $FILTER

			}//END FOREACH $RES AS $R

	}//END IF COUNT $RES > 0
	$response .= "</ul></div>";
	echo($response);

}//END else




?>
