<!DOCTYPE html>
<html>
<head>
	<!-- SCRIPTS -->
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
	<script src="/js/navigation.js"></script>
	<script src="/js/dataTable.js"></script>

	<!-- STYLES -->
	<link href="/css/fonts.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">

	<title>Controlpanel - Contriboard</title>
</head>
<body>
<div id="wrapper" class="<?php echo $extraClass; ?>">
	<h1>Controlpanel</h1>
	<?php echo $navigation; ?>
	<?php echo $content; ?>
</div>
</body>
</html>