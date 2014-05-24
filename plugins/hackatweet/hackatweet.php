<?php
/*
Plugin Name: Hackatweet
Version: 0.1
*/

require_once('register_plugin.php');

//Includo le funzioni comuni 
require_once('includes/utils.php');


//Style and script 
function twistory_admin_enqueue($hook_suffix) {

    if($hook_suffix == 'toplevel_page_simple_graph' || $hook_suffix == 'twistory-graph_page_twistory_timeline' || $hook_suffix == 'twistory-graph_page_twistory_pie' || $hook_suffix == 'twistory-graph_page_twistory_bar' || $hook_suffix == 'twistory-graph_page_twistory_bar_users') {
        wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_register_style( 'datepicker-style', plugins_url() . '/twistory/lib/jQuery-ui-bootstrap/jquery-ui-1.10.0.custom.css' );
		wp_enqueue_style('datepicker-style');
		wp_enqueue_script('custom_graph', plugins_url()  . '/twistory/js/custom_graph.js');
		wp_enqueue_script('highcharts-main', plugins_url()  . '/twistory/lib/highchart/js/highcharts.js');
		wp_enqueue_script('highcharts-exporting', plugins_url()  . '/twistory/lib/highchart/js/modules/exporting.js');
		
    }
}
add_action('admin_enqueue_scripts', 'twistory_admin_enqueue');

//Includo la libreria per rest api
require('includes/TwitterAPIExchange.php');

//Definisco le pagine di menu del plugin
require('includes/twistory_menu.php');

//Definosco le funzioni per le pagine

//inserimento Hashtag
if(!function_exists('twistory_hashtag')):
	function twistory_hashtag(){
		include_once('includes/page_twistory/twistory_hashtag.php');
		}
endif; 

//Inserimento general settings
if(!function_exists('twistory_settings')):
	function twistory_settings(){
		include_once('includes/page_twistory/twistory_settings.php');
		}
endif;

//Inserimento general settings
if(!function_exists('twistory_archives')):
	function twistory_archives(){
		include_once('includes/page_twistory/twistory_archives.php');
		}
endif;


//Inserimento TEMPORANEO PAGINA RECUPERO TWEET



include('includes/twistory_get_tweets.php');


//Definisco il Post type
require('includes/twistory_post_type.php');


/*-----------------------------------------------------------------------------------*/
/* Cron */
/*-----------------------------------------------------------------------------------*/

/* Create custom cron interval */
add_filter( 'cron_schedules', 'montage_cron_schedules');
function montage_cron_schedules(){
    return array(
            '5_seconds' => array(
                    'interval' => 5,
                    'display' => 'Every five second'
            ),
            '10_minute' => array(
                    'interval' => 60 * 10,
                    'display' => 'In every two Mintues'
            ),
            '3_hourly' => array(
                    'interval' => 60 * 60 * 3,
                    'display' => 'Once in Three minute'
            )
    );
} 



/* Create Wordpress Schedule */
function twistory_cron() {
    if(! wp_next_scheduled('twistory_event')) {
        wp_schedule_event(time(), '5_seconds' , 'twistory_event');
    }   
}

add_action( 'init', 'twistory_cron' );


/*
add_action("init", "clear_crons_left");
function clear_crons_left() {
wp_clear_scheduled_hook("twistory_event");
}
*/