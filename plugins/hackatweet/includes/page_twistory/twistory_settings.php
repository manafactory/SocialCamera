<?php 
/*
$args = array(
	      'posts_per_page'   => 5000,
	      'offset'           => 0,
	      'orderby'          => 'post_date',
	      'order'            => 'DESC',
	      'post_type'        => 'tweet',
	      'post_status'      => 'publish',
	      'suppress_filters' => true );
$all = get_posts($args);

$conto=0;
foreach($all as $sp){

  echo "<pre>";

     $dev  = wp_get_object_terms($sp->ID, 'search_keyword');
     if(count($dev) > 3){
       $conto++;
       echo $conto.") cancello ".get_the_title($sp->ID);
       //              wp_delete_post($sp->ID);
     }
  echo "</pre>";
}
*/
/*-----------------------------------------------------------------------------------*/
/* Save or Updaate Twitter App credentials */
/*-----------------------------------------------------------------------------------*/
if ( (isset($_POST['nonce_twistory_option']) || wp_verify_nonce($_POST['nonce_twistory_option'],'save_twistory_option')) && (isset($_POST['consumer_key']) && !empty($_POST['consumer_key'])) && (isset($_POST['consumer_secret']) && !empty($_POST['consumer_secret'])) && (isset($_POST['oauth_access_token']) && !empty($_POST['oauth_access_token'])) && (isset($_POST['oauth_access_token_secret']) && !empty($_POST['oauth_access_token_secret']))):

$option_name = 'option_app_twistory' ;
$new_value = array(
			'consumer_key'               => $_POST['consumer_key'],
			'consumer_secret'            => $_POST['consumer_secret'],
			'oauth_access_token'         => $_POST['oauth_access_token'],
			'oauth_access_token_secret'  => $_POST['oauth_access_token_secret'],
			
);

	if ( get_option( $option_name ) !== false ) {
	
	    // The option already exists, so we just update it.
	    update_option( $option_name, $new_value );
	
	} else {
	
	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( $option_name, $new_value, $deprecated, $autoload );
	}
	
endif; 

/*-----------------------------------------------------------------------------------*/
/* Save if Twistory is active or not */
/*-----------------------------------------------------------------------------------*/
if ( (isset($_POST['nonce_twistory_register']) || wp_verify_nonce($_POST['nonce_twistory_register'],'save_twistory_register')) && (isset($_POST['twistory_on_off']) && !empty($_POST['twistory_on_off'])) ):

$option_name = 'twistory_on_off' ;
$new_value = $_POST['twistory_on_off'];

	if ( get_option( $option_name ) !== false ) {
		
	    // The option already exists, so we just update it.
	    update_option( $option_name, $new_value );
	
	} else {
	
	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( $option_name, $new_value, $deprecated, $autoload );
	    
	    add_filter( 'cron_schedules', 'bl_add_cron_intervals' );
	}
	
endif;

/*-----------------------------------------------------------------------------------*/
/* Save in wich way twistory gets tweet */
/*-----------------------------------------------------------------------------------*/
if ( (isset($_POST['nonce_twistory_result_type']) || wp_verify_nonce($_POST['nonce_twistory_result_type'],'save_twistory_result_type')) && (isset($_POST['twistory_result_type']) && !empty($_POST['twistory_result_type'])) ):

$option_name = 'twistory_result_type' ;
$new_value = $_POST['twistory_result_type'];

	if ( get_option( $option_name ) !== false ) {
	
	    // The option already exists, so we just update it.
	    update_option( $option_name, $new_value );
	
	} else {
	
	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( $option_name, $new_value, $deprecated, $autoload );

	}
	
endif; 

/*-----------------------------------------------------------------------------------*/
/* Save is a dedicated install */
/*-----------------------------------------------------------------------------------*/
if ( (isset($_POST['nonce_twistory_dedicated_install']) || wp_verify_nonce($_POST['nonce_twistory_dedicated_install'],'save_twistory_dedicated_install')) && (isset($_POST['twistory_dedicated_install']) && ($_POST['twistory_dedicated_install'] != '')) ):

$option_name = 'twistory_dedicated_install' ;
$new_value = $_POST['twistory_dedicated_install'];

	if ($new_value == '1'):
	
		if ( get_option( $option_name ) != false ) {
		
		    // The option already exists, so we just update it.
		    update_option( $option_name, $new_value );
		
		} else {
		
		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'yes';
		    add_option( $option_name, $new_value, $deprecated );
		    
		}
	else:
			
		 	// If get option delete the option field.
		    delete_option($option_name);
		
	endif;

endif; 

/*-----------------------------------------------------------------------------------*/
/* Save geo coordinate */
/*-----------------------------------------------------------------------------------*/
if ( (isset($_POST['nonce_twistory_geo']) || wp_verify_nonce($_POST['nonce_twistory_geo'],'save_twistory_geo'))) :

	if ((isset($_POST['lat']) && ($_POST['lat'] != '')) && (isset($_POST['long']) && ($_POST['lat'] != '')) && (isset($_POST['radius']) && ($_POST['radius'] != '')) && (isset($_POST['unit']) && ($_POST['unit'] != '')) ):
		
		$option_name = 'twistory_geo';
	
		$geo_array = array(
				
			'lat'    => $_POST['lat'],
			'long'   => $_POST['long'],
			'radius' => $_POST['radius'],
			'unit'   => $_POST['unit'],
			'lang'   => $_POST['lang']
		
		);

	
		if ( get_option( $option_name ) !== false ) {
		
		    // The option already exists, so we just update it.
		    update_option( $option_name, $geo_array );
		
		} else {
		
		    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'yes';
		    add_option( $option_name, $geo_array );
		    
		}
	else:
			
		 	// If get option delete the option field.
		    delete_option($option_name);
		
	endif;

endif;

?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div><h2><?php _e('Twistory settings', 'twistory'); ?></h2>
</div>
<h3><?php _e('Twitter App', 'twistory'); ?></h3>

<?php if ( get_option( 'option_app_twistory'  ) !== false ):
			$option_app = get_option('option_app_twistory');
endif; ?>


<form action="admin.php?page=twistory" method="post">
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="blogname">Consumer Key</label></th>
			<td><input name="consumer_key" type="text" id="consumer_key" value="<?php if (isset($option_app)): echo $option_app['consumer_key']; endif; ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="blogname">Consumer Secret</label></th>
			<td><input name="consumer_secret" type="text" id="consumer_secret" value="<?php if (isset($option_app)): echo $option_app['consumer_secret']; endif; ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="blogname">Oauth Access Token</label></th>
			<td><input name="oauth_access_token" type="text" id="oauth_access_token" value="<?php if (isset($option_app)): echo $option_app['oauth_access_token']; endif; ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="blogname">Oauth Access Token Secret</label></th>
			<td><input name="oauth_access_token_secret" type="text" id="oauth_access_token_secret" value="<?php if (isset($option_app)): echo $option_app['oauth_access_token_secret']; endif; ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php wp_nonce_field('save_twistory_option','nonce_twistory_option'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
	<p class="description">Per generare tali codici creare una app su twitter tramite io seguenete <a href="">link</a>.</p>
</form>


<h3><?php _e('Twistory is active or not', 'twistory'); ?></h3>

<?php

/*-----------------------------------------------------------------------------------*/
/* Get option that check if twistory is actove or not */
/*-----------------------------------------------------------------------------------*/
if ( get_option( 'twistory_on_off'  ) !== false ):
	$option_on_off = get_option('twistory_on_off');
	if ($option_on_off == 'on'){
	    $on  = "checked='checked'";
	}else{
	    $off = "checked='checked'";
	}
else : 
	$off = "checked='checked'";	
endif; ?>

<form action="admin.php?page=twistory" method="post">
	<table class="form-table">
		<th scope="row">Registra tweet</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Decidi se registrare o meno i tweet nel tuo database</span></legend>
	<label title='On'><input type='radio' name='twistory_on_off' value='on' <?php if(isset($on)): echo $on; endif; ?> /> <span>On</span></label><br />
	<label title='Off'><input type='radio' name='twistory_on_off' value='off' <?php if(isset($off)): echo $off; endif; ?>/> <span>Off</span></label><br />
	</fieldset>
</td>
</tr>
	</table>
	<?php wp_nonce_field('save_twistory_register','nonce_twistory_register'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
</form>

<h3><?php _e('How to get tweet', 'twistory'); ?></h3>

<?php

/*-----------------------------------------------------------------------------------*/
/* Check witch tipology of serch twistory have to do */
/*-----------------------------------------------------------------------------------*/
if ( get_option( 'twistory_result_type'  ) !== false ):
	$option_result_type = get_option('twistory_result_type');
	if ($option_result_type == 'mixed'):
	    $mixed  = "checked='checked'";
	elseif ($option_result_type == 'recent'):
	    $recent = "checked='checked'";
	else:
		$popular = "checked='checked'";
	endif; 
else : 
	$mixed  = "checked='checked'";	
endif; ?>

<form action="admin.php?page=twistory" method="post">
	<table class="form-table">
		<th scope="row"><?php _e('Tipologia di registrazione', 'twistory'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e('Decidi in che modalità registrae i tuoi tweet', 'twistory')?></span></legend>
	<label title='mixed'><input type='radio' name='twistory_result_type' value='mixed' <?php if(isset($mixed)): echo $mixed; endif; ?> /> <span>Mixed</span></label><br />
	<label title='recent'><input type='radio' name='twistory_result_type' value='recent' <?php if(isset($recent)): echo $recent; endif; ?>/> <span>Recent</span></label><br />
	<label title='popular'><input type='radio' name='twistory_result_type' value='popular' <?php if(isset($popular)): echo $popular; endif; ?> /> <span>Popular</span></label>
	</fieldset>
</td>
</tr>
	</table>
	<?php wp_nonce_field('save_twistory_result_type','nonce_twistory_result_type'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
</form>


<h3><?php _e('Dedicated install', 'twistory'); ?></h3>

<?php
 
/*-----------------------------------------------------------------------------------*/
/* Check if is a dedicated install */
/*-----------------------------------------------------------------------------------*/
if ( get_option( 'twistory_dedicated_install'  ) !== false ):
	$option_result_type = get_option('twistory_dedicated_install');
	if ($option_result_type == '1'):
	    $dedicated  = "checked='checked'";
	endif; 
else : 
	$dedicated_false  = "checked='checked'";	
endif; ?>

<form action="admin.php?page=twistory" method="post">
	<table class="form-table">
		<th scope="row"><?php _e('', 'twistory'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e('Decidi se è un installazione dedicata', 'twistory')?></span></legend>
	<label title='true'><input type='radio' name='twistory_dedicated_install' value='1' <?php if(isset($dedicated)): echo $dedicated; endif; ?> /> <span>True</span></label><br />
	<label title='false'><input type='radio' name='twistory_dedicated_install' value='0' <?php if(isset($dedicated_false)): echo $dedicated_false; endif; ?>/> <span>False</span></label><br />
</td>
</tr>
	</table>
	<?php wp_nonce_field('save_twistory_dedicated_install','nonce_twistory_dedicated_install'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
</form>


<?php
/*-----------------------------------------------------------------------------------*/
/* Set geocoordinate for search */
/*-----------------------------------------------------------------------------------*/
if ( get_option( 'twistory_geo'  ) !== false ):
	$option_geo = get_option('twistory_geo');
	
	$lat = $option_geo['lat'];
	$long = $option_geo['long'];
	$radius = $option_geo['radius'];
	$unit = $option_geo['unit'];
	$lang = $option_geo['lang'];
		
endif; ?>
<h3><?php _e('Scegli le coordinate', 'twistory')?></h3>
<form action="admin.php?page=twistory" method="post">
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Latitude', 'twistory'); ?></th>
			<td><input type='text' name='lat' value='<?php if(isset($lat)): echo $lat; endif; ?>'  class="regular-text"/> </td>
		</tr>
		<tr>	
			<th scope="row"><span><?php _e('Longitude', 'twistory'); ?></th>
			<td><input type='text' name='long' value='<?php if(isset($long)): echo $long; endif; ?>' class="regular-text" /></td>
		</tr>
		<tr>
			<th scope="row"><span><?php _e('Radius', 'twistory'); ?></th>
			<td><input type='text' name='radius' value='<?php if(isset($radius)): echo $radius; endif; ?>' class="regular-text" /> </td>
		</tr>
		<tr>
			<th scope="row"><span><?php _e('Unit', 'twistory'); ?></th>
			<td>
				<select name="unit">
					<option value=""><?php _e('Select one', 'twistory'); ?></option>
					<option value="km" <?php if($unit == 'km') echo 'selected'; ?>><?php _e('Kilometers', 'twistory'); ?></option>
					<option value="mi" <?php if($unit == 'mi') echo 'selected'; ?>><?php _e('Miles', 'twistory'); ?></option>
				</select>
		</tr>
		<tr>
			<th scope="row"><span><?php _e('Language', 'twistory'); ?></th>
			<td><input type='text' name='lang' value='<?php if(isset($lang)): echo $lang; endif; ?>' class="regular-text" /><br><a href="http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes</a> </td>
		</tr>


	</table>
	<?php wp_nonce_field('save_twistory_geo','nonce_twistory_geo'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
</form>
