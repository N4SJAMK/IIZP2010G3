jQuery(document).ready(function(){
	$('#dialog-deleteAdmin').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Remove': function(){
				$(this).dialog('close');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	$('.actionDeleteAdmin').click(function(){
		$('#dialog-deleteAdmin').dialog('open');
	});
});