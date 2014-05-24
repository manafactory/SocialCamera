<?php
/*
Template Name: Composizione page
*/

get_header();
?>
	<div id="primary" <?php bavotasan_primary_attr(); ?>>
		<?php
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    <div class="entry-contents">
					    <?php the_content( __( 'Read more &rarr;', 'ward' ) ); ?>


<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div id="gcontainer" style="height: 500px; width:100%; margin: 0;"></div>

	
<?php

   // recupero sparql i dati dei parlamentari


   $url = "http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT%3Fcognome+%3Fnome+%3FnomeGruppo%0D%0AWHERE+{%0D%0A%3Fpersona+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL{%0D%0A%3Fpersona+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A}%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL{%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.}%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS{%3Fmandato+ocd%3AendDate+%3FfineMandato.}%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS{%3Faderisce+ocd%3AendDate+%3FfineAdesione}%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS{%3Fmembro+ocd%3AendDate+%3FfineMembership}%0D%0A}+&format=application%2Fjson&timeout=0&debug=on";

  $xmlstring = file_get_contents($url);
//echo $xmlstring;
  $array = json_decode(($xmlstring),1);

foreach($array["results"]["bindings"] as $elem){

  $chiave =  $elem["nomeGruppo"]["value"];
  $chiave =substr($chiave, 0, -11);
 //echo $elem["nomeGruppo"];
  $tot[$chiave]++;  
  
};

?>

<script>
jQuery(function () {
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
	text: null,
            align: 'center',
            verticalAlign: 'middle',
            y: 80
	    },
	  tooltip: {
	pointFormat: '{series.name}:<b> {point.total} </b> {point.percentage:.1f}%'
	    },
	  plotOptions: {
	pie: {
	  dataLabels: {
	    enabled: true,
		distance: 200,
		connectorColor: "#000",
		style: {
	      fontWeight: 'normal',
		  color: '#000',

		  }
	    },

	      startAngle: -120,
	      endAngle: 120,
	      center: ['50%', '50%']
	      }
        },
	  series: [{
	  type: 'pie',
	      name: 'Composizione Camera',
	      innerSize: '70%',
	      data: [
<?php 
foreach($tot as $kt=>$kv){

  echo "['".addslashes($kt)."',   ".$kv."],\n";
}
?>
            ]
	      }]
	  });
  });
    



</script>




				    </div><!-- .entry-content -->

				    <?php get_template_part( 'content', 'footer' ); ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				     //			comments_template( '', true );
		endwhile;
		?>
	</div>

<?php get_footer(); ?>