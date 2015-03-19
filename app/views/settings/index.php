<table data-pseudo-content="Table of admins">
<thead>
<tr>
<td>Email</td><td>Actions</td>
</tr>
</thead>
<?php

foreach($data["userlist"] as $user){
	echo "<tr>".
	"<td>".$user["email"]."</td>".
	"<td><a class=\"fa fa-key\" title=\"Change password\"></a><a class=\"actionDeleteAdmin fa fa-trash-o\" data-id=\"".$user["adminid"]."\" title=\"Remove\"></a></td>".
	"</tr>";
}

?>
</table>

<div class="tableActions">
	<button class="singlebutton">
		Add admin
	</button>
</div>

<p>Here should be the ablity to back-up database and maybe cron to make scheduled back-ups.</p>

<!-- Dialogs -->
<div id="dialog-deleteAdmin" title="Confirm admin remove">
	<p>Only the admin right will be removed. User account will remain.</p>
</div>

<div id="dialog-addAdmin" title="Add new admin">
	<p></p>
</div>