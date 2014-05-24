<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main, .grid and #page div elements.
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();

		/* Do not display sidebars if is front page, search or archive */
		if ( is_singular() ) {
			if ( 6 != $bavotasan_theme_options['layout'] )
				get_sidebar();
			?>

		</div> <!-- .row -->
		<?php } ?>
	</div> <!-- #main -->
</div> <!-- #page -->

<footer id="footer" role="contentinfo">
	<div id="footer-content" class="container">
		<div class="row">
			<?php dynamic_sidebar( 'extended-footer' ); ?>
		</div><!-- .row -->

		<div class="row">
			<div class="col-lg-12">
				<?php $class = ( is_active_sidebar( 'extended-footer' ) ) ? ' active' : ''; ?>
				<span class="line<?php echo $class; ?>"></span>
				<span class="pull-left">just another <a href="http://manafactory.it">Manafactory Project</a></span>
				<span class="credit-link pull-right"><i class="icon-off"></i>  <?php printf( __( 'Powered by %s', 'ward' ), '<a href="http://twisory.it">Twistory</a>' ); ?></span>
			</div><!-- .col-lg-12 -->
		</div><!-- .row -->
	</div><!-- #footer-content.container -->
</footer><!-- #footer -->

<?php wp_footer(); ?>

<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
											       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
																		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-51106372-1', 'manafactory.it');
ga('send', 'pageview');

</script>


</body>
</html>