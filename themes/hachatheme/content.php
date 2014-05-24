<?php
$bavotasan_theme_options = bavotasan_theme_options();
$format = get_post_format();
$featured_image = ( has_post_thumbnail() ) ? 'featured-image' : 'no-featured-image';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $featured_image ); ?>>
		<?php if ( ! is_single() ) { ?>
		<div class="container">
			<div class="row">
		<?php } ?>



				<div class="col-sm-12">

				    <?php get_template_part( 'content', 'header' ); ?>

				    <?php get_template_part( 'content', 'footer' ); ?>

				</div>
		<?php if ( ! is_single() ) { ?>
			</div>
		</div>
		<?php } ?>
	</article><!-- #post-<?php the_ID(); ?> -->