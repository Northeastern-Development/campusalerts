<?php

  add_action('init', 'customRSS');
  function customRSS(){

    add_feed('campuses', 'campusesRSSFunc');
    add_feed('alerts', 'alertsRSSFunc');
  

  }



  // campuses
  function campusesRSSFunc(){
    header( 'Content-Type: application/rss+xml; charset=' . get_option( 'blog_charset' ), true );
    require_once( get_template_directory() . '/page-templates/rss/rss-campuses.php' );
  }



  // alerts
  function alertsRSSFunc(){
    header( 'Content-Type: application/rss+xml; charset=' . get_option( 'blog_charset' ), true );
    require_once( get_template_directory() . '/page-templates/rss/rss-alerts.php' );
  }



?>
