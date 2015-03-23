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
		show: {
			effect: 'drop'
		},
		closeText:'X',
		buttons:{
			'Remove': function(){
				dialogAjax.request(this, {
					url: '/settings/removeadmin',
					data: $('#dialog-deleteAdmin form').serialize()
				});
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Password change
	$('#dialog-changePassword').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
		closeText:'X',
		buttons:{
			'Save': function(e){
				dialogAjax.request(this, {
					url: '/users/changepassword',
					data: $('#dialog-changePassword form').serialize()
				});
				$('#dialog-changePassword form input').val('');
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Remove board
	$('#dialog-deleteBoard').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
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
		show: {
			effect: 'drop'
		},
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
		show: {
			effect: 'drop'
		},
		closeText: 'X',
		buttons:{
			'Back-up': function(){
				dialogAjax.request(this, {
					url: '/settings/backup'
				});
			},
			'Cancel': function(){
				$(this).dialog('close');
			}
		}
	});

	// Message dialog
	$('#dialog-msg').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
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
		var adminid = $(this).closest('tr[data-adminid]').attr('data-adminid');
		$('#dialog-deleteAdmin form input[name="adminid"]').val(adminid);
		$('#dialog-deleteAdmin').dialog('open');
	});

	$('.actionBackUpNow').click(function(){
		$('#dialog-backUpNow').dialog('open');
	});

	$('.actionChangePassword').click(function(){
		// Hae käyttäjän id, joka on löytyy rivin data-userid attribuutista
		var userid = $(this).closest('tr[data-userid]').attr('data-userid');
		
		// Aseta userid arvo lomakkeen piilokenttään nimeltä "userid"
		$('#dialog-changePassword form input[name="userid"]').val(userid);
		
		// Avaa dialogi
		$('#dialog-changePassword').dialog('open');
	});

	$('.actionDeleteBoard').click(function(){
		$('#dialog-deleteBoard').dialog('open');
	});

	$('.actionEmptyBoard').click(function(){
		$('#dialog-emptyBoard').dialog('open');
	});
});