<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */
get_header(); ?>

	<section id="primary" <?php bavotasan_primary_attr(); ?>>
	
	
	<header id="archive-header">
  <div class="container">
  <div class="row">



  <div class="col-sm-12">



<h1 class="page-title">
  
  <?php if ( is_category() ) : ?>
  <?php echo single_cat_title( '', false ); ?>
  <?php elseif ( is_author() ) : ?>
  <?php printf( __( 'Author Archive for %s', 'ward' ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ); ?>
  <?php elseif ( is_tag() ) : ?>
  <?php printf( __( 'Tag Archive for %s', 'ward' ), single_tag_title( '', false ) ); ?>
  <?php elseif ( is_day() ) : ?>
  <?php printf( __( 'Daily Archives: %s', 'ward' ), get_the_date() ); ?>
  <?php elseif ( is_month() ) : ?>
  <?php printf( __( 'Monthly Archives: %s', 'ward' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ward' ) ) ); ?>
  <?php elseif ( is_year() ) : ?>
  <?php printf( __( 'Yearly Archives: %s', 'ward' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ward' ) ) ); ?>
  <?php endif; ?>
  
  <?php 
  //recupero la descritption 
  //$description = term_description();
  //echo get_template_directory() . "/lib/EasyRdf.php";
  //echo get_template_directory() . "/lib/html_tag_helpers.php";
  //set_include_path(get_include_path() . PATH_SEPARATOR . 'lib/');
  require_once(get_template_directory() . "/lib/EasyRdf.php");
require_once(get_template_directory() . "/lib/html_tag_helpers.php");

$url_spaqrl =  term_description();
$url_spaqrl = str_replace('<p>', '', $url_spaqrl);
$url_spaqrl = str_replace('</p>', '', $url_spaqrl);
$url_spaqrl = trim($url_spaqrl);
$url = str_replace('ocd/', 'ocd/data/', $url_spaqrl);
$query_sprql = "http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT+<$url_spaqrl>+%3Fcognome+%3Fnome+%0D%0A%3FdataNascita++%3Fnato+%3FluogoNascita+%3Fgenere+%0D%0A%3Fcollegio+%3Fsigla+%3FnomeGruppo+%3FsiglaComponente++%3FnomeComponente++%3Fcommissione+%3Faggiornamento+++%3Ftwitter+%3Ffacebook+%3Fyoutube++%0D%0AWHERE+%7B%0D%0A<$url_spaqrl>+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL%7B%0D%0A<$url_spaqrl>+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A%7D%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL%7B%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.%7D%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS%7B%3Fmandato+ocd%3AendDate+%3FfineMandato.%7D%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS%7B%3Faderisce+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%0D%0AOPTIONAL%7B%0D%0A%23%23+adesione+a+Componente%0D%0A%3Faderisce+ocd%3Acomponente+%3Fbn.%0D%0A%3Fbn+ocd%3Arif_componente+%3Fcomponente.%0D%0A%3Fcomponente+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3FsiglaComponente%3B+%0D%0Adc%3Atitle+%3FnomeComponente.%0D%0AMINUS%7B%3Fbn+ocd%3AendDate+%3FfineAdesione%7D%0D%0A%7D%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS%7B%3Fmembro+ocd%3AendDate+%3FfineMembership%7D%0D%0A%0D%0A++%23%23accounts%0D%0A++++++++OPTIONAL%7B<$url_spaqrl>+foaf%3Aaccount+%3FaccountTw.+%3FaccountTw+foaf%3AaccountServiceHomepage+%3Ftwitter.+FILTER%28REGEX%28STR%28%3Ftwitter%29%2C%27twitter.com%27%29%29%7D%0D%0A++++++++OPTIONAL%7B<$url_spaqrl>+foaf%3Aaccount+%3FaccountFb.+%3FaccountFb+foaf%3AaccountServiceHomepage+%3Ffacebook.+FILTER%28REGEX%28STR%28%3Ffacebook%29%2C%27facebook.com%27%29%29%7D+%0D%0A++++++++OPTIONAL%7B<$url_spaqrl>+foaf%3Aaccount+%3FaccountYt+.+%3FaccountYt+foaf%3AaccountServiceHomepage+%3Fyoutube.+FILTER%28REGEX%28STR%28%3Fyoutube%29%2C%27youtube.com%27%29%29%7D%0D%0A%7D+&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";
//  echo $query_sprql;
// echo file_get_contents($query_sprql);

$dati_sparql = json_decode(file_get_contents($query_sprql));

//print_r($dati_sparql);


// Parse the input
$graph = new EasyRdf_Graph($url);
$graph->load($url, 'guess');

// Lookup the output format
$format = EasyRdf_Format::getFormat('json');


// Serialise to the new output format
$output = $graph->serialise($format);

$output = json_decode($output);
$nome = $output->{$url_spaqrl}->{'http://xmlns.com/foaf/0.1/firstName'}[0]->value;
$cognome = $output->{$url_spaqrl}->{'http://xmlns.com/foaf/0.1/surname'}[0]->value;
$tit =  $nome . ' ' . $cognome;
echo $tit . '<br/>';
echo '</h1><!-- .page-title -->';?>

<div class="row" style="padding:10px;">
  <div class="col-sm-2">
  <?php  echo '<img src="' . $output->{$url_spaqrl}->{'http://xmlns.com/foaf/0.1/depiction'}[0]->value . '" class="img-circle"/>' . '<br/>';


  //  hackathon_save_classifica();
  // classifica
 ?>



  </div>
  <div class="col-xs-10">



  <?php $nome = str_replace(' ', '_', trim(ucfirst(strtolower($nome))));
  $cognome = str_replace(' ', '_', trim(ucfirst(strtolower($cognome))));
$wiki_description = file_get_contents('http://it.wikipedia.org/w/api.php?format=xml&action=query&titles=' . $nome . '_' . $cognome . '&prop=extracts&exintro&explaintext');
$array_wiki = json_decode(json_encode((array)simplexml_load_string($wiki_description)),1);
//print_r($array_wiki);
if($array_wiki['query']['pages']['page']['extract']):
  echo '<blockquote>' . $array_wiki['query']['pages']['page']['extract'] . '<br/><small><a href="http://it.wikipedia.org/wiki/' . $nome . '_' . $cognome . '">Wikipedia</a></small></blockquote>';
endif;
echo '<blockquote style="border-left-color: #ffe400;">';
if($dati_sparql->results->bindings[0]->nato->value):
  echo '<strong>Data di nascita: </strong>' . $dati_sparql->results->bindings[0]->nato->value . '</br>';
endif;

echo '<strong>Formazione: </strong>' . $output->{$url_spaqrl}->{'http://purl.org/dc/elements/1.1/description'}[0]->value . '<br/>';

if($dati_sparql->results->bindings[0]->nomeGruppo->value):
  echo '<strong>Partito: </strong>' . $dati_sparql->results->bindings[0]->nomeGruppo->value .'</br>';
endif;
if($dati_sparql->results->bindings[0]->nomeComponente->value):
  echo '<strong>Componente Gruppo: </strong>' . $dati_sparql->results->bindings[0]->nomeComponente->value .'</br>';
endif;

if($output->{$url_spaqrl}->{'http://dati.camera.it/ocd/rif_membroGoverno'}):
  
  $menbro_governo = $output->{$url_spaqrl}->{'http://dati.camera.it/ocd/rif_membroGoverno'};

foreach($menbro_governo as $valore):

$url = $valore->value;


$membro = new EasyRdf_Graph($url);
$membro->load($url, 'guess');
// Lookup the output format
$format = EasyRdf_Format::getFormat('json');
// Serialise to the new output format
$membro = $membro->serialise($format);
$membro = json_decode($membro);

echo $membro->{$url}->{'http://purl.org/dc/elements/1.1/title'}[0]->value . '<br/>';


endforeach; 


endif;

if($dati_sparql->results->bindings[0]->twitter->value):
  echo '<strong>Profilo Twitter: </strong><a href="' . $dati_sparql->results->bindings[0]->twitter->value .'">' . $dati_sparql->results->bindings[0]->twitter->value .'</a></br>';
endif;

if($dati_sparql->results->bindings[0]->facebook->value):
  echo '<strong>Pagina Facebook: </strong><a href="' . $dati_sparql->results->bindings[0]->facebook->value .'">' . $dati_sparql->results->bindings[0]->facebook->value .'</a></br>';
endif;

if($dati_sparql->results->bindings[0]->youtube->value):
  echo '<strong>Pagina Youtube: </strong><a href="' . $dati_sparql->results->bindings[0]->youtube->value .'">' . $dati_sparql->results->bindings[0]->youtube->value .'</a></br>';
endif; ?>
<?php 


						        //Blocco elborazione voti
						        $query_voti = "http://dati.camera.it/sparql?default-graph-uri=&query=select+distinct+%3Ftitolo+%3FdataVotazione+%3Fdescrizione+%3Fvoto_tipo+where+%7B%0D%0A%3Fvoto+ocd%3Arif_votazione+%3Fvotazione.%0D%0A<$url_spaqrl>+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%3Fdeputato+a+ocd%3Adeputato%3B+ocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B+ocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%3Fvoto+a+ocd%3Avoto%3B+ocd%3Arif_deputato+%3Fdeputato.%0D%0A%3Fvotazione+dc%3Adate+%3FdataVotazione.%0D%0A%3Fvotazione+dc%3Adescription+%3Ftitolo.%0D%0A%3Fvoto+dc%3Atype+%3Fvoto_tipo%0D%0AOPTIONAL%7B%0D%0A%3Fvoto+dc%3Adescription+%3Fdescrizione.%0D%0A%7D%0D%0A%7D&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";
						        
						        
						        
						        
						        
						        $dati_voti = json_decode(file_get_contents($query_voti));
						        
						        //print_r($dati_voti);
						        
						       
						        $numero_giorni = 0;
						        $numero_assenze = 0;
						        $numero_missioni = 0;
						        $old_day = '';
						        $array_voti = array();
						        foreach($dati_voti->results->bindings as $votazione):
						        	
						        	$array_voti[$votazione->voto_tipo->value]['numero'] ++;
						        
									if($votazione->descrizione->value):
						        		$array_voti[$votazione->voto_tipo->value]['descrizione'][$votazione->descrizione->value] ++;
						        
						        	endif;
									if($old_day != $votazione->dataVotazione->value):
										
										if($votazione->descrizione->value == 'Non ha partecipato'):
											$numero_assenze++;
										endif;
										
										if($votazione->descrizione->value == 'In missione'):
											$numero_missioni++;
										endif;
																				
									 	$numero_giorni++;
									 	$old_day = $votazione->dataVotazione->value;
									endif;
									
									
						        endforeach; ?>
<br>
<table>
<tr><th colspan="3">Su <b><?php echo $numero_giorni; ?></b> giorni di votazione alla Camera</th></tr>
<tr>
<td><b><?php echo $numero_giorni - ($numero_assenze + $numero_missioni); ?></b><small>Presenze</small></td>
<td><b><?php echo $numero_assenze; ?></b><small>Assenze</small></td>
<td><b><?php echo $numero_missioni; ?></b><small>In missione</small></td>
</tr>
</table>
<br>
<table>
<tr><th>Su <?php echo $numero_totole = count($dati_voti->results->bindings); ?> votazioni</th></tr>
<tr>
<td>
<h4>Ha votato <b><?php echo $numero_totole - $array_voti['Non ha votato']['numero']; ?></b> volte</h4>

<table><tr>
<?php if($array_voti['Favorevole']['numero']) echo  "<td><b>".$array_voti['Favorevole']['numero'] . '</b><small>Favorevole</small></td>'; else echo "<td></td>"; ?>

<?php if($array_voti['Astensione']['numero']) echo "<td><b>".$array_voti['Astensione']['numero'] . '</b><small>Astenuto</small></td>'; else echo "<td></td>"; ?>

</tr><tr>
<?php if( $array_voti['Contrario']['numero']) echo "<td><b>".$array_voti['Contrario']['numero'] . '</b><small>Contrario</small></td>'; else echo "<td></td>";  ?>

<?php if($array_voti['Ha votato']['numero']) echo "<td><b>".$array_voti['Ha votato']['numero'] . '</b><small>Voto segreto</small></td>'; else echo "<td></td>";   ?>
</tr></table>

</td>
</tr><tr><td>
<h4>NON ha votato <b><?php echo $array_voti['Non ha votato']['numero']?></b> volte</h4>

<table><tr>
<?php
foreach($array_voti['Non ha votato']['descrizione'] as $key => $number): 
 $motivi .= "<td><b>".$number . '</b><small>' . strtolower( $key ) . '</small></td>';  
endforeach;
 echo $motivi; 
?>
</tr></table>

</td>

</tr>
</table>
<small>Open data della Camera dei Deputati</small>
</blockquote>


<!-- <?php print_r(get_query_var()); ?>-->

<?php 

$args = array( 'post_type' => 'tweet',	      
	       'order' => 'DESC',
	       	       'posts_per_page' => 50,	      
	       'tax_query' => array(				    
				    array(					  
					  'taxonomy' => 'search_keyword',				       					  'field' => 'slug',
					  'terms' => get_query_var( 'term' )
					  
										  )
				    
								    ));


$post_tax = get_posts($args); 
$array_hastag = array();
foreach($post_tax as $tweet):
$terms = wp_get_post_terms( $tweet->ID, 'hashtag' );
foreach($terms as $term):
$array_hastag[$term->name]++;
endforeach;
endforeach;
arsort($array_hastag); ?>
<?php if(!empty($array_hastag)): ?>
<blockquote style="border-left-color: #4099FF;">
  <strong>Top Hashtag su <?php echo $output->{$url_spaqrl}->{'http://xmlns.com/foaf/0.1/firstName'}[0]->value . ' ' . $output->{$url_spaqrl}->{'http://xmlns.com/foaf/0.1/surname'}[0]->value . '<br/>'; ?></strong>
<?php $check_tweet_number = 1; 
  foreach($array_hastag as $hastag_key => $hastag_number):?>
    <?php if($check_tweet_number >= 8 ) break; ?>
  <?php $hastag_to_print .=  '<a href="https://twitter.com/search?q=%23' . $hastag_key. '&src=tren" target="_BLANK">#' . $hastag_key . '</a> /'; ?> 
  <?php $check_tweet_number++; ?>
  <?php endforeach; ?>
  <?php echo trim($hastag_to_print, '/')?>
  </blockquote>
    <?php endif; ?>
  
  
  </div>
    </div>
    <?php if ( is_category() ) :
    if ( $category_description = category_description() )
      echo '<h2 class="archive-meta">' . $category_description . '</h2>';
endif;

if ( is_author() ) :
  $curauth = ( get_query_var('author_name') ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var(' author' ) );
if ( isset( $curauth->description ) )
  echo '<h2 class="archive-meta">' . $curauth->description . '</h2>';
endif;

if ( is_tag() ) :
  if ( $tag_description = tag_description() )
    echo '<h2 class="archive-meta">' . $tag_description . '</h2>';
endif;
?>
</div>
</div>
</div>
</header><!-- #archive-header -->
</div>


<?php 
  //if($_GET['show_voti']== 'true'): 
if(true): 

?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url') ?>/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url') ?>/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(".link_esterno").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<?php 


$num = $_GET['show_voti'];
if(!$num)
  $num=5;

$query_votazioni = "http://dati.camera.it/sparql?default-graph-uri=&query=select+distinct+%3Fvotazione+%3Fatto+%3Fdescrizione_atto+%3Fdeputato+%3Frelazione+%3Ftitolo+%3Fpresenti+%3Fapprovato+%3Ffavorevoli+%3Fastenuti+%3Fcontrari+%3FdataVotazione+%3Fdescrizione+%3Fvoto_tipo+where+{%0D%0A%3Fvotazione+a+ocd%3Avotazione%3B+ocd%3Aapprovato+%3Fapprovato%3B+ocd%3Aastenuti+%3Fastenuti%3B+ocd%3Acontrari+%3Fcontrari%3B+ocd%3Afavorevoli+%3Ffavorevoli%3B+ocd%3Apresenti+%3Fpresenti%3B+dc%3Adate+%3FdataVotazione%3B+dc%3Atitle+%3Ftitolo%3B+ocd%3Arif_aic+%3Fatto%3B+dc%3Arelation+%3Frelazione.%0D%0A<$url_spaqrl>+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%3Fdeputato+a+ocd%3Adeputato%3B+ocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B+ocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%3Fvoto+a+ocd%3Avoto%3B+ocd%3Arif_votazione+%3Fvotazione%3B+ocd%3Arif_deputato+%3Fdeputato.%0D%0A%3Fatto+dc%3Adescription+%3Fdescrizione_atto.%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS{%3Fmandato+ocd%3AendDate+%3FfineMandato.}%0D%0A%0D%0A%0D%0A%23Atto+camera%0D%0A+%3Fvoto+dc%3Atype+%3Fvoto_tipo.%0D%0A+OPTIONAL{%3Fatto_votazione+ocd%3Aatto+%3Fvotazione.}%0D%0A+OPTIONAL{%3Fvoto+dc%3Adescription+%3Fdescrizione.}%0D%0A}+ORDER+BY+DESC+%28%3FdataVotazione%29%0D%0A%0D%0A%0D%0A%0D%0A&LIMIT+100&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";

 
$dati_voti = file_get_contents($query_votazioni); 
$dati_voti = json_decode($dati_voti); ?>
<div id="main" class="container">
<div id="primary">
<div id="votazioni"></div>
   <h1>Ultime <?php echo $num; ?> votazioni</h1>

<div class="entry-content">
<a href="?show_voti=100#votazioni"><button type="button" class="btn btn-warning" style="width: 255px; margin: 10px auto;">Guarda le ultime 100 votazioni >></button></a>
<article class="page type-page status-publish hentry">
<div class="row">

<?php if($dati_voti): ?>

<?php 
$div_id = 1;
		$contacicli=0;
foreach($dati_voti->results->bindings as $voto):
		$contacicli++;
		if($contacicli > $num)
		  continue;
 ?>
<div id="author-info" class="well">
<img alt="Camera" src="<?php bloginfo("template_url"); ?>/logo-camera.jpg" class="avatar avatar-80 photo img-circle" height="80" width="80">


	<div class="author-text">
	   <div style="float:right; max-width:350px;">
	   <?php if($voto->voto_tipo->value == 'Contrario' || $voto->voto_tipo->value == 'Favorevole' || $voto->voto_tipo->value == 'Astenuto'): ?>
	   		<p>Il Deputato ha votato: <?php echo  strtolower($voto->voto_tipo->value); ?></p>
	   <?php else: ?>
		<p>Il Deputato non ha votato perch&egrave; <?php echo  strtolower($voto->descrizione->value); ?>
	   	<?php endif; ?>
	   </div>
	<?php
		$data = $voto->dataVotazione->value; 
		$anno =  substr($data, 0, 4);
		$mese =  substr($data, 4, 2);
		$giorno =  substr($data, 6, 2);
	?>
	<h6>Votazione del <?php echo $giorno . '-' . $mese . '-' . $anno; ?></h6><h4><a class="link_esterno" href="#atto_<?php echo $div_id; ?>"><?php echo $voto->titolo->value; ?>  <small>(Leggi descrizione)</small></a></h4><h5>Dati votazione: <b>Totale votanti <?php echo  $voto->presenti->value; ?></b></h5>
		<p>Favorevoli: <?php echo  $voto->favorevoli->value; ?> - Astenuti: <?php echo  $voto->astenuti->value; ?> - Contrari: <?php echo  $voto->contrari->value; ?></p>
<a class="btn btn-primary link_esterno"  data-fancybox-type="iframe" href="<?php echo $voto->relazione->value; ?>">Dettaglio Votazione</a>
	</div>
</div>
<div id="atto_<?php echo $div_id; ?>" style="display:none;">
			<h2><?php echo $voto->titolo->value; ?></h2>

			<p>
		<?php echo wpautop(str_replace(";",";\n",$voto->descrizione_atto->value)); ?>
			</p>

</div>
<?php $div_id++; ?>
<?php endforeach; ?>
<?php endif; ?>

</div>

</div>
</article>
<a href="?show_voti=100#votazioni"><button type="button" class="btn btn-warning" style="width: 255px; margin: 10px auto;">Guarda le ultime 100 votazioni >></button></a>
</div>



</div>
<hr>
<?php endif; ?>
<?php if ( have_posts() ) : ?>


		<center><h1>Tweet che parlano di <?php echo ucwords(strtolower($tit)); ?></h1></center>
<?php
while ( have_posts() ) : the_post();

/* Include the post format-specific template for the content. If you want to
 * this in a child theme then include a file called called content-___.php
 * (where ___ is the post format) and that will be used instead.
 */
get_template_part( 'content', get_post_format() );

endwhile;

bavotasan_pagination();
else :
  get_template_part( 'content', 'none' );
endif;
?>

</section><!-- #primary.c8 -->

<?php get_footer(); ?>