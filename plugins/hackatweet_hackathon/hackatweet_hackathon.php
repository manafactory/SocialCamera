<?php
/*
Plugin Name: Hackathon camera
Version: 0.1
Description: Addon Twistory for Hackathon
*/


add_filter("twistory_hashtag_list", "ht_as_hashtag");

/* ritorno la lista di google trends */
function ht_as_hashtag($list){


  //$url="http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT+%3Fpersona+%3Fcognome+%3Fnome+%0D%0A%0D%0AWHERE+{%0D%0A%3Fpersona+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL{%0D%0A%3Fpersona+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A}%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL{%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.}%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS{%3Fmandato+ocd%3AendDate+%3FfineMandato.}%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS{%3Faderisce+ocd%3AendDate+%3FfineAdesione}%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS{%3Fmembro+ocd%3AendDate+%3FfineMembership}%0D%0A}+&format=text%2Fhtml&timeout=0&debug=on";

    $url="http://dati.camera.it/sparql?default-graph-uri=&query=SELECT+DISTINCT+%3Fpersona+%3Fnome+%3Fcognome++%0D%0AWHERE+{%0D%0A%3Fpersona+ocd%3Arif_mandatoCamera+%3Fmandato%3B+a+foaf%3APerson.%0D%0A%0D%0A%23%23+deputato%0D%0A%3Fd+a+ocd%3Adeputato%3B+ocd%3Aaderisce+%3Faderisce%3B%0D%0Aocd%3Arif_leg+%3Chttp%3A%2F%2Fdati.camera.it%2Focd%2Flegislatura.rdf%2Frepubblica_17%3E%3B%0D%0Aocd%3Arif_mandatoCamera+%3Fmandato.%0D%0A%0D%0A%23%23anagrafica%0D%0A%3Fd+foaf%3Asurname+%3Fcognome%3B+foaf%3Agender+%3Fgenere%3Bfoaf%3AfirstName+%3Fnome.%0D%0AOPTIONAL{%0D%0A%3Fpersona+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2FBirth%3E+%3Fnascita.%0D%0A%3Fnascita+%3Chttp%3A%2F%2Fpurl.org%2Fvocab%2Fbio%2F0.1%2Fdate%3E+%3FdataNascita%3B+%0D%0Ardfs%3Alabel+%3Fnato%3B+ocd%3Arif_luogo+%3FluogoNascitaUri.+%0D%0A%3FluogoNascitaUri+dc%3Atitle+%3FluogoNascita.+%0D%0A}%0D%0A%0D%0A%23%23aggiornamento+del+sistema%0D%0AOPTIONAL{%3Fd+%3Chttp%3A%2F%2Flod.xdams.org%2Fontologies%2Fods%2Fmodified%3E+%3Faggiornamento.}%0D%0A%0D%0A%23%23+mandato%0D%0A%3Fmandato+ocd%3Arif_elezione+%3Felezione.++%0D%0AMINUS{%3Fmandato+ocd%3AendDate+%3FfineMandato.}%0D%0A%0D%0A%23%23+elezione%0D%0A%3Felezione+dc%3Acoverage+%3Fcollegio.%0D%0A%0D%0A%23%23+adesione+a+gruppo%0D%0A%3Faderisce+ocd%3Arif_gruppoParlamentare+%3Fgruppo.%0D%0A%3Fgruppo+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2Falternative%3E+%3Fsigla%3B+%0D%0Adc%3Atitle+%3FnomeGruppo.%0D%0AMINUS{%3Faderisce+ocd%3AendDate+%3FfineAdesione}%0D%0A%0D%0A%23%23+organo%0D%0A%3Fd+ocd%3Amembro+%3Fmembro.%3Fmembro+ocd%3Arif_organo+%3Forgano.+%0D%0A%3Forgano+dc%3Atitle+%3Fcommissione+.%0D%0AMINUS{%3Fmembro+ocd%3AendDate+%3FfineMembership}%0D%0A}+&format=application%2Fjson&timeout=0&debug=on";

  
  //  echo $url;
  $xmlstring = file_get_contents($url);
  //echo $xmlstring;
  //  $array = json_decode(json_encode((array)simplexml_load_string($xmlstring)),1);
  $array = json_decode(($xmlstring),1);
  //echo "<pre>";
  // print_r($array);
  //echo "</pre>";
   foreach($array["results"]["bindings"] as $result){
     $nome=ucwords(strtolower($result["nome"]["value"]." ".$result["cognome"]["value"]));
     //$nome=ucwords(strtolower($result["cognome"]["value"]));

     // creo il termine se non esiste
     
     $term = term_exists($nome, 'search_keyword');
     if ($term !== 0 && $term !== null) {
       // il termine esiste   
       //  echo "termine esistente:";
       // print_r($term);
     }else{
       // echo "creo il termine";
       wp_insert_term($nome,'search_keyword',array('description'=> $result["persona"]["value"]));
     }

    $ret[$result["persona"]["value"]]=($nome);
  }

   //   echo "Totale: ".count($ret);

   //   print_r($ret);  
  return $ret;
  

}



/* rendo i tweet pubblici */
add_filter("twistory_args_insert_post", "gt_public_tweet");
function gt_public_tweet($arg){
  $arg['post_status'] = "publish";
  return $arg;
}




// aggiungo i post type alla home
add_filter( 'pre_get_posts', 'twistory_home_posts' );

function twistory_home_posts( $query ) {
    if ( !is_admin() )
      if((is_archive() || is_home()) && $query->is_main_query())
	$query->set( 'post_type', array( 'tweet' ) );

  return $query;
}

