<?php
/*-----------------------------------------------------------------------------------*/
/* Add Menu items */
/*-----------------------------------------------------------------------------------*/
 
add_action('admin_menu', 'twistory_plugin_menu');
	
function twistory_plugin_menu() {

	//Page setting
	add_menu_page( 'Hackatweet', 'Hackatweet', 'edit_pages', 'twistory', 'twistory_settings', plugins_url( '../images/twitter.png' , __FILE__ ), 44 );
	add_submenu_page( 'twistory', 'Settings','Settings', 'edit_pages', 'twistory', 'twistory_settings');
	add_submenu_page( 'twistory', 'Hashtags','Hashtag', 'edit_pages', 'twistory_hashtag', 'twistory_hashtag');

}

function twistory_options(){
    echo "Admin Page Test";	
}



/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/

if ( get_option( 'twistory_dedicated_install'  ) != '' ):
	
	function remove_admin_menu_items() {
		remove_menu_page('edit.php');
		remove_menu_page('upload.php');
		remove_menu_page('edit.php?post_type=page');
		remove_menu_page('edit-comments.php');

	}
	
	add_action('admin_menu', 'remove_admin_menu_items');

endif; 
