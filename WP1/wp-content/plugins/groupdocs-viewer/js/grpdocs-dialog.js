(function($) {
$(function() {

  $('ul.tabs').delegate('li:not(.current)', 'click', function() {
    $(this).addClass('current').siblings().removeClass('current')
      .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
  })

})
})(jQuery)

tinyMCEPopup.requireLangPack();
	
var GrpdocsInsertDialog = {
	init : function() {
		var f = document.forms[0];
        var shortcode;
				jQuery('.diy').click(function(){
				// diy option selected
					var dis = jQuery('.opt').attr('disabled');
					
					if (dis) {					
						jQuery('.opt').attr('disabled', ''); 
						jQuery('.gray').css('color','black');					
						jQuery('#shortcode').val('');
						
					} else {					
						jQuery('.opt').attr('disabled', 'disabled');
						jQuery('.gray').css('color','gray');
						jQuery('#shortcode').val('[grpdocsview file=""]');
					}
				
				});
				
				jQuery('.restrict_dl').click(function(){
					 update_sc();
				});	
				jQuery('.disable_cache').click(function(){
					 update_sc();
				});	
				jQuery('.bypass_error').click(function(){
					 update_sc();
				});
				jQuery('.save').click(function(){
					 update_sc();
				});
				
				jQuery('#height').blur(function(){
					update_sc();
				});
				jQuery('#width').blur(function(){
					update_sc();
				});	
				jQuery('#url').blur(function(){
					update_sc();
				});
				jQuery("input[name='protocol']").change(function(){
					update_sc();
				});	

		
		function update_sc() {
			 shortcode = 'grpdocsview';
			 
				if (( jQuery('#url').val() !=0 ) & ( jQuery('#url').val() ) !=null) {
					shortcode = shortcode + '  file="'+jQuery('#url').val()+'"';
				} else if ( jQuery('#url').val() == '' ) {
					jQuery('#uri-note').html('');
					shortcode = shortcode + ' file=""';
				}
				if (( jQuery('#height').val() !=0 ) & ( jQuery('#height').val() ) !=null) {
					shortcode = shortcode + '  height="'+jQuery('#height').val()+'"';
				}
				if (( jQuery('#width').val() !=0 ) & ( jQuery('#width').val() ) !=null) {
					shortcode = shortcode + '  width="'+jQuery('#width').val()+'"';
				}

				if ( jQuery("input[@name'protocol']:checked").val() ) {
					shortcode = shortcode + '  protocol="'+jQuery('input[@name\'protocol\']:checked').val()+'"';
				}
				
				if ( jQuery("input[@name'save']:checked").val() == '1') {
					shortcode = shortcode + '  save="1"';
				}
				else if ( jQuery("input[@name='save']:checked").val() == '0') {
					shortcode = shortcode + '  save="0"';
				}
				 
				if ( jQuery('.restrict_dl').is(':checked') ) {
					shortcode = shortcode + ' authonly="1"';
				}
				if ( jQuery('.disable_cache').is(':checked') ) {
					shortcode = shortcode + ' cache="0"';
				}
				if ( jQuery('.bypass_error').is(':checked') ) {
					shortcode = shortcode + ' force="1"';
				}				
				 
				var newsc = shortcode.replace(/  /g,' ');
				 
				jQuery('#shortcode').val('['+newsc+']');
		}
	},
	insert : function() {
        if($('#file').val()) {
            $('#form').submit();
        } else {
            // insert the contents from the input into the document
            tinyMCEPopup.editor.execCommand('mceInsertContent', false, jQuery('#shortcode').val());
            tinyMCEPopup.close();
        
        }
	}
};

tinyMCEPopup.onInit.add(GrpdocsInsertDialog.init, GrpdocsInsertDialog);
