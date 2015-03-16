<h2>Boards</h2>

<table>
<thead>
<tr>
<td>Owner</td><td>Name</td><td>Access code</td><td>Tickets</td><td>Size (of tickets)</td><td>Actions</td>
</tr>
</thead>
<?php

foreach($data["boardlist"] as $board){
	echo "<tr>".
	"<td>".$board["createdBy"]["email"]."</td>".
	"<td>".$board["name"]."</td>".
	"<td>".$board["accessCode"]."</td>".
	"<td>xx (todo)</td>".
	"<td><a href=\"#\">Empty</a> - <a href=\"#\">Remove</a></td>".
	"</tr>";
}

?>
</table>