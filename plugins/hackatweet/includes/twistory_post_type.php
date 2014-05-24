<?php
function tweeter_init() {

$labels_tweet = array(
    'name'                  => _x('Tweets', 'post type general name', 'twistory'),
    'singular_name'         => _x('Tweet', 'post type singular name', 'twistory'),
    'add_new'               => _x('Add New', 'tweet', 'twistory'),
    'add_new_item'          => __('Add New Tweet', 'twistory'),
    'edit_item'             => __('Edit Tweet', 'twistory'),
    'new_item'              => __('New Tweet', 'twistory'),
    'all_items'             => __('All Tweets', 'twistory'),
    'view_item'             => __('View Tweet', 'twistory'),
    'search_items'          => __('Search Tweets', 'twistory'),
    'not_found'             => __('No tweet found', 'twistory'),
    'not_found_in_trash'    => __('No tweets found in Trash', 'twistory'), 
    'parent_item_colon'     => '',
    'menu_name'             => __('Tweets', 'twistory')
);

// definisco i post type tweet
register_post_type( 'tweet', array(
	'labels'          	=> $labels_tweet,
	'public'            => true,
	//'taxonomies'      	=> array('post_tag'),
	'has_archive'       => true,	
	'menu_position'     => 40,
	'capability_type' 	=> 'page',
	'menu_icon'         => plugins_url( '../images/twitter_icon.png' , __FILE__ ), 
	'supports'        	=> array('title','content','author','thumbnail', 'custom-fields'  ),
	'rewrite'           => array('slug' => 'tweet'),
		)
	  );
	  

$labels_hashtag = array(
    'name'                          => _x( 'Hashtag', 'taxonomy general name' ),
    'singular_name'                 => _x( 'Keywords', 'taxonomy singular name' ),
    'search_items'                  => __( 'Search  Keywords' ),
    'popular_items'                 => __( 'Popular Keywords' ),
    'all_items'                     => __( 'All Keywords' ),
    'parent_item'                   => null,
    'parent_item_colon'             => null,
    'edit_item'                     => __( 'Edit Keywords' ), 
    'update_item'                   => __( 'Update Keywords' ),
    'add_new_item'                  => __( 'Add New Keyword' ),
    'new_item_name'                 => __( 'New Keyword Name' ),
    'separate_items_with_commas'    => __( 'Separate keywords with commas' ),
    'add_or_remove_items'           => __( 'Add or remove keywords' ),
    'choose_from_most_used'         => __( 'Choose from the most used keywords' ),
    'menu_name'                     => __( 'Hashtag' ),
  ); 



register_taxonomy('hashtag','tweet',array(
    'hierarchical'          => true,
    'labels'                => $labels_hashtag,
    'show_ui'               => true,
    'update_count_callback' => '',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'hashtag' ),
	)
);

$labels_keyword = array(
    'name'                          => _x( 'Keywords', 'taxonomy general name' ),
    'singular_name'                 => _x( 'Keywords', 'taxonomy singular name' ),
    'search_items'                  => __( 'Search  Keywords' ),
    'popular_items'                 => __( 'Popular Keywords' ),
    'all_items'                     => __( 'All Keywords' ),
    'parent_item'                   => null,
    'parent_item_colon'             => null,
    'edit_item'                     => __( 'Edit Keywords' ), 
    'update_item'                   => __( 'Update Keywords' ),
    'add_new_item'                  => __( 'Add New Keyword' ),
    'new_item_name'                 => __( 'New Keyword Name' ),
    'separate_items_with_commas'    => __( 'Separate keywords with commas' ),
    'add_or_remove_items'           => __( 'Add or remove keywords' ),
    'choose_from_most_used'         => __( 'Choose from the most used keywords' ),
    'menu_name'                     => __( 'Keyword' ),
); 



register_taxonomy('search_keyword','tweet',array(
    'hierarchical'          => true,
    'labels'                => $labels_keyword,
    'show_ui'               => true,
    'update_count_callback' => '',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'search_keyword' ),
));


$labels_source = array(
    'name'                          => _x( 'Source', 'taxonomy general name' ),
    'singular_name'                 => _x( 'Source', 'taxonomy singular name' ),
    'search_items'                  => __( 'Search  Source' ),
    'popular_items'                 => __( 'Popular Source' ),
    'all_items'                     => __( 'All Source' ),
    'parent_item'                   => null,
    'parent_item_colon'             => null,
    'edit_item'                     => __( 'Edit Source' ), 
    'update_item'                   => __( 'Update Source' ),
    'add_new_item'                  => __( 'Add New Source' ),
    'new_item_name'                 => __( 'New Source Name' ),
    'separate_items_with_commas'    => __( 'Separate Source with commas' ),
    'add_or_remove_items'           => __( 'Add or remove Source' ),
    'choose_from_most_used'         => __( 'Choose from the most used Source' ),
    'menu_name'                     => __( 'Source' ),
); 



register_taxonomy('device_source','tweet',array(
    'hierarchical'          => true,
    'labels'                => $labels_source,
    'show_ui'               => true,
    'update_count_callback' => '',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'device_source' ),
    
));


$labels_source = array(
    'name'                          => _x( 'Tweet tag', 'taxonomy general name' ),
    'singular_name'                 => _x( 'Tweet tag', 'taxonomy singular name' ),
    'search_items'                  => __( 'Search  tweet tag' ),
    'popular_items'                 => __( 'Popular tweet tag' ),
    'all_items'                     => __( 'All tweet tag' ),
    'parent_item'                   => null,
    'parent_item_colon'             => null,
    'edit_item'                     => __( 'Edit tweet tag' ), 
    'update_item'                   => __( 'Update tweet tag' ),
    'add_new_item'                  => __( 'Add New tweet tag' ),
    'new_item_name'                 => __( 'New tweet tag Name' ),
    'separate_items_with_commas'    => __( 'Separate tweet tag with commas' ),
    'add_or_remove_items'           => __( 'Add or remove tweet tag' ),
    'choose_from_most_used'         => __( 'Choose from the most used tweet tag' ),
    'menu_name'                     => __( 'Tweet tag' ),
); 



register_taxonomy('tweet_tag','tweet',array(
    'hierarchical'          => true,
    'labels'                => $labels_source,
    'show_ui'               => true,
    'update_count_callback' => '',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'tweet_tag' ),
    
));


$labels_source = array(
    'name'                          => _x( 'Place', 'taxonomy general name' ),
    'singular_name'                 => _x( 'Places', 'taxonomy singular name' ),
    'search_items'                  => __( 'Search  Place' ),
    'popular_items'                 => __( 'Popular Places' ),
    'all_items'                     => __( 'All Place' ),
    'parent_item'                   => null,
    'parent_item_colon'             => null,
    'edit_item'                     => __( 'Edit Place' ), 
    'update_item'                   => __( 'Update Place' ),
    'add_new_item'                  => __( 'Add New Place' ),
    'new_item_name'                 => __( 'New Place Name' ),
    'separate_items_with_commas'    => __( 'Separate Place with commas' ),
    'add_or_remove_items'           => __( 'Add or remove Place' ),
    'choose_from_most_used'         => __( 'Choose from the most used Place' ),
    'menu_name'                     => __( 'Place' ),
); 



register_taxonomy('place','tweet',array(
    'hierarchical'          => true,
    'labels'                => $labels_source,
    'show_ui'               => true,
    'update_count_callback' => 'twistory_taxonomy_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'place' ),
    
));

  

}
add_action('init', 'tweeter_init');


//Rimuovo i meta box delle tassonomie dal singolo post
if (!function_exists('remove_hashtag_meta')):
	if (is_admin()) :
		function remove_twistory_box_taxomomy() {
			remove_meta_box( 'hashtagdiv' , 'tweet' , 'side' );
			remove_meta_box( 'device_sourcediv', 'tweet', 'side');
			remove_meta_box( 'search_keyworddiv' , 'tweet' , 'side' );
			remove_meta_box( 'postcustom', 'tweet', 'normal');
			remove_meta_box( 'authordiv', 'tweet', 'normal');
			remove_meta_box( 'postexcerpt', 'tweet', 'normal');
			remove_post_type_support( 'tweet', 'thumbnail' );
		}
		add_action( 'admin_menu' , 'remove_twistory_box_taxomomy' );
	endif;
endif; 

//Aggiungo post alla lista
if (!function_exists('view_more_tweet')):
	function view_more_tweet( $per_page ) {
	    //admin sees 25 posts per page
	    
	    $get_post_type = get_current_screen();
		    if ( $get_post_type->post_type == 'tweet' ){
		    	return 100;
		    }
	    return $per_page;
	}
	
	add_filter( 'edit_posts_per_page', 'view_more_tweet' );
endif;

//Aggiungo le Tassonomie al Post Type tweet
add_filter('manage_tweet_posts_columns', 'tweet_columns' );
add_action('manage_tweet_posts_custom_column', 'tweet_custom_column', 9, 2);

function tweet_columns($defaults) {
    $defaults['tweet_value'] = __('Tweet Value', 'twistory');
    $defaults['search_keyword'] = __('Search keyword', 'twistory');
    $defaults['hashtag'] = __('Hashtag', 'twistory');
    $defaults['device_source'] = __('Device source', 'twistory');
    $defaults['tweet_tag'] = __('Tweet tag', 'twistory');
    
    return $defaults;
}

function tweet_custom_column($column_name, $post_id) {

	if($column_name == 'tweet_value'){
		if(get_post_meta($post_id, 'tweet_value', true) != ''){
			$value = get_post_meta($post_id, 'tweet_value', true);
			echo '<img src="' . plugins_url('../images/' . $value . '_tweet.png' , __FILE__ ) . '">';
		}
	}else{
		$taxonomy = $column_name;
	    $post_type = get_post_type($post_id);
	    $terms = get_the_terms($post_id, $taxonomy);

	    if ( $terms ) {
	        foreach ( $terms as $term )
	            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
	        echo join( ', ', $post_terms );
	    }
	    else echo '<i>' . __('No terms', 'twistory') . '</i>';
	}
	
}

//Custom fields in Tweet post

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function twistory_custom_box() {

	add_meta_box('twistory_info_tweet', __( 'Info Tweet', 'twistory' ), 'twistory_custom_fields','tweet');
	add_meta_box('twistory_user_tweet', __( 'Info Author', 'twistory' ), 'twistory_author_fields','tweet');
	add_meta_box('twistory_graph_post', __( 'Graph', 'twistory' ), 'twistory_generate_graph','tweet_user_graph');
    
}
add_action( 'add_meta_boxes', 'twistory_custom_box' );

/*-----------------------------------------------------------------------------------*/
/* Print Tweet information */
/*-----------------------------------------------------------------------------------*/

function twistory_custom_fields( $post ) {

	  /*
	   * Use get_post_meta() to retrieve an existing value
	   * from the database and use the value for the form.
	   */
	  $tweet_id = get_post_meta( $post->ID, 'tweet_id', true );
	  $tweet_value = get_post_meta( $post->ID, 'tweet_value', true ); 
	  $retweet = get_post_meta( $post->ID, 'retweet_id', true );
	  $retweet_cont = get_post_meta( $post->ID, 'retweet_count', true ); 
	  $retweet_id = get_post_meta( $post->ID, 'retweeted_status_id', true);
	  $favorite_count = get_post_meta( $post->ID, 'favorite_count', true );
	  $hashtags = get_the_terms( $post->ID, 'hashtag' );
	  $searchwords = get_the_terms( $post->ID, 'search_keyword' );
	  $soureces = get_the_terms( $post->ID, 'device_source' );
	  $link_tweet = get_post_meta( $post->ID, 'link_tweet', true ); 
	  ?>
	  
	  <table class="widefat fixed">
	  	<tr valign="top" class="alternate">
			<th scope="row"><?php _e('Tweet', 'twistory'); ?></th>
			<td>
				<?php the_title(); ?>
			</td>
		</tr>
	  	<!--
<tr valign="top">
			<th scope="row"><?php _e('Tweet id', 'twistory'); ?></th>
			<td><?php echo $tweet_id; ?></td>
		</tr>
-->
		
		<tr valign="top">
			<th scope="row"><?php _e('Value of tweet', 'twistory'); ?></th>
			<td><table class="widefat fixed"><tr><td width="33%"><img src="<?php echo plugin_dir_url(__FILE__)?>../images/positive_tweet.png" alt="positive_tweet" width="20" height="20" /><input type="radio" name="tweet_value" value="positive" <?php checked( $tweet_value, 'positive' ); ?> />Positive </td><td width="33%"><img src="<?php echo plugin_dir_url(__FILE__)?>../images/neutral_tweet.png" alt="neutral_tweet" width="20" height="20" /><input type="radio" name="tweet_value" value="neutral" <?php checked( $tweet_value, 'neutral' ); ?> />Neutral</td><td width="33%"><img src="<?php echo plugin_dir_url(__FILE__)?>../images/negative_tweet.png" alt="negative_tweet" width="20" height="20" /><input type="radio" name="tweet_value" value="negative" <?php checked( $tweet_value, 'negative' ); ?> />Negative</td></tr></table></td>
		</tr>
		
		<tr valign="top" class="alternate">
			<th scope="row"><?php _e('ReTweet id of', 'twistory'); ?></th>
			<td><?php if($retweet): ?><?php  echo $tweet_id;?><?php endif; ?></td>
		</tr>
		
		<tr valign="top" >
			<th scope="row"><?php _e('Hashtag Usati', 'twistory'); ?></th>
			<td>
			<?php if ($hashtags): ?>
			<?php foreach ($hashtags as $hashtag):?>
						<a href="<?php echo get_bloginfo('url') . '/wp-admin/edit.php?post_type=tweet&hashtag=' . $hashtag->slug; ?>" ><?php echo '#' . $hashtag->name; ?> </a>
			 		  <?php endforeach; ?>
			<?php else: ?>
				<?php _e('Nessun Hashtag utlizzato', 'twistory'); ?>
			<?php endif; ?>
			</td>
		</tr>
		
		<tr valign="top" class="alternate">
			<th scope="row"><?php _e('Termine di ricerca', 'twistory'); ?></th>
			<td><?php foreach ($searchwords as $searchword):?>
						<a href="<?php echo get_bloginfo('url') . '/wp-admin/edit.php?post_type=tweet&search_keyword=' . $searchword->slug; ?>" ><?php echo $searchword->name; ?> </a>
			 		  <?php endforeach; ?></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Retweet Count', 'twistory'); ?></th>
			<td><?php echo $retweet_cont; ?></td>
		</tr>
		<tr valign="top" class="alternate">
			<th scope="row"><?php _e('Favorite id', 'twistory'); ?></th>
			<td><?php echo $favorite_count; ?></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Source of tweet', 'twistory'); ?></th>
			<td><?php foreach ($soureces as $source):?>
						<a href="<?php echo get_bloginfo('url') . '/wp-admin/edit.php?post_type=tweet&search_keyword=' . $source->slug; ?>" ><?php echo $source->name; ?> </a>
			 		  <?php endforeach; ?></td>
		</tr>
		<tr valign="top" class="alternate">
			<th scope="row"><?php _e('Tweet', 'twistory'); ?></th>
			<td><?php	
				if(!empty($tweet_id)):
				
				echo "https://api.twitter.com/1/statuses/oembed.json?id=" . $tweet_id . "&align=center";
				
				$ch = curl_init();
			
				// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_URL, "https://api.twitter.com/1/statuses/oembed.json?id=" . $tweet_id . "&align=center");
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				
				// grab URL and pass it to the browser
				$embed_tweet = curl_exec($ch);
				
				// close cURL resource, and free up system resources
				curl_close($ch);
			   
				
				 $embed_tweet = json_decode($embed_tweet);
				 echo $embed_tweet->html;
				 
				 endif; ?></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Tweet retweet', 'twistory'); ?></th>
			<td><?php
			
				echo "https://api.twitter.com/1/statuses/oembed.json?id=" . $retweet_id . "&align=center";
				
				if(!empty($retweet_id)):
				$ch = curl_init();
			
				// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_URL, "https://api.twitter.com/1/statuses/oembed.json?id=" . $retweet_id . "&align=center");
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				
				// grab URL and pass it to the browser
				$embed_tweet = curl_exec($ch);
				
				// close cURL resource, and free up system resources
				curl_close($ch);
			   
				
				 $embed_tweet = json_decode($embed_tweet);
				 echo $embed_tweet->html;
				 
				 endif; ?></td>
		</tr>
		<?php if ($link_tweet): ?>
			<tr valign="top" class="alternate">
				<th scope="row"><?php _e('Link Tweet', 'twistory'); ?></th>
				<td><?php foreach($link_tweet as $link):?><a href="<?php echo $link;?>" target="_BLANK"><?php echo $link?> </a><?php endforeach; ?></td>
			</tr>
		<?php endif; ?>
	  </table> 

<?php  }

/*-----------------------------------------------------------------------------------*/
/* Print Author information */
/*-----------------------------------------------------------------------------------*/

function twistory_author_fields( $post ) {
	//Blocco Utente 
	$author_id = $post->post_author;
	$author_info = get_user_meta($author_id); 
	$post_meta_author = get_post_meta($post->ID, 'tweet_user_data', true); 
	?>	
		<h2><?php _e('Author name', 'twistory');?>: <a href="<?php echo get_bloginfo('url') . '/wp-admin/edit.php?post_type=tweet&author=' . $author_id; ?>"><?php echo the_author_meta( 'display_name' , $author_id ); ?></a></h2>
		<h2><?php _e('Status during this tweet', 'twistory');?></h2>
		  <table class="widefat fixed">
			<tr valign="top" class="alternate">
				<th scope="row"><?php _e('Followers count', 'twistory'); ?></th>
				<td><?php echo $post_meta_author['followers_count']; ?></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Friends count', 'twistory'); ?></th>
				<td><?php echo $post_meta_author['friends_count']; ?></td>
			</tr>
			<tr valign="top" class="alternate">
				<th scope="row"><?php _e('Tweet Number (Include Retweets)', 'twistory'); ?></th>
				<td><?php echo $post_meta_author['statuses_count']; ?></td>
			</tr>
		  </table>
		  <h2><?php _e('Last update', 'twistory');?></h2>
		  <table class="widefat fixed">
			<tr valign="top" class="alternate">
				<th scope="row"><?php _e('Followers count', 'twistory'); ?></th>
				<td><?php echo $author_info['followers_count'][0]; ?></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Friends count', 'twistory'); ?></th>
				<td><?php echo $author_info['friends_count'][0]?></td>
			</tr>
			<tr valign="top" class="alternate">
				<th scope="row"><?php _e('Tweet Number (Include Retweets)', 'twistory'); ?></th>
				<td><?php echo $author_info['statuses_count'][0]?></td>
			</tr>
		  </table>
		  
		  
<?php }

/*-----------------------------------------------------------------------------------*/
/* Add print graph for tweet_user_graph post type */
/*-----------------------------------------------------------------------------------*/

function twistory_generate_graph( $post ){
	
	$array_graph = get_post_meta($post->ID, 'array_graph');
	
	//print_r($array_graph);
	
	$count_report_graph = 1;
	foreach($array_graph as $array_report): ?>
	<?php //echo maybe_serialize($array_report); ?>
	<?php $id_postmeta =  get_mid_by_key_value($post->ID, 'array_graph', maybe_serialize($array_report)); ?>
	<script type="text/javascript">
	<?php if($array_report['type'] == 'column' || $array_report['type'] == 'spline'): //Check for spline or column ?>
	jQuery(function () {
        jQuery('#container_<?php echo $array_report['type']; ?>_<?php echo $count_report_graph; ?>').highcharts({
            chart: {
            	type: '<?php echo $array_report['type']; ?>',
                renderTo: 'container',
				zoomType: 'xy',
				backgroundColor: '#FFFFFF',
				shadow: true
            },
            title: {
                text: '<?php _e('Timeline', 'twistory');?>'
            },
            subtitle: {
                text: '<?php _e('From', 'twistory');?>: <?php echo $array_report['from']; ?> - <?php _e('To', 'twistory');?>: <?php echo $array_report['to']; ?>'
            },
            xAxis: {
            	maxZoom: 2,
                categories: [<?php 
                				$i = 0;
                				foreach ($array_report['array_with_date'] as $date => $value):
									
									
									if($i == 0):
										echo "'" . $date . "'";
									else: 
										echo ", '" . $date . "'";
									endif; 
								$i++;
								endforeach; ?>]
            },
            yAxis: {
                title: {
                    text: '<?php _e('Number of tweet', 'twistory'); ?>'
                }
            },
            tooltip: {
                enabled: true,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                },
               
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false,
                    
                    
                }
            },
            series: [
            <?php
           
             
            
         
            $check_count = 1;
            foreach($array_report['array_term_count'] as $term_key => $term):
            

				
					if ($check_count == 1){
						echo '{' . "\n";
					}else{
						echo ', {' . "\n"; 
					} 
					echo 'name: "' . $term_key . '",' . "\n";
				
				
				
				
				echo 'data: [';
				$check_separetor = 1;
				foreach ($array_report['array_with_date'] as $date => $value):
					
					
					$number_tweet =  $array_report['array_with_date']->$date->$term_key;
					if ($number_tweet == ''):
						$number_tweet = 0;
					endif;
					
					if ($check_separetor == 1):
						$number_tweet =  $number_tweet;
					else:
						$number_tweet = ',' . $number_tweet;
					endif;
					
					
				echo $number_tweet;
				
				$check_separetor++;
				endforeach;
				echo ']' .  "\n"; 
	
				echo '}';
				
				$check_count++;
            endforeach;
            ?>]
        });
    });
    
    <?php elseif($array_report['type'] == 'pie'): 
	    
	    foreach($array_report['array_term_count'] as $value):
			
			$total_tweet = $total_tweet + $value;
		
		endforeach;
	    
	    
    ?>
    jQuery(function () {
			    jQuery('#container_<?php echo $array_report['type']; ?>_<?php echo $count_report_graph; ?>').highcharts({
			        chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: null,
			            plotShadow: false
			        },
			        title: {
			            text: '<?php _e('Total percentage for the selected dates', 'twistory'); ?>'
			        },
			        tooltip: {
			    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			        },
			        plotOptions: {
			            pie: {
			                allowPointSelect: true,
			                cursor: 'pointer',
			                dataLabels: {
			                    enabled: true,
			                    color: '#000000',
			                    connectorColor: '#000000',
			                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
			                }
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Browser share',
			            data: [<?php
			            	$check_first = 0;
			            	
			            	
			            	
				            foreach ($array_report['array_term_count'] as $term_key => $value):
				            $percentage = (100 * $value) / $total_tweet;
				            if ($check_first == 0): ?>
				            	
				            	{
			                    	name: '<?php echo $term_key ?>',
									y: <?php echo $percentage; ?> ,
									sliced: true,
									selected: true
								}
				            	
				           <?php  else: ?>
				            	,['<?php echo $term_key ?>',   <?php echo $percentage; ?>]
				            <?php endif; 
				            
				            $check_first++;
				            
				            endforeach;
							
							?>
			                
			            ]
			        }]
			    });
			});
    
    <?php endif; ?>

		</script>

<div id="loading_<?php echo $count_report_graph; ?>"></div>

<div id="container_<?php echo $array_report['type']; ?>_<?php echo $count_report_graph; ?>">
</div>
<a class="href_delete" data-post="<?php echo get_the_id(); ?>" data-id="<?php echo $count_report_graph; ?>" data-value='<?php echo $id_postmeta; ?>' ><?php _e('Delete graph', 'twistory')?></a>

<hr/>
<?php $count_report_graph++; endforeach; ?>

<script src="<?php echo plugins_url( 'lib/highchart/js/highcharts.js' , dirname(__FILE__) ) ?>"></script>
<script src="<?php echo plugins_url( 'lib/highchart/js/modules/exporting.js' , dirname(__FILE__) ) ?>"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".href_delete").click(function(){
			var id_postmeta = jQuery(this).attr('data-value');
			var id_post = jQuery(this).attr('data-post');
			var id_div = jQuery(this).attr('data-id');
			var type_container = '<?php echo $array_report['type']; ?>'
			
    jQuery('<div></div>').appendTo('body')
                    .html('<div><h2>Are you sure you want to delate this graph?</h2></div>')
                    .dialog({
                    	dialogClass: 'wp-dialog', 
                        modal: false, title: 'Delete message', zIndex: 10000, autoOpen: true,
                        width: '400', resizable: false,
                        buttons: {
                            Yes: function () {
								jQuery(this).dialog("close");
								var ajaxurl = '<?php echo admin_url("admin-ajax.php", null); ?>';
								data = { action: "delete_post_meta_graph", id_postmeta: id_postmeta, id_post: id_post };
								jQuery.ajax({
									url:ajaxurl,
									type:'post',
									dataType: 'html',
									data: data,
									beforeSend: function() {
									    jQuery('#loading_' + id_div).show().html('<span class="loading"><img alt="Loading tweet..." src="' + "<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" + '" /> Loading...</span>');
									  },
									success:function(response) {
										if(response == 'true'){
											
											jQuery('#loading_' + id_div + ' span.loading').hide();
											jQuery('<div class="updated ok_delete' + id_div + ' below-h2"><p><?php _e('Graph deleted.', 'twistory'); ?></p></div>').hide().appendTo('#loading_' + id_div).fadeIn(1000);
											jQuery("a[data-post='" + id_post + "']").hide();
											jQuery('#container_' + type_container + '_' + id_div).fadeOut(1000);
											jQuery('.ok_delete' + id_div).delay(1500).fadeOut(1000);
											
										}else{
											
											jQuery('#loading_' + id_div + ' span.loading').hide();
											jQuery('<div class="error below-h2"><p><?php _e('Error try again.', 'twistory'); ?></p></div>').hide().appendTo('#loading_' + id_div).fadeIn(1000);
								
											
										}
	
									}
								});

                                
                            },
                            No: function () {
                                jQuery(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            jQuery(this).remove();
                        }
                    });

   	});  
   	
   	});
	
	
	
</script>
	
	
	
<?php }

/*-----------------------------------------------------------------------------------*/
/* Add post status for archive post */
/*-----------------------------------------------------------------------------------*/

function twistory_custom_post_status(){
     register_post_status( 'archive', array(
          'label'                     => _x( 'Archive', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => true,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Archive <span class="count">(%s)</span>', 'Archive <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'twistory_custom_post_status' );


add_action('admin_footer-post.php', 'twistory_append_post_status_list');
function twistory_append_post_status_list(){
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'tweet'){
          if($post->post_status == 'archive'){
               $complete = ' selected=\"selected\"';
               $label = '<span id=\"post-status-display\"> Archived</span>';
          }
          echo '
          <script>
          jQuery(document).ready(function($){
               $("select#post_status").append("<option value=\"archive\" '.$complete.'>Archive</option>");
               $(".misc-pub-section label").append("'.$label.'");
          });
          </script>
          ';
     }
}

function twistory_display_archive_state( $states ) {
     global $post;
     $arg = get_query_var( 'post_status' );
     if($arg != 'archive'){
          if($post->post_status == 'archive'){
               return array('Archive');
          }
     }
    return $states;
}
add_filter( 'display_post_states', 'twistory_display_archive_state' );


function twistory_append_post_status_bulk_edit() {

echo '<script type="text/javascript">' . "\n";
echo 'jQuery(document).ready(function($){' . "\n";
echo '$(".inline-edit-status select ").append("<option value=\"archive\">Archive</option>");' . "\n";
echo '});' . "\n";
echo '</script>' . "\n";

}

add_action( 'admin_footer-edit.php', 'twistory_append_post_status_bulk_edit' );


/**
* Step 1: add the custom Bulk Action to the select menus
*/
function custom_bulk_admin_footer() {
    global $post_type;
    
    if($post_type == 'tweet') {
    	?>
    		<script type="text/javascript">
    			jQuery(document).ready(function() {
    				jQuery('<option>').val('export').text('<?php _e('Export')?>').appendTo("select[name='action']");
    				jQuery('<option>').val('export').text('<?php _e('Export')?>').appendTo("select[name='action2']");
    			});
    		</script>
    	<?php
    }
}
add_action('admin_footer-edit.php', 'custom_bulk_admin_footer');


/*-----------------------------------------------------------------------------------*/
/* Function on save post */
/*-----------------------------------------------------------------------------------*/

/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The ID of the post.
 */
function save_tweet_meta( $post_id ) {

    //verify post is not a revision
	if ( !wp_is_post_revision( $post_id ) ) {

    $post_obj = get_post($post_id);
	
	$post_title = $post_obj->post_title;
    $post_type = $post_obj->post_type;
    $post_status = $post_obj->post_status;

	    if(($post_type == "tweet") && ($post_status != "auto-draft") && ($post_status != "trash")  && ($post_title != "") ){
		    
		    //Update the tweet value
		    if ( isset( $_REQUEST['tweet_value'] ) ){
		    
			 	update_post_meta( $post_id, 'tweet_value', $_REQUEST['tweet_value']);
			 	
			 	//Verify if is tweet or retweet
			 	$retweet_id = get_post_meta( $post_id, 'retweeted_status_id', true);
			 	
			 	
			 	if($retweet_id == ''){
			 		//If tweet update the value for all retweet
			 		$tweet_id = get_post_meta( $post_id, 'tweet_id', true );
				 	
				 	//Get all retweet 
				 	$args = array(
					   'post_type' => 'tweet',
					   'post_status' => array( 'publish', 'private', 'archive' ),
					   'meta_query' => array(
					       array(
					           'key' => 'retweeted_status_id',
					           'value' => $tweet_id,
					           'compare' => '=',
					       )
					   ),
					   'posts_per_page' => -1
					 );

					 query_posts($args);
			 	
				 	if(have_posts()): while(have_posts()): the_post();
				 	
					 	$retweet_post_id = get_the_ID();
					 	//Update all retweet
					 	update_post_meta( $retweet_post_id, 'tweet_value', $_REQUEST['tweet_value']);
				 
				 	endwhile; endif;
			 	
			 	}else{
					//If retweet update all retweet and tweet
					
					//Get all retweet
					$args = array(
					   'post_type' => 'tweet',
					   'post_status' => array( 'publish', 'private', 'archive' ),
					   'meta_query' => array(
					   		'relation' => 'OR',
						     array(
						           'key' => 'retweeted_status_id',
						           'value' => $retweet_id,
						           'compare' => '=',
						       ),
						     array(
						           'key' => 'tweet_id',
						           'value' => $retweet_id,
						           'compare' => '=',
						       )
					   ), 
					   'posts_per_page' => -1
					);

					query_posts($args);
			 	
				 	if(have_posts()): while(have_posts()): the_post();
				 	
					 	$retweet_post_id = get_the_ID();
					 	
					 	//Update all retweet and tweet
					 	update_post_meta( $retweet_post_id, 'tweet_value', $_REQUEST['tweet_value']);
				 
				 	endwhile; endif;
					
			 	}
			 	 
		    }
		    
		}
	
    
	}

}

add_action( 'save_post', 'save_tweet_meta' );



/*-----------------------------------------------------------------------------------*/
/* Update custom taxonomy */
/*-----------------------------------------------------------------------------------*/


function twistory_taxonomy_count( $terms, $taxonomy ) {
	global $wpdb;

	foreach ( (array) $terms as $term ) {

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

		do_action( 'edit_term_taxonomy', $term, $taxonomy );
		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
		do_action( 'edited_term_taxonomy', $term, $taxonomy );
	}
}

