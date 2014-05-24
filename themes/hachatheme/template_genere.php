<?php
/*
Template Name: Genere page
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




		<?php 

    // tada
	$url = "http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT+%3Fpersona+%3Fcognome+%3Fnome+%0D%0A%3FdataNascita++%3Fnato+%3FluogoNascita+%3Fgenere+%0D%0A%3Fcollegio+%3Fsigla+%3FnomeGruppo+%3FsiglaComponente++%3FnomeComponente++%3Fcommissione+%3Faggiornamento+++%3Ftwitter+%3Ffacebook+%3Fyoutube++%0D%0AWHERE+%7B%0D%0A%3Fpersona+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL%7B%0D%0A%3Fpersona+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A%7D%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL%7B%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.%7D%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS%7B%3Fmandato+ocd%3AendDate+%3FfineMandato.%7D%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS%7B%3Faderisce+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%0D%0AOPTIONAL%7B%0D%0A%23%23+adesione+a+Componente%0D%0A%3Faderisce+ocd%3Acomponente+%3Fbn.%0D%0A%3Fbn+ocd%3Arif_componente+%3Fcomponente.%0D%0A%3Fcomponente+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3FsiglaComponente%3B+%0D%0Adc%3Atitle+%3FnomeComponente.%0D%0AMINUS%7B%3Fbn+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%7D%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS%7B%3Fmembro+ocd%3AendDate+%3FfineMembership%7D%0D%0A%0D%0A++%23%23accounts%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountTw.+%3FaccountTw+foaf%3AaccountServiceHomepage+%3Ftwitter.+FILTER%28REGEX%28STR%28%3Ftwitter%29%2C%27twitter.com%27%29%29%7D%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountFb.+%3FaccountFb+foaf%3AaccountServiceHomepage+%3Ffacebook.+FILTER%28REGEX%28STR%28%3Ffacebook%29%2C%27facebook.com%27%29%29%7D+%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountYt+.+%3FaccountYt+foaf%3AaccountServiceHomepage+%3Fyoutube.+FILTER%28REGEX%28STR%28%3Fyoutube%29%2C%27youtube.com%27%29%29%7D%0D%0A%7D+&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";

  $xmlstring = file_get_contents($url);
  //echo $xmlstring;
  //  $array = json_decode(json_encode((array)simplexml_load_string($xmlstring)),1);
  $array = json_decode(($xmlstring),1);

   foreach($array["results"]["bindings"] as $result){
     // organizzo i dati per sesso e per collegio
     $sex[$result["genere"]["value"]]++;
     $collegio[$result["collegio"]["value"]]++;
    
     $sexcollegio[$result["collegio"]["value"]][$result["genere"]["value"]]++;
   } 


   
ksort($sexcollegio);



?>
<center><h1>Distribuzione di genere nel Parlamento</h1></center>
<div id="g1container"  class="col-sm-12" style="min-width:560px!important;"></div>
<br><br>
<center><h1>Distribuzione di genere nei Collegi</h1></center><br>
<div id="g2container"  class="col-sm-12" style="min-width:560px!important;"></div>


<script>
jQuery(function () {
    jQuery('#g1container').highcharts({
      chart: {
	spacing: [0, 0, 0, 0],
	plotBackgroundColor: "#f7f7f7",

            plotBorderWidth: 0,
            plotShadow: false
	    },
	  exporting: {
	enabled: false
	    },
	  credits: {
	enabled: false
	    },
	  title: {
	text: 'Distribuzione <br>di<br>Genere',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
	    },
	  tooltip: {
	  pointFormat: '{series.name}: <b> {point.total} ({point.percentage:.1f}%)</b>'
	    },
	  plotOptions: {
	pie: {
	  dataLabels: {
	    enabled: true,
		distance: 10,
		connectorColor: "#000",
		style: {
	      fontSize: "30px",
	      fontWeight: 'bold',
		  color: '#000',
		  textShadow: '0px 1px 2px black'
		  }
	    },
	      startAngle: -120,
	      endAngle: 120,
	      center: ['50%', '75%']
	      }
        },
	  series: [{
	  type: 'pie',
	      name: 'Distribuzione<br>di<br> Genere',
	      innerSize: '50%',
	      data: [
<?php 
foreach($sex as $kt=>$kv){
  echo "['".addslashes($kt)."',   ".$kv."],\n";
}
?>
            ]
	      }]
	  });
  });
    











jQuery(function () {
    jQuery('#g2container').highcharts({
      chart: {
	type: 'bar',

	  plotBackgroundColor: "#f7f7f7",
	  backgroundColor: "#f7f7f7",
	spacing: [0, 0, 0, 0],
	      plotBorderWidth: null,
	      plotShadow: false,
	      height: 1000,
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
	  xAxis: {
	categories: [<?php foreach($sexcollegio as $g=>$av){ echo "'".addslashes($g)."',"; } ?>]
            },
	  yAxis: {
	min: 0,
	    title: {
	  text: null
	      },
	    stackLabels: {
	  enabled: true,
	      style: {
	    fontWeight: 'bold',
		color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
		}
	  }
	},
	  legend: {
	align: 'right',
	    x: -70,
	    verticalAlign: 'top',
	    y: 20,
	    floating: true,
	    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
	    borderColor: '#CCC',
	    borderWidth: 1,
	    shadow: false
            },
	  tooltip: {
	formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'';
	  }
	},
	  plotOptions: {
	column: {
	  stacking: 'normal',
	      dataLabels: {
	    enabled: true,
		color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
		style: {
	      textShadow: '0 0 3px black, 0 0 3px black'
		  }
	    }
	  }
	},
	  series: [
<?php
   $gen=array("male", "female");
foreach($gen as $g){ ?>{
	  name: '<?php echo $g; ?>',
      data: [<?php foreach($sexcollegio as $sc){ if($sc[$g]) echo $sc[$g].","; else echo "0"; } ?>]
	      }, 
    <?php } ?>]
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