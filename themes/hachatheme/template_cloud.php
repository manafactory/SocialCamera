<?php


/*
Template Name: Cloud page
*/

get_header();

function hack_tag_text_callback( $count ) {
  return sprintf( _n('%s Tweet', '%s Tweet', $count), number_format_i18n( $count ) );
}

?>
	<div id="primary" <?php bavotasan_primary_attr(); ?>>
		<?php
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    <div class="entry-content cloud-hashtag" >
					    <?php the_content( __( 'Read more &rarr;', 'ward' ) ); ?>
<br><br>
<div style="text-align:center;">
					<?php




  $args = array('taxonomy'  => array('hashtag'), 'largest' => 34, 'number' => 300, 'orderby' => "count", 'order'=> "DESC",'topic_count_text_callback' => 'hack_tag_text_callback', 'separator' => " <span class='csep'>#</span> "); 

wp_tag_cloud($args);

?>
</div>
<center>
<h3><a href="<?php bloginfo('url'); ?>/grafico-hashtag">Mostra grafico con le percentuali >></a></h3>
</center>

				    </div><!-- .entry-content -->

				    <?php get_template_part( 'content', 'footer' ); ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				     //			comments_template( '', true );
		endwhile;
		?>
	</div>

<?php get_footer(); ?>