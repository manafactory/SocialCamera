<?php 

/*-----------------------------------------------------------------------------------*/
/* Function on activation 

	Create custom table

 */
/*-----------------------------------------------------------------------------------*/
function myplugin_activate() {

    // Activation code here...
}
register_activation_hook( __FILE__, 'myplugin_activate' );