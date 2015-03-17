jQuery(document).ready(function(){
	$('table').DataTable({
		searching: true,
		ordering: true,
		paging: false,
		autoWidth: false,
		oLanguage: {
		    sSearch: ''
		}
	});

	$('.dataTables_filter input').attr("placeholder", "Filter");
});