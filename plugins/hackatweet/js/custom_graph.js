jQuery(function() {
    // Select a Date Range with datepicker
		jQuery( "#rangeBa" ).datepicker({
		    defaultDate: "+1w",
		    dateFormat: 'yy-mm-dd',
		    changeMonth: true,
		    numberOfMonths: 3,
		    onClose: function( selectedDate ) {
		        jQuery( "#rangeBb" ).datepicker( "option", "minDate", selectedDate );
		    }
		});
		jQuery( "#rangeBb" ).datepicker({
		    defaultDate: "+1w",
		    dateFormat: 'yy-mm-dd',
		    changeMonth: true,
		    numberOfMonths: 3,
		    onClose: function( selectedDate ) {
		        jQuery( "#rangeBa" ).datepicker( "option", "maxDate", selectedDate );
		    }
		});
  });
  
  
  
  jQuery(function($) {
    var $info = $("#save-graph-content");
    $info.dialog({                   
        'dialogClass'   : 'wp-dialog',           
        'modal'         : false,
        'height'		: 500,
		'width'			: 500,
        'autoOpen'      : false, 
        'closeOnEscape' : true,      
        'buttons'       : {
            "Close": function() {
                $(this).dialog('close');
            }
        }
    });
    $("#open-save-graph").click(function(event) {
        event.preventDefault();
        $info.dialog('open');
    });
});




