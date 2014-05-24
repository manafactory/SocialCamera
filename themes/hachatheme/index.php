<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();
get_header(); 
if(is_front_page()){
		?>


	<div id="primary">


<br><br>
<center>    <h1>I pi&ugrave; "chiacchierati" del momento su twitter</h1></center>	


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style="background-color:#FFE500;" >

				<div class="entry-content container ">




		<?php $args = array(
			'orderby' => 'count',
			'number'        => 6,
			'order' => 'DESC'
		); 
		?>	
		 
		
		<?php $terms = get_terms( 'search_keyword', $args );
//		 print_r($terms); 
		foreach($terms as $persona): ?>
		<?php $url_img = $persona->description;
		
		$immagine = get_option($url_img);
		if($immagine == ''): 
		
			require_once(get_template_directory() . "/lib/EasyRdf.php");
			require_once(get_template_directory() . "/lib/html_tag_helpers.php");
			$graph = new EasyRdf_Graph($url_img);
			$graph->load($url_img, 'guess');					
			// Lookup the output format
			$format = EasyRdf_Format::getFormat('json');
			// Serialise to the new output format
			$output = $graph->serialise($format);
			$output = json_decode($output);
			$img_parlamentare = $output->{$url_img}->{'http://xmlns.com/foaf/0.1/depiction'}[0]->value;
			
			update_option($url_img, $img_parlamentare);
			$immagine = $img_parlamentare;
			
		endif; ?>
<div id="author-info" style="max-width: 450px; margin:auto; padding-bottom:10px;"><a href="<?php echo get_term_link((int)$persona->term_id, "search_keyword"); ?>"><img alt="" src="<?php echo $immagine; ?>" class="avatar avatar-80 photo img-circle" height="80" width="80"></a><div class="author-text" style="text-align:center;"><h1><a href="<?php echo get_term_link((int)$persona->term_id, "search_keyword"); ?>"><?php echo $persona->name; ?></a></h1><h5>Tweet Collezionati: <b><?php echo  $persona->count; ?></b></h5>
</div></div>

			<?php endforeach; 
?>



<center><h3><a href="<?php bloginfo('url'); ?>/classifica/">Classifica completa >></a></h3>
</div>
</article>





																						<br><br>																																										<center><h1>Temi "caldi" su Twitter</h1></center>
 




			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style="background-color:#55ACEE;" >

				<div class="entry-content container hometag">
		<?php
											$args = array('taxonomy'  => array('hashtag'), 'largest' => 30, 'number' => 40, 'orderby' => "count", 'order'=> "DESC"); 
wp_tag_cloud($args);
		?>	






<center><h3><a href="<?php bloginfo('url'); ?>/hashtag-cloud/" style="color:#fff !important;">Lista completa >></a></h3>
		 
</div>

</article>

<br><br>


<center><h1>Gli ultimi Tweet</h1></center>
 

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;

			bavotasan_pagination();
		else :
			?>
			<article id="post-0" class="post no-results not-found">


				

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
				?>
				<h1 class="entry-title"><?php _e( 'No posts to display', 'ward' ); ?></h1>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'ward' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

				<?php
			else :
				get_template_part( 'content', 'none' );
			endif; // end current_user_can() check
			?>

			</article><!-- #post-0 -->
		    <?php
		endif;
		?>
	</div>
	<?php }	?>
<?php get_footer(); ?>