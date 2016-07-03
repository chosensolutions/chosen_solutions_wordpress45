jQuery(document).ready(function(){
	jQuery('body').on('click', '.magic-action-box .mab-postmatic .mab-small-link a', function(e){
		var link = jQuery(this);
		var parent = link.parent();
		if(link.attr('href') == '#unsubscribe'){
			link.attr('href', '#cancel');
			link.children('small').text('Cancel');
			parent.siblings('.mab-field-name').hide();
			parent.siblings('.mab-field-submit').children('.mab-subscribe').hide();
			parent.siblings('.mab-field-submit').children('.mab-unsubscribe').show();
			parent.siblings('input[name="postmatic-action"]').attr('value','unsubscribe');
			e.preventDefault();
		} else if(link.attr('href') == '#cancel') {
			link.attr('href', '#unsubscribe');
			link.children('small').text('Unsubscribe');
			parent.siblings('.mab-field-name').show();
			parent.siblings('.mab-field-submit').children('.mab-unsubscribe').hide();
			parent.siblings('.mab-field-submit').children('.mab-subscribe').show();
			parent.siblings('input[name="postmatic-action"]').attr('value','subscribe');
			e.preventDefault();
		}
	});

});