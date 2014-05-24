<?php
/*
Plugin Name: Hackathon Cron
Version: 0.1
*/


register_activation_hook( __FILE__, 'hackathon_activation' );
/**
 * On activation, set a time, frequency and name of an action hook to be scheduled.
 */
function hackathon_activation() {
  wp_schedule_event( time(), 'hourly', 'hackathon_hourly_event_hook' );
}

add_action( 'hackathon_hourly_event_hook', 'hackathon_save_classifica' );
/**
 * On the scheduled action hook, run the function.
 */
function hackathon_save_classifica() {
  $args = array(
		'orderby' => 'count',
		'order' => 'DESC',
		'hide_empty' => false
		); 
  $terms = get_terms( 'search_keyword', $args );
  
  $conta=0;
  foreach($terms as $tt){
    $conta++;
    $chiave = "classifica_".$tt->slug;
    //    echo $chiave;
    update_option($chiave, $conta);
  }
}
