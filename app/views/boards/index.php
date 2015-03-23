<table data-pseudo-content="Table of boards by <?php echo $data["user"]; ?>">
<thead>
<tr>
<td>Owner</td><td>Name</td><td>Access code</td><td>Tickets</td><td>Size</td><td>Actions</td>
</tr>
</thead>
<?php

$formatter = new Formatter();

foreach($data["boardlist"] as $board){
	echo "<tr data-boardid=\"".$board["_id"]."\">".
	"<td><a href=\"/boards/byuser/".$board["createdBy"]["_id"]."\">".$board["createdBy"]["email"]."</a></td>".
	"<td>".$board["name"]."</td>".
	"<td>".$board["accessCode"]."</td>".
	"<td>".$board["ticketCount"]."</td>".
	"<td>".$formatter->filesize($board["boardSize"])."</td>".
	"<td><a class=\"fa fa-square-o actionEmptyBoard\" title=\"Empty\"></a><a class=\"fa fa-trash-o actionDeleteBoard\" title=\"Remove\"></a></td>".
	"</tr>";
}

?>
</table>