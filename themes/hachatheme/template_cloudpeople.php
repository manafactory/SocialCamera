<?php
/*
Template Name: Cloudeople page
*/

get_header();
?>
	<div id="primary" <?php bavotasan_primary_attr(); ?>>
		<?php
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    <div class="entry-content">
					    <?php the_content( __( 'Read more &rarr;', 'ward' ) ); ?>

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="gcontainer" style="min-width: 400px; height: 600px; max-width: 800px; margin: 0 auto"></div>
<script>
  jQuery(function () {
      
      // Radialize the colors
      Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
	  return {
	  radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
	      stops: [
		      [0, color],
		      [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		              ]
	      };
	});
      
      // Build the chart
      jQuery('#gcontainer').highcharts({
	chart: {
	  plotBackgroundColor: "#f7f7f7",
	  backgroundColor: "#f7f7f7",
	spacing: [0, 0, 0, 0],
	      plotBorderWidth: null,
	      plotShadow: false,
	      height: 600,
	      borderWidth: 0,
	      },
	  exporting: {
	enabled: false
	    },
	  credits: {
	enabled: false
	    },
            title: {
	  text: null
	      },
            tooltip: {
	  pointFormat: '{series.name}: <b> {point.total} ({point.percentage:.1f}%)</b>'
	      },
            plotOptions: {
	  pie: {
	    allowPointSelect: true,
		cursor: 'pointer',
		dataLabels: {
	      enabled: true,
		  format: '<b>{point.name}</b>: {point.total} ({point.percentage:.1f}%)',
		  style: {
		color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		    },
		  connectorColor: 'silver'
		  }
	    }
	  },
            series: [{
	    type: 'pie',
                name: 'Percentuale diffusione twitter',
                data: [
<?php
		       $categories = get_terms( 'search_keyword', array('hide_empty' => 1, 'number'=> 40, 'orderby' => "count", "order" => "DESC") );
foreach($categories as $cat){

  echo "['".addslashes($cat->name)."',   ".$cat->count."],";
}
?>              ]
		}]
	    });
    });
  </script>  


					<?php

  $args = array('taxonomy'  => array('search_keyword'), 'largest' => 30, 'number' => 100, 'orderby' => "count", 'order'=> "DESC"); 
wp_tag_cloud($args);


?>

				    </div><!-- .entry-content -->

				    <?php get_template_part( 'content', 'footer' ); ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				     //			comments_template( '', true );
		endwhile;
		?>
	</div>

<?php get_footer(); ?>