var dialogAjax = (function($, exports){
	// Application path
	var APP_PATH = '/~vagrant/IIZP2010G3/public';

	// Default error handler
	var _error = function(xhr, statusText){
		$('#dialog-msg p').html('AJAX error: '+statusText);
		$('#dialog-msg').dialog('open');
	}

	// Default success handler
	var _success = function(data){
		$('#dialog-msg p').html(
			(data.message.length > 0) ? data.message : ((data.error == 1) ? 'Error occured!' : 'Operation successful!')
		);
		$('#dialog-msg').dialog('open');
	}

	exports.request = function(self, userSettings){
		var self = $(self);
		var settings = {
			type:'POST',
			dataType:'json',
			complete:function(){
				self.dialog('close');
			},
			success:_success,
			error:_error
		}

		// Edit settings
		for(key in userSettings){
			if(key == 'url'){
				settings[key] = APP_PATH+userSettings[key]
			}else{
				settings[key] = userSettings[key];
			}
		}

		// Do the request
		$.ajax(settings);
	}

	return exports;
}(jQuery,{}));