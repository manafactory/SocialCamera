<script>
  jQuery(function() {
    // Select a Date Range with datepicker
		jQuery( "#rangeBa" ).datepicker({
		    defaultDate: "+1w",
		    changeMonth: true,
		    numberOfMonths: 3,
		    onClose: function( selectedDate ) {
		        jQuery( "#rangeBb" ).datepicker( "option", "minDate", selectedDate );
		    }
		});
		jQuery( "#rangeBb" ).datepicker({
		    defaultDate: "+1w",
		    changeMonth: true,
		    numberOfMonths: 3,
		    onClose: function( selectedDate ) {
		        jQuery( "#rangeBa" ).datepicker( "option", "maxDate", selectedDate );
		    }
		});
  });
  </script>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div><h2><?php _e('Twistory Archives', 'twistory'); ?></h2> 

<form action="admin.php?page=twistory_archives" method="get">
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="blogname">Date Archive</label></th>
			<td>From: <input type="text" value="02/01/2013" id="rangeBa" /> To: <input type="text" id="rangeBb"  value="02/01/2013"/></td>
		</tr>
	</table>
	<?php wp_nonce_field('save_twistory_option','nonce_twistory_option'); ?>
	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salva le modifiche"  /></p>
	<p class="description">Per generare tali codici creare una app su twitter tramite io seguenete <a href="">link</a>.</p>
</form>
</div>


