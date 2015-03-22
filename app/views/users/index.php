<table data-pseudo-content="Table of users">
<thead>
<tr>
<td>Email (username)</td><td>Boards</td><td>Actions</td>
</tr>
</thead>
<?php

foreach($data["userlist"] as $user){
	echo "<tr data-userid=\"".$user["_id"]."\">".
	"<td>".$user["email"]."</td>".
	"<td>".$user["boardCount"]."</td>".
	"<td><a href=\"/boards/byuser/".$user["_id"]."\" class=\"fa fa-table\" title=\"Show boards\"></a><a class=\"fa fa-key actionChangePassword\" title=\"Change password\"></a><a class=\"fa fa-star\" title=\"Add as admin\"></a><a class=\"fa fa-lock\" title=\"Lock\"></a><a class=\"fa fa-trash-o\" title=\"Remove\"></a></td>".
	"</tr>";
}

?>
</table>