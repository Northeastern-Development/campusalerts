<?php



register_taxonomy_for_object_type('category', 'Campus Alerts'); // Register Taxonomies for Category
register_taxonomy_for_object_type('post_tag', 'Campus Alerts');
register_post_type('nualerts', // Register Custom Post Type
    array(
    'labels' => array(
        'name' => __('Campus Alerts', 'nudev'), // Rename these to suit
        'singular_name' => __('NU Alerts', 'nudev'),
        'add_new' => __('Add New', 'nudev'),
        'add_new_item' => __('Add New', 'nudev'),
        'edit' => __('Edit', 'nudev'),
        'edit_item' => __('Edit', 'nudev'),
        'new_item' => __('New Alert', 'nudev'),
        'view' => __('View Alert', 'nudev'),
        'view_item' => __('View Alert', 'nudev'),
        'search_items' => __('Search NU Alerts', 'nudev'),
        'not_found' => __('No NU Alerts found', 'nudev'),
        'not_found_in_trash' => __('No NU Alerts found in Trash', 'nudev')
    ),
    'public' => true,
    'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
    'has_archive' => false,
    'rewrite' => array(
         'with_front' => false,
        'slug'       => 'campus'
    ),
    'supports' => array(
        'title',
        'editor',
        'excerpt'
        // 'thumbnail'
    ), // Go to Dashboard Custom nudev post for supports
    'can_export' => false, // Allows export in Tools > Export
    // 'taxonomies' => array(
    //   // 'active'
    //     'post_tag',
    //     'category'
    // ) // Add Category and Post Tags support
));
// flush_rewrite_rules();

// Add columns to alerts post listing
function add_nualerts_acf_columns ( $columns ) {
  $slice1 = array_slice($columns, 0, 2, true);
  $slice2 = array_slice($columns, 2, count($columns), true);
  return array_merge($slice1,array('active' => __ ( 'Active?' )),array('affected_campus' => __ ( 'Affected Campus(es)' )),$slice2);
}


function nualerts_custom_column ( $column, $post_id ) {
  switch ( $column ) {
    case 'active':
      echo (get_post_meta ( $post_id, 'active', true ) === "1"?"YES":"NO");
      break;
    case 'affected_campus':
      $list = "";
      foreach(get_post_meta ( $post_id, 'affected_campus', true ) as $r){
        $list .= ($list != ""?", ":"").get_the_title($r);
      }
      echo $list;
      break;
  }
}





// this is a function to gather up the alerts and display them
function getAlerts(){

  wp_reset_postdata();
	wp_reset_query();

  $args = array(
		 "post_type" => "nualerts"
		,'meta_query' => array(
			 'relation' => 'AND'
			,array("key"=>"active","value"=>"1",""=>"=")
		)
	);

	$alerts = query_posts($args);

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
        print_r($campus);
  }

		$response .= "</ul></div>";
	}

	wp_reset_postdata();
	wp_reset_query();

  //return '<div id="nu__alerts">'.$response.'</div>';

}






// add_filter ( 'manage_alerts_posts_columns', 'add_alerts_acf_columns' );
// add_action ( 'manage_alerts_posts_custom_column', 'alerts_custom_column', 10, 2 );

?>
