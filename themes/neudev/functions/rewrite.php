<?php
// this file will house all custom redirects and query tags that we need to create
// we need to prevent the canonical redirect for theh homepage?
function disable_canonical_redirect_for_front_page( $redirect ) {

 if ( is_page() && $front_page = get_option( 'page_on_front' ) ) {

   if ( is_page( $front_page ) )
     $redirect = false;
 }

 return $redirect;
}
add_filter( 'redirect_canonical', 'disable_canonical_redirect_for_front_page' );


// add custom query tags here
function myplugin_rewrite_tag() {
  add_rewrite_tag( '%hptesting%', '([^&]+)' );         // this is for testing


}
add_action('init', 'myplugin_rewrite_tag', 10, 0);

// add custom rewrite rules here
function custom_rewrite_rule() {

  add_rewrite_rule('^campus/([^/]*)?','index.php?page_id=282&hptesting=$matches[1]','top');  // testing


}
add_action('init', 'custom_rewrite_rule', 10, 0);
?>
