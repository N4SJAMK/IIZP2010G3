jQuery(document).ready(function(){
	// Admin add
	$('#dialog-addAdmin').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Add': function(){
				alert('todo');
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
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Password change
	$('#dialog-changePassword').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Save': function(){
				alert('todo');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Remove board
	$('#dialog-deleteBoard').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Remove': function(){
				alert('todo');;
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Empty board
	$('#dialog-emptyBoard').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Empty': function(){
				alert('todo');;
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
				dialogAjax.request(this, '/settings/backup');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Error dialog
	$('#dialog-msg').dialog({
		autoOpen: false,
		closeText:'X',
		buttons:{
			'Ok': function(){
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

	$('.actionChangePassword').click(function(){
		$('#dialog-changePassword').dialog('open');
	});

	$('.actionDeleteBoard').click(function(){
		$('#dialog-deleteBoard').dialog('open');
	});

	$('.actionEmptyBoard').click(function(){
		$('#dialog-emptyBoard').dialog('open');
	});
});