<?php 
/*-----------------------------------------------------------------------------------*/
/* Function on activate plugin */
/*-----------------------------------------------------------------------------------*/

//Create custom table

register_activation_hook( __FILE__, 'twistory_create_plugin_tables' );

function twistory_create_plugin_tables()
{
    global $wpdb;
	
	//Check if mutisite or not
	if(is_multisite()){
		$table_name = $wpdb->base_prefix . 'twistory_chart';	
	}else{
		$table_name = $wpdb->prefix . 'twistory_chart';
	}

    $sql = "CREATE TABLE $table_name (
			  `id` int(11) DEFAULT NULL,
			  `user_id` int(11) NOT NULL DEFAULT '0',
			  `type_chart` char(20) NOT NULL DEFAULT '',
			  `chart_info` text NOT NULL
			);";
	
	echo $sql;
	
	exit;
	
	
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
