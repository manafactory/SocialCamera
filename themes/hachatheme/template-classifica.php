<?php
/**
 * Template Name: Classifica
 *
 */
get_header();
?>
	<div id="primary" <?php bavotasan_primary_attr(); ?>>
		<?php
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( ! is_front_page() ) { ?>
					<?php } ?>

				    <div class="entry-content">




					    <?php

  the_content();
	 // e ora prendiamo tutto

include("cerca_parlamentare.php");
?>


<?
	$url = "http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT+%3Fpersona+%3Fcognome+%3Fnome+%0D%0A%3FdataNascita++%3Fnato+%3FluogoNascita+%3Fgenere+%0D%0A%3Fcollegio+%3Fsigla+%3FnomeGruppo+%3FsiglaComponente++%3FnomeComponente++%3Fcommissione+%3Faggiornamento+++%3Ftwitter+%3Ffacebook+%3Fyoutube++%0D%0AWHERE+%7B%0D%0A%3Fpersona+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL%7B%0D%0A%3Fpersona+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A%7D%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL%7B%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.%7D%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS%7B%3Fmandato+ocd%3AendDate+%3FfineMandato.%7D%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS%7B%3Faderisce+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%0D%0AOPTIONAL%7B%0D%0A%23%23+adesione+a+Componente%0D%0A%3Faderisce+ocd%3Acomponente+%3Fbn.%0D%0A%3Fbn+ocd%3Arif_componente+%3Fcomponente.%0D%0A%3Fcomponente+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3FsiglaComponente%3B+%0D%0Adc%3Atitle+%3FnomeComponente.%0D%0AMINUS%7B%3Fbn+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%7D%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS%7B%3Fmembro+ocd%3AendDate+%3FfineMembership%7D%0D%0A%0D%0A++%23%23accounts%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountTw.+%3FaccountTw+foaf%3AaccountServiceHomepage+%3Ftwitter.+FILTER%28REGEX%28STR%28%3Ftwitter%29%2C%27twitter.com%27%29%29%7D%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountFb.+%3FaccountFb+foaf%3AaccountServiceHomepage+%3Ffacebook.+FILTER%28REGEX%28STR%28%3Ffacebook%29%2C%27facebook.com%27%29%29%7D+%0D%0A++++++++OPTIONAL%7B%3Fpersona+foaf%3Aaccount+%3FaccountYt+.+%3FaccountYt+foaf%3AaccountServiceHomepage+%3Fyoutube.+FILTER%28REGEX%28STR%28%3Fyoutube%29%2C%27youtube.com%27%29%29%7D%0D%0A%7D+&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";

  $xmlstring = file_get_contents($url);
  //echo $xmlstring;
  //  $array = json_decode(json_encode((array)simplexml_load_string($xmlstring)),1);
  $array = json_decode(($xmlstring),1); 
//echo "<pre>";
//print_r($array['results']['bindings']);
//echo "</pre>";



// ciclo sui dati della camera e creo un array con la url immagine come chiave
foreach($array['results']['bindings'] as $persona){
		if($prev_name == str_replace("'", "\'", $persona['nome']['value']  . ' ' . $persona['cognome']['value']) ) continue;

$url_img = $persona['persona']['value'];
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

endif;
$finalarr[$url_img]["immagine"] = $immagine;
$finalarr[$url_img]["twitter"] = $persona['twitter']['value'];
$finalarr[$url_img]["facebook"] = $persona['facebook']['value'];
$finalarr[$url_img]["youtube"] = $persona['youtube']['value'];
$finalarr[$url_img]["link"] = get_bloginfo('url') . '?search_keyword='.str_replace(" ","-",strtolower($persona['nome']['value'])) . '-' . str_replace(" ","-",strtolower($persona['cognome']['value']));
$finalarr[$url_img]["gruppo"] =substr($persona['nomeGruppo']['value'], 0, -12);
$finalarr[$url_img]["genere"] = $persona['genere']['value'];

$prev_name = str_replace("'", "\'", $persona['nome']['value']  . ' ' . $persona['cognome']['value']);
}



if($_REQUEST["all"] != "")
  $nb="''";
else
  $nb=100;
  


// recupero a parte tutte le tassonomie
 $args = array(
			'orderby' => 'count',
			'order' => 'DESC',
			'hide_empty' => false,
			'number' => $nb
		); 
$terms = get_terms( 'search_keyword', $args );

?>
<div class="row">

		<div class="col-xs-12">
<?php
  $conta=0;
foreach($terms as $tt){
$url_img = $tt->description;
$attr=$finalarr[$url_img];
$conta++;
//print_r($attr);
  ?>

<div id="author-info" class="well"><a href="<?php echo $attr["link"]; ?>"><img alt="" src="<?php echo $attr["immagine"]; ?>" class="avatar avatar-80 photo img-circle" height="80" width="80"></a>


<div class="author-text">
   <div style="float:right; max-width:300px;"><p><?php echo $attr["gruppo"]; ?></p></div>

<h6>Posizione: <?php echo $conta; ?></h6><h4><a href="<?php echo $attr["link"]; ?>"><?php echo $tt->name; ?></a></h4><h5>Tweet Collezionati: <b><?php echo  $tt->count; ?></b></h5>
													 <p><?php 
													  if($attr["facebook"] != ""){
    echo "<a href='".$attr["facebook"]."'>Facebook</a> ";
}

	  if($attr["twitter"] != ""){
    echo "<a href='".$attr["twitter"]."'>Twitter</a> ";
}

	  if($attr["youtube"] != ""){
    echo "<a href='".$attr["youtube"]."'>Youtube</a> ";
}


?>


</p>
    <p><a class="btn btn-primary" href="<?php echo $attr["link"]; ?>">Scopri attivit&agrave; parlamentare</a></p>



</div>


</div>
<?php
											       }
?>

</div></div>
<?php
if($_REQUEST["all"] == ""){
?>...
    <h3><a href="?all=1">Visualizza tutti i <?php echo count($finalarr); ?> parlamentari >></a></h3>
<?php
    }
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