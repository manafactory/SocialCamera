<?php
/**
 * The template for displaying article headers
 *
 * @since 1.0.6
 */
$bavotasan_theme_options = bavotasan_theme_options();
$display_categories = $bavotasan_theme_options['display_categories'];

$hashtag_terms = wp_get_object_terms($post->ID, 'search_keyword');

	if ( ! empty($hashtag_terms ) ) { ?>
	<h3 class="post-category" style="text-align:right;"><?php
	    foreach($hashtag_terms as $ht){
	    echo "<a href='".get_term_link($ht, "search_keyword")."' style='float:right; margin-right:20px;'><img  src='".get_bloginfo('template_url')."/user.gif' style='border: dotted 1px #ccc;'> ".$ht->name."</a> ";
	  }
 ?></h3><br style="clear:both;">
	<?php } ?>
<img class="img-circle" src="<?php echo get_user_meta( $post->post_author, 'profile_image_url', true );?>" style="float:left; margin-right:20px; margin-top:20px;"/>
	<h3>
			<?php $tit = get_the_title();
	  echo url_replace($tit);
	  ?>
	</h3>

	<div class="entry-meta">
		<?php
		$display_author = $bavotasan_theme_options['display_author'];
		if ( $display_author )
			printf( __( 'by %s', 'ward' ),
				'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( sprintf( __( 'Posts by %s', 'ward' ), get_the_author() ) ) . '" rel="author">' . get_the_author() . '</a>'
			);

		$display_date = $bavotasan_theme_options['display_date'];
		if( $display_date ) {
			if( $display_author )
				echo '&nbsp;' . __( 'on', 'ward' ) . '&nbsp;';

		    echo '<a href="' . get_permalink() . '" class="time"><time class="published updated" datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time></a>';
	    }

		$display_comments = $bavotasan_theme_options['display_comment_count'];
		if( $display_comments && comments_open() ) {
			if ( $display_author || $display_date )
				echo '&nbsp;&bull;&nbsp;';

			comments_popup_link( __( '0 Comments', 'ward' ), __( '1 Comment', 'ward' ), __( '% Comments', 'ward' ) );
		}
		?>
	</div>