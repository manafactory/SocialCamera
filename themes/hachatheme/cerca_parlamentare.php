

<select data-placeholder="Cerca il parlamentare" class="chosen-select" style="display: none;" tabindex="-1">
 <option value=""></option>
<?php
 $args = array(
			'orderby' => 'count',
			'order' => 'DESC',
			'hide_empty' => false
		); 
$terms = get_terms( 'search_keyword', $args );
foreach($terms as $t){
?>
            <option value="<?php echo $t->slug; ?>"><?php echo $t->name; ?></option>
<?php
}
?></select>

<script>
  jQuery(".chosen-select").chosen({width: "100%"});

jQuery('.chosen-select').on('change', function(evt, params) {

    var stateVal = jQuery(".chosen-select").chosen().find("option:selected");


    if(stateVal !== null) {
      jQuery.each(stateVal, function(index){
	  //alert(jQuery(this).val()); 
	  jQuery(location).attr('href','<?php bloginfo('url'); ?>?search_keyword=' + jQuery(this).val());
	  
        });
    }
  });
</script>

