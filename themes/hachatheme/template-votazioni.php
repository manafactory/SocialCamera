<?php
/**
 * Template Name: Votazioni
 *
 */
get_header();
?>
	<div id="primary" <?php bavotasan_primary_attr(); ?>>
		<?php
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					

					    <div class="entry-content">
					    <?php

  the_content(); ?>
<?php 
//if($_GET['deputato']):
$url_spaqrl = 'http://dati.camera.it/ocd/persona.rdf/p302274';


$query_votazioni = "http://dati.camera.it/sparql?default-graph-uri=&query=select+Distinct+%3Ftitolo+%3Fpresenti+%3Fapprovato+%3Ffavorevoli+%3Fastenuti+%3Fcontrari+%3FdataVotazione+%3Fdescrizione+%3Fvoto_tipo+where+%7B%0D%0A%3Fvoto+ocd%3Arif_votazione+%3Fvotazione.%0D%0A%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Fpersona.rdf%2Fp302832%3E+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%3Fdeputato+a+ocd%3Adeputato%3B+ocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B+ocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%3Fvoto+a+ocd%3Avoto%3B+ocd%3Arif_deputato+%3Fdeputato.%0D%0A%23Dati+votazione%0D%0A%3Fvotazione+ocd%3Aapprovato+%3Fapprovato%3B+ocd%3Aastenuti+%3Fastenuti%3B+ocd%3Acontrari+%3Fcontrari%3B+ocd%3Afavorevoli+%3Ffavorevoli%3B+ocd%3Apresenti+%3Fpresenti%3B+dc%3Adate+%3FdataVotazione%3B+dc%3Atitle+%3Ftitolo%3B+ocd%3Arif_attoCamera+%3Fatto_camera.%0D%0A%3Fvoto+dc%3Atype+%3Fvoto_tipo.%0D%0AOPTIONAL%7B%0D%0A%3Fvoto+dc%3Adescription+%3Fdescrizione.%0D%0A%7D%0D%0A%7D%0D%0AORDER+BY+DESC%28%3FdataVotazione%29+LIMIT+100&format=application%2Fsparql-results%2Bjson&timeout=0";

//echo $query_votazioni;


  $dati_voti = file_get_contents($query_votazioni); 
  
  //echo $dati_voti;

  //var_dump(json_decode($dati_voti, false, 512, JSON_BIGINT_AS_STRING));
  
   $dati_voti = json_decode($dati_voti);

  
  
 // print_r($dati_voti);
//endif;

?>

<div class="row">

		<div class="col-xs-12">

<?php if($dati_voti): ?>

<?php foreach($dati_voti->results->bindings as $voto): ?>
<div id="author-info" class="well">
	<div class="author-text">
	   <div style="float:right; max-width:300px;"><p><?php echo  $voto->voto_tipo->value; ?></p></div>
	
	<h6>Votazione del <?php echo $voto->dataVotazione->value; ?></h6><h4><a href="<?php echo $attr["link"]; ?>"><?php echo $voto->titolo->value; ?></a></h4><h5>Dati votazione: <b>Totale votanti <?php echo  $voto->presenti->value; ?></b></h5>
		<p>Favorevoli: <?php echo  $voto->favorevoli->value; ?> - Astenuti: <?php echo  $voto->astenuti->value; ?> - Contrari: <?php echo  $voto->contrari->value; ?></p>
	</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

</div>

</div>
				    </div><!-- .entry-content -->

				    <?php get_template_part( 'content', 'footer' ); ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				     //			comments_template( '', true );
		endwhile;
		?>
	</div>

<?php get_footer(); ?>