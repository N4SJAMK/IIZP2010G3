jQuery(document).ready(function(){
	var APP_PATH = '/~vagrant/IIZP2010G3/public';

	// Admin add
	$('#dialog-addAdmin').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Add': function(){
				alert('todo');
				$(this).dialog('close');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Admin delete
	$('#dialog-deleteAdmin').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Remove': function(){
				alert('todo');
				$(this).dialog('close');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Back-up
	$('#dialog-backUpNow').dialog({
		autoOpen: false,
		closeText: 'X',
		buttons:{
			'Back-up': function(){
				var self = $(this);
				$.ajax({
					url:APP_PATH+'/settings/backup',
					success:function(){
						self.dialog('close');
					}
				});

				$(this).dialog('close');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Buttons to open dialogs
	$('.actionAddAdmin').click(function(){
		$('#dialog-addAdmin').dialog('open');
	});

	$('.actionDeleteAdmin').click(function(){
		$('#dialog-deleteAdmin').dialog('open');
	});

	$('.actionBackUpNow').click(function(){
		$('#dialog-backUpNow').dialog('open');
	});
});