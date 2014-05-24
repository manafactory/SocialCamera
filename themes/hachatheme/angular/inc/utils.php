<?php 
function array2csv($array){


    $array_utenti = json_decode(str_replace("\\", '', $array['id_utente'] ));
   if (count($array_utenti) == 0) {
     return null;
   }

   $conut_id = 0;
   foreach($array_utenti as $id_user):
   	
   		$user = get_user_by( 'id', $id_user );

        if($array['export_name'] == 'export'):
            $array_to_export[$conut_id]['Cognome'] = $user->last_name;
   		    $array_to_export[$conut_id]['Nome'] = $user->first_name;
        endif;
        if($array['export_email'] == 'export'):
   		    $array_to_export[$conut_id]['Email'] =  $user->user_email;
        endif;
        if($array['export_professione_1'] == 'export'):
            $professione_1 = get_term_by('slug',  get_user_meta($user->ID, 'professione_1', true), 'profession');
           $array_to_export[$conut_id]['Professione 1'] =  $professione_1->name;
        endif;
        if($array['export_professione_2'] == 'export'):
           $professione_2 = get_term_by('slug',  get_user_meta($user->ID, 'professione_2', true), 'profession');
           $array_to_export[$conut_id]['Professione 2'] =  $professione_2->name;
        endif;
        if($array['export_professione_3'] == 'export'):
           $professione_3 = get_term_by('slug',  get_user_meta($user->ID, 'professione_3', true), 'profession');
           $array_to_export[$conut_id]['Professione 3'] =  $professione_3->name;
        endif;
        if($array['export_iscrizione'] == 'export'):
            $array_to_export[$conut_id]['data_registrazione'] = $user->user_registered;
        endif;
   		$conut_id++;
   endforeach;

    //print_r($array_to_export);

   ob_start();
   $df = fopen("php://output", 'w');
   
   
   
   fputcsv($df, array_keys(reset($array_to_export)),';');
   foreach ($array_to_export as $row) {
      fputcsv($df, $row, ';');
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}