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

	exports.request = function(self, path){
		var self = $(self);

		// Do the request
		$.ajax({
			dataType:'json',
			url:APP_PATH+path,
			complete:function(){
				self.dialog('close');
			},
			success:_success,
			error:_error
		});
	}

	return exports;
}(jQuery,{}));