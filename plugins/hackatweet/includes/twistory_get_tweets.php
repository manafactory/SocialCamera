<?php
/*-----------------------------------------------------------------------------------*/
/* This function gets tweet from twetter with rest api called from cron */
/*-----------------------------------------------------------------------------------*/


function shuffle_assoc(&$array) {
  $keys = array_keys($array);
  shuffle($keys);
  foreach($keys as $key) {
    $new[$key] = $array[$key];
  }
  $array = $new; 
  return $array;
}

add_action('twistory_event', 'twistory_get_tweets');


function twistory_getit($options_search, $limite=10){

  $options_search = array_slice($options_search, 0, $limite);
$array_check = 1;
echo "entro in funzione";
    print_r($options_search);


			//	  	  	  if(true):
			//Check if app key isset otherwise kill process
			if ( get_option( 'option_app_twistory'  ) !== false ):
					$option_app = get_option('option_app_twistory');
					
					$settings = array(
					    'oauth_access_token'          => $option_app['oauth_access_token'],
					    'oauth_access_token_secret'   => $option_app['oauth_access_token_secret'],
					    'consumer_key'                => $option_app['consumer_key'],
					    'consumer_secret'             => $option_app['consumer_secret']
					);
					
					
			else:
			
				return;
				 
			endif;; 
			
			/** Perform a GET request and echo the response **/
			/** Note: Set the GET field BEFORE calling buildOauth(); **/
			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			
			//Get option is search is AND or OR
			if ( get_option( 'twistory_type_search'  ) !== false ):
				$search_mode = get_option('twistory_type_search');
			else : 
				$search_mode = 'OR';	
			endif;
			
			//Recupero I termini di ricerca e li inseriso nella query twitter 
			
			$contami=0;
			foreach($options_search as $key => $option):
			$contami++;
		
			//	if($contami > $limite)
			//  break;
			$option = "\"".urlencode("".$option."")."\"";
			//			$option = str_replace(" ","%20",$option);
			if($array_check == 1){
			  $serch_words .= $option; 
			}else{
			  $serch_words .= '+' . $search_mode . '+' . $option;
			}
			
			$array_check++;
			
			endforeach;
			global $wpdb;
			$query_tweet_id = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'tweet_id' ORDER BY meta_value DESC LIMIT 1", 'tweet_id', 'meta_value', 1));
			
			//Verifico che non sia il primo ciclo
			
			if(!empty($query_tweet_id)):
				foreach ($query_tweet_id as $id):
			  		$since_id = $id->meta_value;
				endforeach;
				
				//				$getfield = '?q=' . $serch_words . '&count=100&include_entities=true&since_id=' . $since_id;
				$getfield = '?q=' . $serch_words . '&count=100&include_entities=true';
			else:
				//Essendo il primo ciclo recpero tutti e 100 i tweet
				$getfield = '?q=' . $serch_words . '&count=100&include_entities=true';
			endif;
			//Verifico se è stata salvata una tipologia di ricerca se si la inserisco.
			if ( get_option( 'twistory_result_type'  ) !== false ):
				$getfield .= '&result_type=' . get_option( 'twistory_result_type'  );
			endif;
			
			//Verifico se è stata salvata l'impostazione geografica.
			if ( get_option( 'twistory_geo'  ) !== false ):
				
				$geo_tag = get_option( 'twistory_geo'  );
				
				$lat    = $geo_tag['lat'];
				$long   = $geo_tag['long'];
				$radius = $geo_tag['radius'];
				$unit   = $geo_tag['unit'];
				$lang   = $geo_tag['lang'];
				
				$getfield .= '&geocode=' . $lat . ',' . $long . ',' . $radius . $unit ;
			endif;
			if($lang)
			  $getfield .= '&lang='.$lang."&locale=".$lang;
	
			echo $getfield;
			//			return;
			$requestMethod = 'GET';
		
			//			echo $url;	
			//Eseguo la richiesta a twitter
			//			print_r($settings);
			$twitter = new TwitterAPIExchange($settings);
			$response = $twitter->setGetfield($getfield)
			                    ->buildOauth($url, $requestMethod)
			                    ->performRequest();
			                    
			$response = json_decode($response); 
			
			echo('<pre>');
				print_r($response);
			echo('</pre>');
			//return;
						
			//Elaboro la risposta
			if (!empty($response->statuses)):
				$tweets = $response->statuses;
				foreach($tweets as $tweet):
									
					
					//Recupero çe informazioni utente verifico se l'utente esiste o meno
					//Se l'utente non esiste lo inserisco 
					//Se l'utente esiste verifico che i campi usermeta siano aggiornati
					$user = $tweet->user;
					$user_id = username_exists( $user->screen_name );
					if ( !$user_id ) {
						$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
						$user_id = wp_insert_user( array (
										'user_url'    => $user->url,
										'user_login'  => $user->screen_name,
										'user_pass'   => $random_password,
										'first_name'  => $user->name,
										'description' => $user->description,
										'role'        => 'twitterer'
									   ) );
					
						//Aggiungi i post meta
						add_user_meta( $user_id, 'followers_count', $user->followers_count ); 	   	
						add_user_meta( $user_id, 'friends_count', $user->friends_count );
						add_user_meta( $user_id, 'listed_count', $user->listed_count );
						add_user_meta( $user_id, 'created_at', $user->created_at );
						add_user_meta( $user_id, 'favourites_count', $user->favourites_count );
						add_user_meta( $user_id, 'utc_offset', $user->utc_offset );
						add_user_meta( $user_id, 'time_zone', $user->time_zone );
						add_user_meta( $user_id, 'geo_enabled', $user->geo_enabled );
						add_user_meta( $user_id, 'statuses_count', $user->statuses_count );
						add_user_meta( $user_id, 'lang', $user->lang );
						add_user_meta( $user_id, 'profile_image_url', $user->profile_image_url );
				
					} else {
						//verifico se gli usermeta sono aggiornati 
						
						//Followers_count
						$followers_count = get_user_meta( $user_id, 'followers_count', true );
						if ($user->followers_count != $followers_count ){
							update_user_meta($user_id, 'followers_count', $user->followers_count);
						}
						//Friends_count
						$friends_count = get_user_meta( $user_id, 'friends_count', true );
						if ($user->friends_count != $friends_count){
							update_user_meta( $user_id, 'friends_count', $user->friends_count); 
						}
						//Listed_count
						$listed_count = get_user_meta( $user_id, 'listed_count', true );
						if ($user->listed_count != $listed_count){
							update_user_meta($user_id, 'listed_count', $user->listed_count);
						}
						//Statuses_count
						$statuses_count = get_user_meta( $user_id, 'statuses_count', true );
						if ($user->statuses_count != $statuses_count){
							update_user_meta($user_id, 'statuses_count', $user->statuses_count);
						}
						//Profile_image_url
						$profile_image_url = get_user_meta( $user_id, 'profile_image_url', true );
						if ($user->profile_image_url != $profile_image_url){
							update_user_meta($user_id, 'profile_image_url', $user->profile_image_url);
						}
						
					}
				
					//TODO Sistemaere data
					$created_at = $tweet->created_at;
					
					$gmtoffset = get_option('gmt_offset');
					//echo "---gmt: ".$gmtoffset;
					$dategmt = date("Y-m-d H:i:s", strtotime($created_at));
					//echo "---gmt: ". $dategmt;
					$tsoffset = ($gmtoffset * 60 * 60);
					$datelocal  = date("Y-m-d H:i:s", strtotime($created_at)+$tsoffset);
					//echo "---gmt: ". $datelocal;
					
					//Creo il post come post type twitter
					
					// Create post object
					
					$new_tweet = array(
					  'post_title'    => $tweet->text,
					  'post_author'   => $user_id,
					  'post_type'     => 'tweet',
					  'post_status'   => 'private',
					  'post_date_gmt' => $dategmt,
					  'post_date' => $datelocal
					);
					

					
					// Insert the post into the database
					$new_tweet = apply_filters("twistory_args_insert_post", $new_tweet);
					// controllo se non esiste gia					
					
					$check_tweet_id = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'tweet_id' AND meta_value = '".$tweet->id."' ORDER BY meta_value DESC LIMIT 1");
					if(!$check_tweet_id){
					  $post_id = wp_insert_post( $new_tweet );		
					  
					}else{
echo "TWEET ESISTENTE";
					  continue;
					}
			
					echo "INSERITO POST CON ID ".$post_id;


					add_post_meta($post_id, 'tweet_id', $tweet->id, true);
					
					
					//Inserisco le tassonomie hashtag
					
					$entities = $tweet->entities;
					
					if (!empty($entities->hashtags)){
						foreach($entities->hashtags as $hashtag):
							//wp_set_object_terms( $post_id, $hashtag->text, 'hashtag' );
							
							$term = term_exists($hashtag->text, 'hashtag');
							if ($term !== 0 && $term !== null) {
								$term_id = $term['term_id'];
								$term_id = intval($term_id);
								wp_set_object_terms( $post_id, $term_id, 'hashtag', true );
							}else{
								wp_set_object_terms( $post_id, $hashtag->text, 'hashtag', true );
							}
							
						endforeach;
			
					}
					
					//Inserisco le tassonomie source
					
					$source = $tweet->source;
					
					if (!empty($source)){
									
							$term = term_exists($source, 'device_source');
							if ($term !== 0 && $term !== null) {
								$term_id = $term['term_id'];
								$term_id = intval($term_id);
								wp_set_object_terms( $post_id, $term_id, 'device_source', true );
							}else{
								wp_set_object_terms( $post_id, $source, 'device_source', true );
							}
			
					}
					
					//Verifico qual'è la tassonomia che ha prodotto il risultato di ricerca del tweet e lo aggiungo a tassonomia.
			
					//$options_search = get_hashtag_list();
					/*
					echo "dopo in funzione";
					print_r($options_search);
					*/
					foreach ($options_search as $key => $option):
					//					echo "....creoooo ".$option;
					  // per ogni chiave controllo se presente nel contenuto
					  //					$pos = stripos(strtolower(str_replace(" ","",str_replace("_","",str_replace("-","",str_replace(".","",$tweet->text))))), strtolower(str_replace(" ","",str_replace("_","",str_replace("-","",str_replace(".","",$option))))));
					  
					  echo "<hr><pre>Controllo se dentro ".$tweet->text." trovo ".$option." nel tweet ".get_the_title($post_id)." con id: ".$post_id."</pre><hr>";
					  $pos = stripos(str_replace(" ","",str_replace("_","",str_replace("-","",str_replace(".","",$tweet->text)))), str_replace(" ","",str_replace("_","",str_replace("-","",str_replace(".","",$option)))));
					  
					  if ($pos === false) {
					    // non trovato
					  } else {
					    $term = term_exists($option, 'search_keyword');
					    if ($term !== 0 && $term !== null) {
					      $term_id = $term['term_id'];
					      $term_id = intval($term_id);
					      wp_set_object_terms( $post_id, $term_id, 'search_keyword', true );
					    }else{
					      wp_set_object_terms( $post_id, $option, 'search_keyword', true );
					      
					      $term = term_exists($option, 'search_keyword');
					      $term_id = $term['term_id'];
					      $term_id = intval($term_id);
					      
					      //wp_update_term($term_id, 'search_keyword', array( 'description' => $key ));
					      
					      
					      
					    }
					  }
					  
							
						 
					endforeach;
					
					//Aggiungo i postmeta
					
					//Tweet ID
					add_post_meta($post_id, 'tweet_id', $tweet->id, true);
					
					//Replay Status
					if(!empty($tweet->in_reply_to_status_id)):
						add_post_meta($post_id, 'in_reply_to_status_id', $tweet->in_reply_to_status_id, true);
					endif;
					
					//Geo
					if(!empty($tweet->geo)):
						add_post_meta($post_id, 'geo_tweet', $tweet->geo, true);
					endif;
					print_r($tweet->place);
					//Place
					if(!empty($tweet->place)):
						$place = $tweet->place;
						print_r($tweet->place);
						if(get_term_by( 'slug', $place->id, 'place' ) == false):
							$json_bounding_box = json_encode($place->bounding_box);
							$id_place = wp_insert_term(
										  $place->name, // the term 
										  'place', // the taxonomy
										  array(
										    'description'=> $json_bounding_box,
										    'slug' => $place->id
										  )
										);
							wp_set_object_terms($post_id, intval($id_place['term_id']), 'place', true);
						else: 
							$term_place_id = get_term_by( 'slug', $place->id, 'place' );
							wp_set_object_terms($post_id, intval($term_place_id->term_id), 'place', true);
						endif;

					endif;
					
					//Retweet_count
					if(!empty($tweet->retweet_count)):
						add_post_meta($post_id, 'retweet_count', $tweet->retweet_count, true);
					endif;
					
					//Favorite_count
					if(!empty($twee->favorite_count)):
						add_post_meta($post_id, 'favorite_count', $tweet->favorite_count, true);
					endif;
					//Lang
					if(!empty($tweet->lang)):
						add_post_meta($post_id, 'tweet_lang', $tweet->lang, true);
					endif;
					
					//Retweet
					if(!empty($tweet->retweeted_status)):
						$info_retweet = $tweet->retweeted_status;
						add_post_meta($post_id, 'retweeted_status_id', $info_retweet->id_str, true);
						
						
						// Check if first tweet exists if exists update postmeta  retweet_count
						$args_check_retweet = array(
						   'post_type'        => 'tweet',
						   'post_status'      => array('private', 'publish', 'archive'),
						   'meta_query'       => array(
						       'relation'     => 'OR',
							    array(
							           'key'     => 'retweeted_status_id',
							           'value'   => $info_retweet->id_str,
							           'compare' => '=',
							   ),
						       array(
						           'key'      => 'tweet_id',
						           'value'    => $info_retweet->id_str,
						           'compare'  => '=',
						       )
						   ),
						   'post__not_in'     => $post_id,
						   'posts_per_page'   => -1
						 );
						
						
						
						$check_retweet = get_posts($args_check_retweet);//new WP_Query($args_check_retweet);
						
						//print_r($check_retweet);
						
						if(!empty($check_retweet)):
						
							foreach ($check_retweet as $tweet_post):
								
								update_post_meta($tweet_post->ID, 'retweet_count', $tweet->retweet_count);
							
							endforeach;
						
						endif;
						
						wp_reset_query();
					endif;
					//Link e media
					//Recuoero la variabile entities gia valorizzata e ne estraggo le url
					if (!empty($entities->urls)):
						$array_link = array();
						foreach ($entities->urls as $url):
							$array_link[] = $url->expanded_url;
						endforeach;
						add_post_meta($post_id, 'link_tweet', $array_link, true);
					endif;
					
					//Genero Un postemeta con i dati serializzati per lo stato dell'utente
					$user_tweet_meta = array();
					$user_tweet_meta['followers_count'] = $user->followers_count;
					$user_tweet_meta['friends_count'] = $user->friends_count;
					$user_tweet_meta['statuses_count'] = $user->statuses_count;
					add_post_meta($post_id, 'tweet_user_data', $user_tweet_meta, true);
					
					//Se un retweet verifico se attribuito un valore al tweet e lo attribisco al retweet altrimeni imposto un valore neutrale
					if($info_retweet):
					
						$id_post_tweet = get_post_id_by_meta_key_and_value('tweet_id', $info_retweet->id_str);	
						
						echo $id_post_tweet;
						$tweet_value = get_post_meta($id_post_tweet, 'tweet_value', true);
						if($tweet_value != 'neutral'):
							add_post_meta($post_id, 'tweet_value', $tweet_value, true);
						else:
							add_post_meta($post_id, 'tweet_value', 'neutral', true);
						endif;
					
					else:
						add_post_meta($post_id, 'tweet_value', 'neutral', true);
					endif;
					
				endforeach;
				
			endif;




}
	
if(!function_exists('twistory_get_tweets')):
	function twistory_get_tweets(){
	
		$options_search = get_hashtag_list();
					$options_search =  shuffle_assoc($options_search);
			
			if ( get_option('twistory_on_off') !== false && get_option('twistory_on_off') == 'on' ){

			  twistory_getit($options_search, 18); 

			}

		
	}
	
endif;