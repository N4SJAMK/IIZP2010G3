<table data-pseudo-content="Statistics">
	<thead>
		<tr>
			<td>Section</td><td>Amount</td>
		</tr>
	</thead>
	<tbody>
<?php

foreach($data["count"] as $section => $count){
	echo "<tr>
		<td>".$section."</td><td>".$count."</td>
	</tr>";
}

?>
	</tbody>
</table>