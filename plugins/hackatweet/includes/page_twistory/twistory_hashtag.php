<?php
//Get All Hastag
$all_hashtag = get_hashtag_list();

//Add hashtag
if($_REQUEST['action'] == "add"):
	//cerifico se il tag gia esiste
	$new_hashtag = $_REQUEST['tag'];
	if (in_array($new_hashtag, $all_hashtag)):
		$hashtag_exists = 1;
		$hashtag_add = 0;
	else:
		$all_hashtag[] = $_REQUEST['tag'];
		update_option("twistory_hashtag", $all_hashtag);
		$hashtag_exists = 0;
		$hashtag_add = 1;
		
		//Aggiungo il termine alla tassonomia search_keyword se non esiste
		$term = term_exists($new_hashtag, 'search_keyword');
		print_r( $term );
		var_dump($term);
		echo $new_hashtag;
			if ($term === 0 || $term === null) {
				wp_insert_term($new_hashtag, 'search_keyword');
			}
	endif;
endif;

//Delete Hashtag
if($_REQUEST['action'] == "remove"):
 
 foreach($all_hashtag as $tag):
     if($tag != $_REQUEST['tag']):
     	     $newall[]=$tag;
     endif;
 endforeach;
 
 $all_hashtag = $newall;
 update_option("twistory_hashtag", $all_hashtag);

endif; 
//Save is search with and/or
if ( (isset($_POST['nonce_twistory_mode_search']) || wp_verify_nonce($_POST['nonce_twistory_mode_search'],'save_twistory_mode_search')) && (isset($_POST['twistory_type_search']) && !empty($_POST['twistory_type_search'])) ):
	$option_name = 'twistory_type_search' ;
	$new_value = $_POST['twistory_type_search'];

	if ( get_option( $option_name ) !== false ) {
	
	    // The option already exists, so we just update it.
	    update_option( $option_name, $new_value );
	
	} else {
	
	    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( $option_name, $new_value, $deprecated, $autoload );
	         
	}


endif; ?>
<div class="wrap">
<?php if($hashtag_exists == 1): ?>
	<div id="message" class="error">
		<p><?php _e('Hashtag already exists', 'twiatory'); ?></p>
	</div>
<?php endif; ?>
<?php if($hashtag_add == 1): ?>
	<div id="message" class="updated fade">
		<p><?php _e('Hashtag added', 'twiatory'); ?></p>
	</div>
<?php endif; ?>
<div id="icon-tools" class="icon32"></div>
	<h2><?php _e('Manage Tag to Monitor', 'twistory'); ?></h2>

<h3><?php _e('Add a new tag to monitor', 'twistory'); ?></h3>
<form action='admin.php'>
	<input type='hidden' name='page' value='twistory_hashtag'>
	<input type='hidden' name='action' value='add'>
	<input type='text' name='tag' value=''>
	<input type='submit' name='Salva' value='Salva' class='button'>
</form>

<br /><br />
<div id="icon-tools" class="icon32"></div>
<h2><?php _e('Hashtag we are following', 'twistory'); ?></h2>
<h3><?php _e('List of all tags we are actually following', 'twistory'); ?></h3>



<?php
//If exists print all hastags	
if(isset($all_hashtag)):?>
	
	<?php foreach($all_hashtag as $hashtag): ?>
	
		<span class='button'><?php echo $hashtag ?> [<a href='admin.php?page=twistory_hashtag&tag=<?php echo urlencode($hashtag); ?>&action=remove'>Elimina</a>] </span>
	
	<?php endforeach;

endif; ?>

</div>

<?php
//Get option is search is AND or OR
if ( get_option( 'twistory_type_search'  ) !== false ):
	$option_type_search = get_option('twistory_type_search');
	if ($option_type_search == 'AND'){
	    $and  = "selected";
	}else{
	    $or = "selected";
	}
else : 
	$or = "selected";	
endif; ?>

<h3><?php _e('Come vuoi cercare And o Or', 'twistory'); ?></h3>
<form action='admin.php?page=twistory_hashtag' method="post">
	<select name="twistory_type_search">
		<option value="AND" <?php if(isset($and)): echo $and; endif; ?>>And</option>
		<option value="OR" <?php if(isset($or)): echo $or; endif; ?>>Or</option>
	</select>
	<?php wp_nonce_field('save_twistory_mode_search','nonce_twistory_mode_search'); ?>	
	<input type='submit' name='Salva' value='Salva' class='button'>
</form>