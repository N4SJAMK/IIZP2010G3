<h2>Users</h2>

<table>
<thead>
<tr>
<td>Email (username)</td><td>Boards</td><td>Actions</td>
</tr>
</thead>
<?php

foreach($data["userlist"] as $user){
	echo "<tr>".
	"<td>".$user["email"]."</td>".
	"<td>".$user["boardCount"]."</td>".
	"<td><a href=\"/boards/byuser/".$user["_id"]."\">Show boards</a> - <a href=\"#\">Change password</a> - <a href=\"#\">Lock</a> - <a href=\"#\">Delete</a></td>".
	"</tr>";
}

?>
</table>