<?php 
//funzione per recuperare tutti gli hashtag inseriti
if(!function_exists('get_hashtag_list')):
	function get_hashtag_list(){
	  $all = get_option("twistory_hashtag");	
	  if(!is_array($all)):
	    $all = unserialize($all);
	  endif; 
	  
	  $all=apply_filters("twistory_hashtag_list", $all);
	  return $all;
	}
endif;	


//Aggiungo ruolo twitterer
add_role( 'twitterer', 'Twitterer' ); 

//Stampo le usermeta nel backend

if(!function_exists('display_user_twitter_info')):
	add_action( 'show_user_profile', 'display_user_twitter_info' );
	add_action( 'edit_user_profile', 'display_user_twitter_info' );
	
	function display_user_twitter_info( $user ) { ?>
	    <h3>Twitter Info</h3>
	    <table class="form-table">
	    	<tr>
	            <th><label><?php _e('Image', 'twistory'); ?></label></th>
	            <td><img src="<?php echo get_user_meta( $user->ID, 'profile_image_url', true );?>" /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Followers count', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'followers_count', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Friends Count', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'friends_count', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Listed count', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'listed_count', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Created at', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'created_at', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('utc offset', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'utc_offset', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Geo enebled', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'geo_enabled', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Statuses count', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'statuses_count', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        <tr>
	            <th><label><?php _e('Lang', 'twistory'); ?></label></th>
	            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'lang', true ); ?>" class="regular-text" readonly=readonly /></td>
	        </tr>
	        
	    </table>
	    <?php
	}
endif;










/*-----------------------------------------------------------------------------------*/
/* Extend tweet lists */
/*-----------------------------------------------------------------------------------*/


add_action( 'manage_tweet_posts_custom_column', 'twi_cpt_custom_column', 10, 2);
function twi_cpt_custom_column($column_name, $post_id) {
  //  $taxonomy = $column_name;
  $post_type = get_post_type($post_id);
  //$terms = get_the_terms($post_id, $taxonomy);
  if($column_name == "value"){
    echo '<div id="twitter_value_col-' . $post_id . '" style="display:none;">';

  $val = get_post_meta($post_id, 'twitter_value', true);
    echo $val;
  echo "</div>";
  if( $val == "positive") echo '<i style="color:green">' . $val . '</i>';
  else if( $val == "negative") echo '<i style="color:red">' . $val . '</i>';
  else echo '<i>'.$val.'</i>';

  }else if($column_name == "keywords"){

    $terms = get_the_terms( $post_id, "keyword" );
    if ( !empty( $terms ) ) {
      $out = array();
      foreach ( $terms as $c )
	$out[] = "<a href='edit.php?keyword={$c->name}&post_type=".$post_type."'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
      echo join( ', ', $out );
    }
    //  $val = get_post_meta($post_id, 'twitter_value', true);
  //if( $val == "positive") echo '<i style="color:green">' . $val . '</i>';
  //else if( $val == "negative") echo '<i style="color:red">' . $val . '</i>';
  //else echo '<i>'.$val.'</i>';
  } 
}

add_action("admin_init", "twinit");
function twinit(){

// Add to our admin_init function
add_action('quick_edit_custom_box',  'twi_add_quick_edit', 10, 2);
add_action('bulk_edit_custom_box',  'twi_add_quick_edit', 10, 2);

// Add to our admin_init function
add_action('save_post', 'twi_save_quick_edit_data');


}
 
function twi_add_quick_edit($column_name, $post_type) {
  if ($column_name == 'value'){

  ?>
    <fieldset class="inline-edit-col-left">
       <div class="inline-edit-col">
       <span class="title">Value</span>
       <input type="hidden" name="twi_widget_set_noncename" id="twi_widget_set_noncename" value="" />
    
<input type="radio" name="twitter_value" value="positive"> positive
<input type="radio" name="twitter_value" value="negative"> negative
<input type="radio" name="twitter_value" value="neutral"> neutral
	      </div>
    </fieldset>
	      <?php
      } else {

    
  }
}


 
function twi_save_quick_edit_data($post_id) {
  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
  // Check permissions
  /*
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
      return $post_id;
  }
  */
  // OK, we're authenticated: we need to find and save the data
  $post = get_post($post_id);
  if (isset($_POST['twitter_value']) && ($post->post_type != 'revision')) {
    $tvalue = esc_attr($_POST['twitter_value']);
    if ($tvalue)
      update_post_meta( $post_id, 'twitter_value', $tvalue);
  }
  return $tvalue;
}


add_action( 'admin_print_scripts-edit.php', 'tweet_enqueue_edit_scripts' );
function tweet_enqueue_edit_scripts() {
  wp_enqueue_script( 'tweet-admin-edit',  plugins_url( '/js/quick_edit.js' , __FILE__ ), array( 'jquery', 'inline-edit-post' ), '', true );
}




add_action( 'wp_ajax_tweet_save_bulk_edit', 'tweet_save_bulk_edit' );
function tweet_save_bulk_edit() {
  // get our variables

  $post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : array();
  $twitter_value = ( isset( $_POST[ 'twitter_value' ] ) && !empty( $_POST[ 'twitter_value' ] ) ) ? $_POST[ 'twitter_value' ] : NULL;
  // if everything is in order
  
  //  print_r($post_ids);
  if ( !empty( $post_ids ) && is_array( $post_ids )) {
    foreach( $post_ids as $post_id ) {
      update_post_meta( $post_id, 'twitter_value', $twitter_value );
      //echo "----".$twitter_value;
    }
  }
}

/*-----------------------------------------------------------------------------------*/
/* Taxonomy for graph */
/*-----------------------------------------------------------------------------------*/

function get_taxonomy_for_graph(){
	$taxonomy_graph = array(
		'hashtag'         => __('Hashtag', 'twistory'),
		'search_keyword'  => __('Search keyword', 'twistory'), 
		'device_source'   => __('Device source', 'twistory'),
		'tweet_tag'       => __('Tweet tag', 'twistory')
	);
	
	return $taxonomy_graph;
}
add_filter('add_taxonomy_for_graph', 'get_taxonomy_for_graph' );


/*-----------------------------------------------------------------------------------*/
/* Infinite scroll for tweet */
/*-----------------------------------------------------------------------------------*/


//Make translation ready

function infinite_scroll_for_admin_text_domain_twistory() {
    load_plugin_textdomain( 'infinite-scroll-for-admin', false, dirname( plugin_basename( __FILE__ ) ) . '/../lib/infinite-scroll/languages/' );
    }
add_action( 'admin_init', 'infinite_scroll_for_admin_text_domain_twistory' );

//Load infinite scroll on particular pages

function infinite_scroll_for_admin_scripts_twistory( $hook ) {
	
    if ( in_array( $hook, array( 'edit.php' ) ) && get_query_var('post_type') == 'tweet' ) {

        $min = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

        wp_enqueue_script( 'infinite_scroll', plugins_url( '../lib/infinite-scroll/js/jquery.infinitescroll' . $min . '.js' , __FILE__ ), array('jquery'), '2.0b2', true );

        $l10n = array( 'msgText' => __( 'Loading...', 'infinite-scroll-for-admin' ),
                        'finishedMsg' => __( 'The end.', 'infinite-scroll-for-admin' ) );

        wp_localize_script( 'infinite_scroll', 'Infinite_Scroll_Admin', $l10n );

        add_action( 'admin_print_footer_scripts', 'infinite_scroll_for_admin_init_scripts_twistory' );

    }

}
add_action( 'admin_enqueue_scripts', 'infinite_scroll_for_admin_scripts_twistory' );

//Initiate infinite scroll on particular pages

function infinite_scroll_for_admin_init_scripts_twistory(){ ?>

    <style>
    #infscr-loading { text-align: center; }
    </style>

    <script type="text/javascript">

    (function ($) {

        // little conditional so we can re-use script on both edit.php and edit-comments.php
        if ( $('#the-list').length ){
            var scrollme = '#the-list';
        } else if ( $('#the-comment-list').length ) {
            scrollme = '#the-comment-list';
        }

        var colspan = $( scrollme + ' tr:first-child').find('td').length;
        var contentSelector = scrollme;
        var itemSelector = scrollme + ' > tr';

       $(scrollme).infinitescroll({
            loading: {
                finishedMsg: '<em>' + Infinite_Scroll_Admin.finishedMsg + '</em>',
                msg: $('<tr id="infscr-loading"><td colspan="' + colspan + '"><img alt="Loading tweet..." src="' + "<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" + '" /><div>' + Infinite_Scroll_Admin.msgText + '</div></td></tr>')
            },
            nextSelector: ".pagination-links a.next-page",
            navSelector: ".pagination-links",
            contentSelector: contentSelector,
            itemSelector: itemSelector,
            prefill: true,
            maxPage: $('.paging-input .total-pages').html(),
            debug: true
        });

    })(jQuery)

    </script>
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Function Ajax  */
/*-----------------------------------------------------------------------------------*/


//For get teet continiusly

add_action('wp_ajax_quicksearch_tweet', 'quicksearch');
add_action('wp_ajax_nopriv_quicksearch_tweet', 'quicksearch');

function quicksearch() {
	
	// Set the JSON header
	header("Content-type: text/json");
	
	 global $date_from;
	 
	$time = time();
	$date_to = date('Y-m-d-H-i-s', $time);
	$date_to_array = explode('-',$date_to);
	if(!isset($date_from)):
		$date_from = date('Y-m-d-H-i-s', $time - 10);
	endif; 
	$date_from_array = explode('-', $date_from);
	//echo $date_to . ' - ' . $date_from;
	// The x value is the current JavaScript time, which is the Unix time multiplied 
	// by 1000.
	
	
	
	
	$args = array(
		'date_query' => array(
			array(
				'year'      => $date_from_array[0],
				'month'     => $date_from_array[1],
				'day'       => $date_from_array[2],
				'hour'      => $date_from_array[3],
				'minute'    => $date_from_array[4],
				'second'    => $date_from_array[5],
				'compare'   => '>=',
			),
			array(
				'year'      => $date_to_array[0],
				'month'     => $date_to_array[1],
				'day'       => $date_to_array[2],
				'hour'      => $date_to_array[3],
				'minute'    => $date_to_array[4],
				'second'    => $date_to_array[5],
				'compare'   => '<=',
			),
		),
		'post_status' => array('publish', 'private', 'archive' ),
		'post_type' => 'tweet',
		'posts_per_page' => -1,
	);
	
	$query_quicksearch = new WP_Query( $args );
		
	
	$x = $time * 1000;
	
	// The y value is a random number
	$y = $query_quicksearch->post_count;
	
	// Create a PHP array and echo it as JSON
	$ret = array($x, $y);
	echo json_encode($ret);
	
	die;
	
}


//Get description

add_action('wp_ajax_search_description_report', 'search_description_report');
add_action('wp_ajax_nopriv_search_description_report', 'search_description_report');

function search_description_report(){
	
	
	if($_POST['id_post']):
	
			$post = get_post($_POST['id_post']); ?>
		
			<textarea id="report_text" name="report_text"><?php if($post->post_content != '') echo $post->post_content; ?></textarea>
		
	
	<?php endif;
die();
	
	
}


//Delete post meta graph

add_action('wp_ajax_delete_post_meta_graph', 'delete_post_meta_graph');
add_action('wp_ajax_nopriv_search_description_report', 'delete_post_meta_graph');

function delete_post_meta_graph(){
	
	
	if($_POST['id_postmeta']):
	
	$delete = delete_metadata_by_mid('post', (int)$_POST['id_postmeta']);
		
	if($delete == true):
	
		echo 'true';
	
	else:
		
		echo 'false';
		
	endif;
	
endif;
die();
	
	
}



/*-----------------------------------------------------------------------------------*/
/* Get id of a post from postmeta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('get_post_id_by_meta_key_and_value')) {
	
	function get_post_id_by_meta_key_and_value($key, $value, $limit = 1) {
		global $wpdb;
		
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."' LIMIT " . $limit . "");
		
		
		
		if (is_array($meta) && !empty($meta) && isset($meta[0])):
			if($limit==1):
				
				$meta = $meta[0];
				if (is_object($meta)):
					return $meta->post_id;
				else:
					return false;
				endif;
				
			else:
				$array_with_id = array();
				
				foreach($meta as $id_post):
					if (is_object($id_post)):
						$array_with_id[] = $id_post->post_id; 
					endif;
				endforeach;
			
				return $array_with_id;
				
			endif;
		
		endif;
			
	}		
		
}

function get_mid_by_key_value( $post_id, $meta_key, $meta_value ) { 
     global $wpdb; 
     $mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_id FROM 
$wpdb->postmeta WHERE post_id = %d AND meta_key = %s AND meta_value = %s", $post_id, 
$meta_key, $meta_value) ); 
     if( $mid != '' ) 
         return (int)$mid; 

     return false; 
} 


/*-----------------------------------------------------------------------------------*/
/* Save Graph */
/*-----------------------------------------------------------------------------------*/

function save_graph($array_whit_date, $array_term_count, $number, $date1, $date2, $graph_type, $type_taxonomy, $action){ ?>
	
	
	<p class="submit"><button id="open-save-graph" class="button button-primary">Salva il grafico</button></p>

	<div id="save-graph-content" title="Save the graph" style="display:none;">
		<div class="wrap">
			<form action="<?php echo str_replace('/wp-admin/', '', $action); ?>" method="post">
			<table class="form-table widefat">
				<tr valign="top">
					<td><?php _e('New report', 'twistory'); ?><input type="radio" name="new_or_old" value="new" id="new_or_old" checked /></td>
					<td><?php _e('Add to other', 'twistory'); ?><input type="radio" name="new_or_old" value="old" id="new_or_old" /></td>
				</tr>
				<tr valign="top" class="name">
					
					<td><?php _e('Name of report', 'twistory'); ?>:</td>
					<td><input type="text" name="name_graph" value="" id="name_graph" /></td>
				</tr>
				<tr valign="top" class="description">
					
					<td><?php _e('Description of report', 'twistory'); ?>:</td>
					<td> <textarea name="note_graph" value="" id="note_graph"></textarea> </td>
				</tr>
				
				<tr valign="top" class="report" style="display:none;">
					
					<td><?php _e('Select report', 'twistory'); ?>:</td>
					<td> 
					<?php 
					
					$author_id = get_current_user_id();
					
					$args = array(
						
						'post_type' => 'tweet_user_graph',
						'posts_per_page' => -1,
						'author' => $author_id
					
					);
					query_posts($args);
					
					if(have_posts()):?>
						<select name="post_to_attach" id="post_to_attach">
							<option value=""><?php _e('Select an option', 'twistory'); ?></option>
							<?php while(have_posts()): the_post(); ?>
								<option value="<?php echo get_the_id(); ?>"><?php the_title(); ?></option>
							<?php endwhile; ?>
						</select>
					<?php else: ?>
					
						<?php _e('No report yet', 'twistory'); ?>
					
					<?php endif; ?>
					</td>
				</tr>
				<tr valign="top" class="report_text" style="display:none;">
				</tr>
				
				<?php $array_whit_date = array_slice($array_whit_date, 0, $number); $array_whit_date = json_encode($array_whit_date); ?>
				<input type="hidden" name="array_whit_date" value="<?php echo htmlspecialchars($array_whit_date); ?>" />
				
				<?php $array_term_count = array_slice($array_term_count, 0, $number); $array_term_count = json_encode($array_term_count); ?>
				<input type="hidden" name="array_term_count" value="<?php echo htmlspecialchars($array_term_count); ?>" />
				<input type="hidden" name="from" value="<?php echo $date1; ?>" />
				<input type="hidden" name="to" value="<?php echo $date2; ?>" />
				<input type="hidden" name="graph_type" value="<?php echo $graph_type; ?>" />
				<input type="hidden" name="type_search" value="<?php echo $type_taxonomy; ?>" />
			</table>
			<?php wp_nonce_field('save_graph_user','nonce_save_graph_user'); ?>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save', 'twistory'); ?>"  /></p>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		
		jQuery(document).ready(function() {
		    jQuery('input[type=radio][name=new_or_old]').change(function() {
		        if (this.value == 'new') {
		            jQuery('.report').hide();
		            jQuery('.name').show();
		            jQuery('.description').show()
		        }
		        else if (this.value == 'old') {
		           	jQuery('.report').show();
		            jQuery('.name').hide();
		            jQuery('.description').hide();
		            
		            jQuery(function(){
							jQuery('#post_to_attach').change(function(){
								var id_post = jQuery('#post_to_attach').val();
								var ajaxurl = '<?php echo admin_url("admin-ajax.php", null); ?>';
								data = { action: "search_description_report", id_post: id_post};
								jQuery.ajax({
									url:ajaxurl,
									type:'post',
									dataType: 'html',
									data: data,
									beforeSend: function() {
									    jQuery('.report_text').show().html('<img alt="Loading tweet..." src="' + "<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" + '" /> Loading...');
									  },
									success:function(response) {
										jQuery(".report_text").html(response);
	
									}
								})
							});
		            
						});
		        
		        }
		    });
		});
		
	</script>
	
<?php }

function twistory_save_graph($dati_post){

        //prepare data for save
        $array_whit_date = str_replace('\\', '', $dati_post['array_whit_date']) ;
        $array_whit_date = json_decode($array_whit_date);

        $array_term_count = str_replace('\\', '', $dati_post['array_term_count']) ;
        $array_term_count = json_decode($array_term_count);

        $array_to_save['type'] = $dati_post['graph_type'];
        $array_to_save['type_search'] = $dati_post['type_search'];
        $array_to_save['from'] = $dati_post['from'];
        $array_to_save['to'] = $dati_post['to'];
        $array_to_save['array_with_date'] = $array_whit_date;
        $array_to_save['array_term_count'] = $array_term_count;

        //Get the user id
        $user_ID = get_current_user_id();

        //If is new report create post ad add postmeta
        if($dati_post['new_or_old'] == 'new' ):

            $args = array(
                'post_content'   => $dati_post['note_graph'],
                'post_title'     => $dati_post['name_graph'], // The title of your post.
                'post_status'    => 'private',
                'post_type'      => 'tweet_user_graph',
                'post_author'    => $user_ID,
                'ping_status'    => 'closed',
            );

            $report_id = wp_insert_post($args);

            add_post_meta($report_id, 'array_graph', $array_to_save, false);
        //Otherwise only add postmeta to post
        else:

            $report = array(
                'ID'           => $dati_post['post_to_attach'],
                'post_content' => $dati_post['report_text']
            );

            //Update the post into the database
            $report_id = wp_update_post( $report );

            add_post_meta($report_id, 'array_graph', $array_to_save, false);

        endif;
}


/*-----------------------------------------------------------------------------------*/
/* Function for controll cont term */
/*-----------------------------------------------------------------------------------*/

function twistory_controll_count_term(){
	
	
	global $wpdb;
	$args = array(
	
		'hide_empty'    => false,
	
	);
	$terms = get_terms('place', $args);
	
	
    foreach ( $terms as $term)
    {
    	$term_taxonomy_id = $term->term_taxonomy_id;
    
        do_action( 'edit_term_taxonomy', $term, 'place' );
		
		$args = array(
		
			'post_type' => 'tweet',
			'post_status' => 'private',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'place',
					'field' => 'id',
					'terms' => $term->term_id
				)
			)
		
		);
		
		query_posts($args);
        // Do stuff to get your count
        
        global $wp_query;
		//echo $wp_query->post_count;
		$count = $wp_query->post_count;
        $wpdb->update( $wpdb->term_taxonomy, array( 'count' => $count ), array( 'term_taxonomy_id' => $term_taxonomy_id ) );
        do_action( 'edited_term_taxonomy', $term_taxonomy_id, 'place' );
    }
	
	
}
