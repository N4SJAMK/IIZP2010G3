jQuery(document).ready(function(){
	function grabInfoToForm(self, dialog, item){
		var self = $(self);
		var itemdata = self.closest('tr[data-'+item+']').attr('data-'+item);
		$(dialog+' form input[name="'+item+'"]').val(itemdata);
	}

	// Admin add
	$('#dialog-addAdmin').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
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

	// Promote
	$('#dialog-promoteToAdmin').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
		closeText:'X',
		buttons:{
			'Promote': function(){
				dialogAjax.request(this, {
					url: '/settings/addadmin',
					data: $('#dialog-promoteToAdmin form').serialize()
				});
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
				dialogAjax.request(this, {
					url: '/boards/remove',
					data: $('#dialog-deleteBoard form').serialize()
				});
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
				dialogAjax.request(this, {
					url: '/boards/wipe',
					data: $('#dialog-emptyBoard form').serialize()
				});
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

	// Remove user
	$('#dialog-deleteUser').dialog({
		autoOpen: false,
		show: {
			effect: 'drop'
		},
		closeText:'X',
		buttons:{
			'Remove': function(){
				dialogAjax.request(this, {
					url: '/users/remove',
					data: $('#dialog-deleteUser form').serialize()
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

	$('.actionPromoteToAdmin').click(function(){
		grabInfoToForm(this, '#dialog-promoteToAdmin', 'userid');
		$('#dialog-promoteToAdmin').dialog('open');
	});

	$('.actionDeleteAdmin').click(function(){
		grabInfoToForm(this, '#dialog-deleteAdmin', 'adminid');
		$('#dialog-deleteAdmin').dialog('open');
	});

	$('.actionBackUpNow').click(function(){
		$('#dialog-backUpNow').dialog('open');
	});

	$('.actionChangePassword').click(function(){
		grabInfoToForm(this, '#dialog-changePassword', 'userid');
		$('#dialog-changePassword').dialog('open');
	});

	$('.actionDeleteBoard').click(function(){
		grabInfoToForm(this, '#dialog-deleteBoard', 'boardid');
		$('#dialog-deleteBoard').dialog('open');
	});

	$('.actionEmptyBoard').click(function(){
		grabInfoToForm(this, '#dialog-emptyBoard', 'boardid');
		$('#dialog-emptyBoard').dialog('open');
	});

	$('.actionDeleteUser').click(function(){
		grabInfoToForm(this, '#dialog-deleteUser', 'userid');
		$('#dialog-deleteUser').dialog('open');
	});
});