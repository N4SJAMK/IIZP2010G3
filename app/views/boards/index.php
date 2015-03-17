<h2>Boards by <?php echo $data["user"]; ?></h2>

<table>
<thead>
<tr>
<td>Owner</td><td>Name</td><td>Access code</td><td>Tickets</td><td>Size</td><td>Actions</td>
</tr>
</thead>
<?php

$formatter = new Formatter();

foreach($data["boardlist"] as $board){
	echo "<tr>".
	"<td><a href=\"/boards/byuser/".$board["createdBy"]["_id"]."\">".$board["createdBy"]["email"]."</a></td>".
	"<td>".$board["name"]."</td>".
	"<td>".$board["accessCode"]."</td>".
	"<td>".$board["ticketCount"]."</td>".
	"<td>".$formatter->filesize($board["boardSize"])."</td>".
	"<td><a href=\"#\">Empty</a> - <a href=\"#\">Remove</a></td>".
	"</tr>";
}

?>
</table>