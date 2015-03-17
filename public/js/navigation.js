jQuery(document).ready(function(){
	var root = 'http://localhost:8080/~vagrant/IIZP2010G3/public/'
	var linkURL = document.location.href.replace(root, '').split('/');
	linkURL.splice(1, linkURL.length-1);
	linkURL.join();

	// Add active class
	$('nav ul li a[href*="'+linkURL+'"]:not(.inactive)').addClass('active');
});