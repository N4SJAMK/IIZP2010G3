var dialogAjax = (function($, exports){
	// Application path
	var APP_PATH = '/~vagrant/IIZP2010G3/public';

	// Default error handler
	var _error = function(xhr, statusText){
		$('#dialog-msg p').html('AJAX error: '+statusText);
		$('#dialog-msg').dialog('open');
	}

	// Default success handler
	var _success = function(successCallback, data, requestData){
		$('#dialog-msg p').html(
			(data.message.length > 0) ? data.message : ((data.error == 1) ? 'Error occured!' : 'Operation successful!')
		);
		$('#dialog-msg').dialog('open');

		if(typeof successCallback == 'function'){
			successCallback(data, requestData);
		}
	}

	exports.request = function(self, userSettings, successCallback){
		var self = $(self)
		var successCallback = (typeof successCallback == 'function') ? successCallback : null;
		var requestData = (typeof userSettings['data'] == 'string') ? $.unparam(userSettings['data']) : null;
		var settings = {
			type:'POST',
			dataType:'json',
			complete:function(){
				self.dialog('close');
			},
			success:function(data){
				_success(successCallback, data, requestData);
			},
			error:_error
		};

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